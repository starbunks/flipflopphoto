jQuery(document).ready(function($) {


	var theme_url = $('#ml-theme-url').val();


	/*-------------------------------------------------*/
	/*	1. LAUNCH/CLOSE FX SLIDE EDITOR
	/*-------------------------------------------------*/

	$('.ml-launch-fx-slide-button').click(function(){

		$('.ml-fx-modal, .ml-fx-modal-mask').fadeIn(300);

		return false;

	});

	$('#ml-fx-modal-mask, #ml-fx-done').click(function(){

		$('.ml-fx-modal, .ml-fx-modal-mask').fadeOut(300);

		return false;

	});



	/*-------------------------------------------------*/
	/*	2. SLIDER HEIGHT
	/*-------------------------------------------------*/

	$('#ml-fx-height').live('change',function(){

		var ajax_data = {
			action:     'ml_fx_resize_slider',
			new_height: $(this).val(),
			post_id:    $('#post_ID').val()
		};

		$.post(ajaxurl, ajax_data, function(response) {
			
			if(response != 'error') {
				var new_height = $('#ml-fx-height').val()+'px';
				$('.ml-fx-slider-prev').animate({height: new_height},300);

				$('.ml-fx-element').each(function(){

					var animation = $(this).attr('data-animation');

					if( animation.match('bottom') )
						$(this).attr('data-from_y', new_height)

				});

			} else {
				alert('Error: cannot resize slider.');

			}

		});

	});



	/*-------------------------------------------------*/
	/*	3. ADD ITEM
	/*-------------------------------------------------*/


	/*--- Sort Items ---*/

	function ml_fx_sort() {

		the_order = $('.ml-fx-items').sortable('toArray');

		var ajax_data = {
			action: 'ml_fx_update_order',
			order:  the_order
		};

		$.post(ajaxurl, ajax_data, function(response) {

			for (var num in the_order){
				the_id = the_order[num].replace('ml-fx-item-','');
				$('#ml-fx-'+the_id).css('z-index', 1000 - num);
			}

		});

	}


	/*--- Add Media ---*/
			
	var add_item_ID, add_item_rel, btnContent = true, tbframe_interval;

	$('#ml-fx-add-element').click(function(){

		add_item_ID = $(this).attr('id');
		add_item_rel = $(this).attr('data-rel');
		
		//Change "insert into post" to "Use this Button"
		tbframe_interval = setInterval(function() {
			$('#TB_iframeContent').contents().find('.savesend .button').val('Use This Image');
		}, 2000);
		  		  
		var title = $(this).text();
		  
		tb_show( title, 'media-upload.php?post_id='+add_item_rel+'&TB_iframe=1' );

		return false;

	});
				
	window.original_send_to_editor = window.send_to_editor;
	window.send_to_editor = function(html) {
					
			clearInterval(tbframe_interval);
			
			if ( $(html).html(html).find('img').length > 0 )
				itemurl = $(html).html(html).find('img').attr('src'); // Use the URL to the size selected.

						 
			var image = /(^.*\.jpg|jpeg|png|gif|ico*)/gi;
			 
			if (itemurl.match(image)) {

				var ajax_data = {
					action:  'ml_fx_element_add_item',
					image:   itemurl,
					post_id: $('#post_ID').val()
				};

				$.post(ajaxurl, ajax_data, function(response) {
					
					if(response != 'error') {
						var split_result = response.split('|ml-split|');
						$('.ml-fx-items').prepend(split_result[0]);
						$('.ml-fx-slider-prev').prepend(split_result[1]);
						ml_fx_sort();
						ml_drag_fx();

					} else {
						alert('Error: cannot add element.');

					}

				});

			} else {
				alert('Error: invalid format.');
				
			}
			 
			tb_remove();
			 
			add_item_ID = '';

		}



	/*-------------------------------------------------*/
	/*	4. DELETE ITEM
	/*-------------------------------------------------*/

	$('.ml-fx-item-delete').live('click',function(){

		if(confirm('Delete?')) {

			var data_id = $(this).parent().parent().attr('data-id');

			var ajax_data = {
				action: 'ml_fx_element_delete_item',
				post_id: data_id
			};

			$.post(ajaxurl, ajax_data, function(response) {

				if(response != 'error') {
					$('#ml-fx-item-' + data_id + ', #ml-fx-' + data_id).fadeOut('normal', function(){
						$(this).remove();
					});

				} else {
					alert('Error: cannot delete element.');

				}

			});

		}

		return false;		

	});



	/*-------------------------------------------------*/
	/*	5. DRAG ITEM
	/*-------------------------------------------------*/

	function ml_drag_fx() {

		$('.ml-fx-element').draggable({

		   stop: function(event, ui) {

		   	var data_id = $(this).attr('data-id');

		   	var ajax_data = {
		   		action:  'ml_fx_new_element_position',
		   		post_id: data_id,
		   		left:    ui.position.left,
		   		top:     ui.position.top
		   	};

		   	$.post(ajaxurl, ajax_data, function(response) {
		   		
		   		if(response != 'error') {
		   			$('#ml-fx-'+data_id).attr( 'data-to_x', ui.position.left + 'px' );
		   			$('#ml-fx-'+data_id).attr( 'data-to_y', ui.position.top + 'px' );
		   			
		   			if($('#ml-fx-'+data_id).attr('data-animation') == 'none') {
		   				
			   			$('#ml-fx-'+data_id).attr( 'data-from_x', ui.position.left + 'px' );
			   			$('#ml-fx-'+data_id).attr( 'data-from_y', ui.position.top + 'px' );
		   			}

		   		} else {
		   			$(this).css({left: ui.originalPosition.left, top: ui.originalPosition.left});

		   		}

		   	});

		   }

		});

	}

	ml_drag_fx();



	/*-------------------------------------------------*/
	/*	6. PREVIEW
	/*-------------------------------------------------*/

	$('#ml-fx-preview').live('click', function(){

		$('.ml-fx-element').each(function(){

			var duration   = parseInt($(this).attr('data-duration'));
			var delay      = parseInt($(this).attr('data-delay'));
			var easing     = $(this).attr('data-easing');

			var dir_from   = {};
			var dir_to     = {};

			dir_from.left  = $(this).attr('data-from_x');
			dir_to.left    = $(this).attr('data-to_x');

			dir_from.top   = $(this).attr('data-from_y');
			dir_to.top     = $(this).attr('data-to_y');

			$(this)
				.css(dir_from, duration)
				.delay(delay)
				.animate(dir_to, duration, easing);				
			
		});

		return false;

	});




	/*-------------------------------------------------*/
	/*	7. UPDATE META
	/*-------------------------------------------------*/

	$('.ml-admin-input-link, .ml-fx-select-easing, .ml-admin-input-delay, .ml-admin-input-duration, .ml-admin-input-class').live('change', function(){

		var the_id    = $(this).parent().parent().attr('data-id');
		var the_meta  = $(this).attr('data-meta');
		var new_value = $(this).val();

		var ajax_data = {
			action:  'ml_fx_update_meta',
			post_id: the_id,
			meta:    the_meta,
			value:   new_value
		};

		$.post(ajaxurl, ajax_data, function(response) {
			
			if( (response != 'error') ) {
				if(the_meta != 'class')
					$('#ml-fx-' + the_id).attr('data-' + the_meta, new_value);

			} else {
				alert('Error: cannot update.');

			}

		});

	});




	/*-------------------------------------------------*/
	/*	8. UPDATE ANIMATION DIRECTION
	/*-------------------------------------------------*/

	$('.ml-animation-check').live('click',function(){

		var the_id    = $(this).parent().parent().parent().attr('data-id');
		var direction = $(this).attr('data-dir');

		var ajax_data = {
			action:  'ml_fx_update_meta',
			post_id: the_id,
			meta:    'animation',
			value:   direction
		};

		$.post(ajaxurl, ajax_data, function(response) {
			
			if( (response != 'error') ) {

				$('#ml-fx-item-' + the_id + ' .ml-animation-check.ml-active').removeClass('ml-active');
				$('#ml-fx-item-' + the_id + ' .ml-animation-' + direction).addClass('ml-active');
				$('#ml-fx-' + the_id).attr('data-animation', direction);

				var image_width   = $('#ml-fx-' + the_id).attr('width');
				var image_height  = $('#ml-fx-' + the_id).attr('height');
				var to_x          = $('#ml-fx-' + the_id).attr('data-to_x');
				var to_y          = $('#ml-fx-' + the_id).attr('data-to_y');
				var slider_height = $('.ml-fx-slider-prev').css('height');

				if(direction == 'topleft') {
					$('#ml-fx-' + the_id).attr('data-from_x', '-' + image_width + 'px');
					$('#ml-fx-' + the_id).attr('data-from_y', '-' + image_height + 'px');
				} else if(direction == 'top') {
					$('#ml-fx-' + the_id).attr('data-from_x', to_x);
					$('#ml-fx-' + the_id).attr('data-from_y', '-' + image_height + 'px');
				} else if(direction == 'topright') {
					$('#ml-fx-' + the_id).attr('data-from_x', '1160px');
					$('#ml-fx-' + the_id).attr('data-from_y', '-' + image_height + 'px');
				} else if(direction == 'left') {
					$('#ml-fx-' + the_id).attr('data-from_x', '-' + image_width + 'px');
					$('#ml-fx-' + the_id).attr('data-from_y', to_y);
				} else if(direction == 'right') {
					$('#ml-fx-' + the_id).attr('data-from_x', '1160px');
					$('#ml-fx-' + the_id).attr('data-from_y', to_y);
				} else if(direction == 'bottomleft') {
					$('#ml-fx-' + the_id).attr('data-from_x', '-' + image_width + 'px');
					$('#ml-fx-' + the_id).attr('data-from_y', slider_height);
				} else if(direction == 'bottom') {
					$('#ml-fx-' + the_id).attr('data-from_x', to_x);
					$('#ml-fx-' + the_id).attr('data-from_y', slider_height);
				} else if(direction == 'bottomright') {
					$('#ml-fx-' + the_id).attr('data-from_x', '1160px');
					$('#ml-fx-' + the_id).attr('data-from_y', slider_height);
				} else {
					$('#ml-fx-' + the_id).attr('data-from_x', to_x);
					$('#ml-fx-' + the_id).attr('data-from_y', to_y);
				}

			}

		});

		return false;

	});




	/*-------------------------------------------------*/
	/*	9. HIDE ELEMENT
	/*-------------------------------------------------*/

	$('.ml-fx-item-visibility').live('click',function(){

		var data_id = $(this).parent().parent().attr('data-id');

		if(!$(this).hasClass('ml-not-visible')) {
			$(this).addClass('ml-not-visible');
			$('#ml-fx-' + data_id).css('display','none');
		} else {
			$(this).removeClass('ml-not-visible');
			$('#ml-fx-' + data_id).css('display','block');
		}

		return false;

	});




	/*-------------------------------------------------*/
	/*	10. SORTABLE
	/*-------------------------------------------------*/

	$('.ml-fx-items').sortable({
		cursor: "move",
		update: function() {

			ml_fx_sort();

		}
	});




	/*-------------------------------------------------*/
	/*	11. HOVER OUTLINE
	/*-------------------------------------------------*/

	$('.ml-fx-item-li').live({
		mouseenter: function() {
			$('.ml-fx-slider-prev .ml-hover').removeClass('ml-hover');
			var data_id = $(this).attr('data-id');
			$('#ml-fx-' + data_id).addClass('ml-hover');
		},
		mouseleave: function() {
			$('.ml-fx-slider-prev .ml-hover').removeClass('ml-hover');
			var data_id = $(this).attr('data-id');
			$('#ml-fx-' + data_id).removeClass('ml-hover');
		}
	});



	/*-------------------------------------------------*/
	/* 12. HIDE/SHOW BOXES
	/*-------------------------------------------------*/


	/*--- Show and Hide Function ---*/

	function ml_show_n_hide(to_show, to_hide) {

		if(to_show.hasClass('ml_hidden')) {

			to_hide.hide().addClass('ml_hidden');

			to_show.fadeIn(300).removeClass('ml_hidden');

		}

	}
	

	/*--- Slider Post Type ---*/

	if($('#ml_slide_content input:radio[value=image]').is(':checked')) {

		$('#ml_embedded_content, #ml_html_content, #ml_fx_content').hide().addClass('ml_hidden');

	} else if($('#ml_slide_content input:radio[value=embedded]').is(':checked')) {

		$('#ml_image_content, #ml_html_content, #ml_fx_content').hide().addClass('ml_hidden');

	} else if($('#ml_slide_content input:radio[value=html]').is(':checked')) {

		$('#ml_image_content, #ml_embedded_content, #ml_fx_content').hide().addClass('ml_hidden');

	} else if($('#ml_slide_content input:radio[value=fx]').is(':checked')) {

		$('#ml_image_content, #ml_embedded_content, #ml_html_content').hide().addClass('ml_hidden');

	} 


	$('#ml_slide_content input:radio[value=image]').click(function(){

		ml_show_n_hide( $('#ml_image_content'), $('#ml_embedded_content, #ml_html_content, #ml_fx_content') );

	});

	$('#ml_slide_content input:radio[value=embedded]').click(function(){

		ml_show_n_hide( $('#ml_embedded_content'), $('#ml_image_content, #ml_html_content, #ml_fx_content') );

	});

	$('#ml_slide_content input:radio[value=html]').click(function(){

		ml_show_n_hide( $('#ml_html_content'), $('#ml_image_content, #ml_embedded_content, #ml_fx_content') );

	});

	$('#ml_slide_content input:radio[value=fx]').click(function(){

		ml_show_n_hide( $('#ml_fx_content'), $('#ml_image_content, #ml_embedded_content, #ml_html_content') );

		$('#publish').click();

	});


});
