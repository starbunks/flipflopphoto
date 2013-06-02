jQuery(document).ready(function($) {

	/*--- Functions n' Variables ---*/

	var theme_url = $('#ml-theme-url').val();



	/*-------------------------------------------------*/
	/*	1. SORTABLE
	/*-------------------------------------------------*/

	function ml_cstacker_order() {

		var order = jQuery('#ml-cs-items').sortable('toArray');

		var ajax_data = {
			action : 'ml_cstacker_save_order',
			order  : order
		};

		$.post(ajaxurl, ajax_data, function(response) {
			if(response == 'error')
				alert('Error: cannot save order.');
		});

	}

	if($('#ml-cs-items').length > 0) {

		$('#ml-cs-items').sortable({

			cursor: "move",
			update: function() {
				ml_cstacker_order();

			}

		});

	}
	


	/*-------------------------------------------------*/
	/*	2. ADD ITEM
	/*-------------------------------------------------*/

	$('#ml-add-item-button').click(function(){

		var selected_item = $('#ml-add-item-select option:selected');

		var ajax_data = {
			action: 'ml_cstacker_add_item',
			type: selected_item.val(),
			title: selected_item.html(),
			post_id: $('#post_ID').val()
		};

		$.post(ajaxurl, ajax_data, function(response) {
			
			if(response != 'error') {
				$('#ml-cs-items').prepend(response);
				ml_cstacker_order();

			} else {
				alert('Error: cannot add item.');

			}

		});

		return false;

	});



	/*-------------------------------------------------*/
	/*	3. DELETE ITEM
	/*-------------------------------------------------*/

	$('.ml-cs-delete').live('click',function(){

		if(confirm('Delete?')) {

			var rel_id = $(this).parent().parent().attr('data-id');

			var ajax_data = {
				action: 'ml_cstacker_delete_item',
				post_id: rel_id
			};

			$.post(ajaxurl, ajax_data, function(response) {

				if(response != 'error') {
					$('.ml-cs-item-'+rel_id).fadeOut('normal', function(){
						$(this).remove();
					});

				} else {
					alert('Error: cannot delete item.');

				}

			});

		}

		return false;

	});



	/*-------------------------------------------------*/
	/*	4. EDIT ITEM
	/*-------------------------------------------------*/

	$('.ml-cs-edit').live('click',function(){

		var rel_id			= $(this).closest('.ml-cs-li').attr('data-id');
		var element			= $('.ml-cs-item-'+rel_id);
		var the_data_type	= element.attr('data-type');

		if(element.hasClass('ml-cs-edit-active')) {
			element.find('.ml-cs-edit-content').removeClass('ml-cs-max-height');
			element.removeClass('ml-cs-edit-active ml-cs-size-full');
		} else {
			element.addClass('ml-cs-edit-active');
		}

		var ajax_data = {
			action		: 'ml_cstacker_edit_item',
			post_id		: rel_id,
			post_type	: the_data_type
		};

		$.post(ajaxurl, ajax_data, function(response) {

			if(response != 'error') {

				if(element.hasClass('ml-cs-edit-active')) {
					element.addClass('ml-cs-size-full');

					if(element.hasClass('ml-cs-edit-active-ajax')) {
						element.find('.ml-cs-edit-content').addClass('ml-cs-max-height');
					} else {
						element.find('.ml-cs-edit-content').html(response).addClass('ml-cs-max-height');
						element.addClass('ml-cs-edit-active-ajax');
					}

				}

			} else {
				alert('Error: cannot edit item.');

			}

		});

		return false;

	});



	/*-------------------------------------------------*/
	/*	5. RESIZE ITEM
	/*-------------------------------------------------*/

	function ml_cstacker_ajax_resize(the_id, size_from, size_new) {

		var ajax_data = {
			action: 'ml_cstacker_resize_item',
			post_id: the_id,
			post_size: size_new
		};

		$.post(ajaxurl, ajax_data, function(response) {
	
			if(response != 'error') {
				
				var element	= '.ml-cs-item-'+the_id;

				$(element).removeClass('ml-cs-size-'+size_from).addClass('ml-cs-size-'+size_new);
				$(element).attr('data-size',size_new);

				if(size_new == 2) {
					$(element).children().children('.ml-cs-size').html('3/4');
				} else if(size_new == 3) {
					$(element).children().children('.ml-cs-size').html('2/3');
				} else if(size_new == 4) {
					$(element).children().children('.ml-cs-size').html('1/2');
				} else if(size_new == 5) {
					$(element).children().children('.ml-cs-size').html('1/3');
				} else if(size_new == 6) {
					$(element).children().children('.ml-cs-size').html('1/4');
				} else {
					$(element).children().children('.ml-cs-size').html('1/1');
				}

			}

		});

	}

	$('.ml-cs-minus, .ml-cs-plus').live('click',function(){

		var the_id				= $(this).parent().parent().attr('data-id');
		var size_from			= parseInt($('.ml-cs-item-'+the_id).attr('data-size'));

		var button_pressed	= $(this).attr('data-button');
		if( (button_pressed == 'minus') && (size_from < 6)) {
			size_new = size_from + 1;
		} else if( (button_pressed == 'plus') && (size_from > 1)) {
			size_new = size_from - 1;
		}

		ml_cstacker_ajax_resize(the_id, size_from, size_new);

		return false;

	});



	/*-------------------------------------------------*/
	/*	6. CONTENTs OPTIONS
	/*-------------------------------------------------*/


	/*--- DONE Button for contents with no options ---*/

	$('.ml-cs-fake-save').live('click', function(){

		var rel_id        = $(this).parent().attr('data-id');

		$('.ml-cs-item-'+rel_id).removeClass('ml-cs-size-full ml-cs-edit-active');
		$('.ml-cs-item-'+rel_id).find('.ml-cs-edit-content').removeClass('ml-cs-max-height');

		return false;

	});




	/*--- ALERT ---*/

	$('.ml-cs-alert-save').live('click', function(){

		var rel_id          = $(this).parent().attr('data-id');
		var alert_color     = $('#ml-cs-alert-color-select-'+rel_id+' option:selected').val();
		var alert_text      = $('#ml-cs-alert-text-'+rel_id).val();
		var alert_text_size = $('#ml-cs-alert-text-size-'+rel_id).val();

		var ajax_data = {
			action          : 'ml_cstacker_alert',
			post_id         : rel_id,
			alert_color     : alert_color,
			alert_text      : alert_text,
			alert_text_size : alert_text_size
		};

		$.post(ajaxurl, ajax_data, function(response) {

			$('.ml-cs-item-'+rel_id).removeClass('ml-cs-size-full ml-cs-edit-active');
			$('.ml-cs-item-'+rel_id).find('.ml-cs-edit-content').removeClass('ml-cs-max-height');

		});

		return false;

	});




	/*--- BLOG ---*/


	/* Save Options */

	$('.ml-cs-blog-save').live('click', function(){

		var rel_id = $(this).parent().attr('data-id');
		var show   = $('#ml-cs-blog-select-'+rel_id+' option:selected').val();

		var ajax_data = {
			action  : 'ml_cstacker_blog',
			post_id : rel_id,
			show    : show
		};

		$.post(ajaxurl, ajax_data, function(response) {

			$('.ml-cs-item-'+rel_id).removeClass('ml-cs-size-full ml-cs-edit-active');
			$('.ml-cs-item-'+rel_id).find('.ml-cs-edit-content').removeClass('ml-cs-max-height');

		});

		return false;

	});






	/*--- CALL TO ACTION ---*/

	$('.ml-cs-cta-save').live('click', function(){

		var rel_id        = $(this).parent().attr('data-id');
		var cta_title     = $('#ml-cs-cta-title-'+rel_id).val();
		var cta_btn_text  = $('#ml-cs-cta-btn-text-'+rel_id).val();
		var cta_btn_link  = $('#ml-cs-cta-btn-link-'+rel_id).val();

		var ajax_data = {
			action        : 'ml_cstacker_cta',
			post_id       : rel_id,
			cta_title     : cta_title,
			cta_btn_text  : cta_btn_text,
			cta_btn_link  : cta_btn_link
		};

		$.post(ajaxurl, ajax_data, function(response) {

			$('.ml-cs-item-'+rel_id).removeClass('ml-cs-size-full ml-cs-edit-active');
			$('.ml-cs-item-'+rel_id).find('.ml-cs-edit-content').removeClass('ml-cs-max-height');

		});

		return false;

	});




	/*--- COLUMN ---*/

	$('.ml-cs-column-save').live('click', function(){

		var rel_id      = $(this).parent().attr('data-id');
		var column_text = $('#ml-cs-column-text-'+rel_id).val();

		var ajax_data = {
			action      : 'ml_cstacker_column',
			post_id     : rel_id,
			column_text : column_text
		};

		$.post(ajaxurl, ajax_data, function(response) {

			$('.ml-cs-item-'+rel_id).removeClass('ml-cs-size-full ml-cs-edit-active');
			$('.ml-cs-item-'+rel_id).find('.ml-cs-edit-content').removeClass('ml-cs-max-height');

		});

		return false;

	});




	/*--- DIVIDER ---*/

	$('.ml-cs-divider-save').live('click', function(){

		var rel_id       = $(this).parent().attr('data-id');
		var divider_text = $('#ml-cs-divider-text-'+rel_id).val();

		var ajax_data = {
			action       : 'ml_cstacker_divider',
			post_id      : rel_id,
			divider_text : divider_text
		};

		$.post(ajaxurl, ajax_data, function(response) {

			$('.ml-cs-item-'+rel_id).removeClass('ml-cs-size-full ml-cs-edit-active');
			$('.ml-cs-item-'+rel_id).find('.ml-cs-edit-content').removeClass('ml-cs-max-height');

		});

		return false;

	});




	/*--- PORTFOLIO ---*/


	/* Save Items */

	$('.ml-cs-portfolio-save').live('click', function(){

		var rel_id        = $(this).parent().attr('data-id');
		var show_filter   = $('#ml-cs-port-show-filter-'+rel_id+':checked').val() != undefined;
		var show_items    = $('.ml-cs-port-show-items-'+rel_id+':checked').val();
		var portfolio_ids = '';

		$('#ml-cs-port-items-'+rel_id+' .ml-port-item:checked').each(function(){
			portfolio_ids += ',' + $(this).val();
		});

		portfolio_ids = portfolio_ids.replace(',','');

		var ajax_data = {
			action        : 'ml_cstacker_portfolio',
			post_id       : rel_id,
			show_filter   : show_filter,
			show_items    : show_items,
			portfolio_ids : portfolio_ids
		};

		$.post(ajaxurl, ajax_data, function(response) {

			$('.ml-cs-item-'+rel_id).removeClass('ml-cs-size-full ml-cs-edit-active');
			$('.ml-cs-item-'+rel_id).find('.ml-cs-edit-content').removeClass('ml-cs-max-height');

		});

		return false;

	});


	/*--- Check Radio ---*/

	$('input:radio[name=ml-cs-port-show-items][value=selected]').live('click',function(){
		$(this).closest('.ml-cs-edit-content').find('.ml-cs-port-items-list').slideDown(300);
	});

	$('input:radio[name=ml-cs-port-show-items][value=all]').live('click',function(){
		$(this).closest('.ml-cs-edit-content').find('.ml-cs-port-items-list').slideUp(300);
	});





	/*--- SLIDER ---*/


	/* Save Options */

	$('.ml-cs-slider-save').live('click', function(){

		var rel_id        = $(this).parent().attr('data-id');
		var rel_slider_id = $('#ml-cs-slider-select-'+rel_id+' option:selected').val();

		var ajax_data = {
			action    : 'ml_cstacker_slider',
			post_id   : rel_id,
			slider_id : rel_slider_id
		};

		$.post(ajaxurl, ajax_data, function(response) {

			$('.ml-cs-item-'+rel_id).removeClass('ml-cs-size-full ml-cs-edit-active');
			$('.ml-cs-item-'+rel_id).find('.ml-cs-edit-content').removeClass('ml-cs-max-height');

		});

		return false;

	});





	/*--- TABS ---*/

	/* Add Tab */

	$('.ml-cs-tabs-add').live('click',function(){

		var rel_id = $(this).closest('.ml-cs-tabs-box').attr('data-id');

		var ajax_data = {
			action  : 'ml_cstacker_add_tab',
			post_id : rel_id
		};


		$.post(ajaxurl, ajax_data, function(response) {

			if(response != 'error') {

				$('#ml-tabs-list-'+rel_id).append(response);

			} else {

				alert('Error: cannot create tab.');

			}

		});

		return false;

	});




	/* Update Single Tab */

	$('.ml-tab-js.ml-pseudowidget-save').live('click',function(){

		var rel_id         = $(this).closest('.ml-tab-li').attr('data-id');
		var wrapper_inside = $('#ml-pseudowidget-inside-'+rel_id);
		var the_title      = wrapper_inside.find('.ml-tab-title').val();
		var the_content    = wrapper_inside.find('.ml-tab-content').val();

		var ajax_data = {
			action      : 'ml_cstacker_update_tab',
			post_id     : rel_id,
			tab_title   : the_title,
			tab_content : the_content
		};


		$.post(ajaxurl, ajax_data, function(response) {

			wrapper_inside.slideToggle(300);
			$('#in-widget-title-'+rel_id).html(the_title);

		});

		return false;

	});




	/* Delete Tab */

	$('.ml-tab-js.ml-pseudowidget-remove').live('click',function(){

		if(confirm('Delete?')) {

			var rel_id = $(this).closest('.ml-tab-li').attr('data-id');

			var ajax_data = {
				action  : 'ml_cstacker_delete_tab',
				post_id : rel_id
			};


			$.post(ajaxurl, ajax_data, function(response) {

				if(response != 'error') {

					$('#ml-tab-li-'+rel_id).fadeOut(600, 'easeInOutQuad', function(){
						$(this).remove();
					});

				} else {

					alert('Error: cannot delete tab.');

				}

			});

		}

		return false;

	});


	/* Tab Toggle */

	$('.ml-tab-js.ml-pseudowidget-action, .ml-tab-js.ml-pseudowidget-close').live('click',function(){

		$(this).closest('.ml-single-tab').children('.widget-inside').slideToggle(300);

		return false;

	});




	/*--- TITLE ---*/


	/* Save Options */

	$('.ml-cs-title-save').live('click', function(){

		var rel_id          = $(this).parent().attr('data-id');
		var title_text      = $('#ml-cs-title-text-'+rel_id).val();
		var title_class     = $('#ml-cs-title-text-class-'+rel_id).val();
		var title_size      = $('#ml-cs-title-size-select-'+rel_id).val();
		var title_alignment = $('.ml-cs-title-alignment-radio-'+rel_id+':checked').val();

		var ajax_data = {
			action          : 'ml_cstacker_title',
			post_id         : rel_id,
			title_text      : title_text,
			title_class     : title_class,
			title_size      : title_size,
			title_alignment : title_alignment
		};

		$.post(ajaxurl, ajax_data, function(response) {

			$('.ml-cs-item-'+rel_id).removeClass('ml-cs-size-full ml-cs-edit-active');
			$('.ml-cs-item-'+rel_id).find('.ml-cs-edit-content').removeClass('ml-cs-max-height');

		});

		return false;

	});




	/*--- TOGGLES ---*/


	/* Save Options */

	function ml_toggles_options(rel_id, classes) {

			$(classes).each(function() {

				var option = $(this).attr('data-option');

				if($(this).is(':checked')) {
					var this_boolean = true;

				} else {
					var this_boolean = false;

				}

				var ajax_data = {
					action       : 'ml_cstacker_toggles_option',
					post_id      : rel_id,
					this_boolean : this_boolean,
					option       : option
				};

				$.post(ajaxurl, ajax_data);

		   });

	}

	$('.ml-cs-toggles-save').live('click', function(){

		var rel_id        = $(this).parent().attr('data-id');

		$('.ml-cs-item-'+rel_id).removeClass('ml-cs-size-full ml-cs-edit-active');
		$('.ml-cs-item-'+rel_id).find('.ml-cs-edit-content').removeClass('ml-cs-max-height');

		ml_toggles_options(rel_id, '.ml-toggle-first, .ml-toggle-one-allowed');

		return false;

	});



	/* Add Toggle */

	$('.ml-cs-toggles-add').live('click',function(){

		var rel_id = $(this).closest('.ml-cs-toggles-box').attr('data-id');

		var ajax_data = {
			action  : 'ml_cstacker_add_toggle',
			post_id : rel_id
		};

		$.post(ajaxurl, ajax_data, function(response) {

			if(response != 'error') {

				$('#ml-toggles-list-'+rel_id).append(response);

			} else {

				alert('Error: cannot create toggle.');

			}

		});

		return false;

	});



	/* Update Toggle */

	$('.ml-toggle-js.ml-pseudowidget-save').live('click',function(){

		var rel_id         = $(this).closest('.ml-toggle-li').attr('data-id');
		var wrapper_inside = $('#ml-pseudowidget-inside-'+rel_id);
		var the_title      = wrapper_inside.find('.ml-toggle-title').val();
		var the_content    = wrapper_inside.find('.ml-toggle-content').val();

		var ajax_data = {
			action         : 'ml_cstacker_update_toggle',
			post_id        : rel_id,
			toggle_title   : the_title,
			toggle_content : the_content
		};


		$.post(ajaxurl, ajax_data, function(response) {

			wrapper_inside.slideToggle(300);
			$('#in-widget-title-'+rel_id).html(the_title);

		});

		return false;

	});



	/* Delete Toggle */

	$('.ml-toggle-js.ml-pseudowidget-remove').live('click',function(){

		if(confirm('Delete?')) {

			var rel_id = $(this).closest('.ml-toggle-li').attr('data-id');

			var ajax_data = {
				action  : 'ml_cstacker_delete_toggle',
				post_id : rel_id
			};


			$.post(ajaxurl, ajax_data, function(response) {

				if(response != 'error') {

					$('#ml-toggle-li-'+rel_id).fadeOut(600, 'easeInOutQuad', function(){
						$(this).remove();
					});

				} else {

					alert('Error: cannot delete toggle.');

				}

			});

		}

		return false;

	});


	/* Toggle Toggle-box */

	$('.ml-toggle-js.ml-pseudowidget-action, .ml-toggle-js.ml-pseudowidget-close').live('click',function(){

		$(this).closest('.ml-single-toggle').children('.widget-inside').slideToggle(300);

		return false;

	});




	/*--- WELCOME MESSAGE ---*/

	/* Add Welcome Message */

	$('.ml-cs-wmessages-add').live('click',function(){

		var rel_id = $(this).closest('.ml-cs-welcome-box').attr('data-id');

		var ajax_data = {
			action  : 'ml_cstacker_add_welcome',
			post_id : rel_id
		};


		$.post(ajaxurl, ajax_data, function(response) {

			if(response != 'error') {

				$('#ml-wmessages-list-'+rel_id).append(response);

			} else {

				alert('Error: cannot create welcome message.');

			}

		});

		return false;

	});




	/* Update Single Welcome Message */

	$('.ml-welcome-js.ml-pseudowidget-save').live('click',function(){

		var rel_id         = $(this).closest('.ml-welcome-li').attr('data-id');
		var wrapper_inside = $('#ml-pseudowidget-inside-'+rel_id);
		var the_content    = wrapper_inside.find('.ml-welcome-content').val();

		var ajax_data = {
			action      : 'ml_cstacker_update_welcome',
			post_id     : rel_id,
			welcome_content : the_content
		};


		$.post(ajaxurl, ajax_data, function(response) {

			wrapper_inside.slideToggle(300);
			var fake_title = the_content;
			fake_title = fake_title.split(' ');
			fake_title = fake_title.slice(0,3);
			fake_title = fake_title.join(' ') + '...';
			$('#in-widget-title-'+rel_id).html(fake_title);

		});

		return false;

	});




	/* Delete Welcome Message */

	$('.ml-welcome-js.ml-pseudowidget-remove').live('click',function(){

		if(confirm('Delete?')) {

			var rel_id = $(this).closest('.ml-welcome-li').attr('data-id');

			var ajax_data = {
				action  : 'ml_cstacker_delete_welcome',
				post_id : rel_id
			};


			$.post(ajaxurl, ajax_data, function(response) {

				if(response != 'error') {

					$('#ml-welcome-li-'+rel_id).fadeOut(600, 'easeInOutQuad', function(){
						$(this).remove();
					});

				} else {

					alert('Error: cannot delete welcome message.');

				}

			});

		}

		return false;

	});


	/* Welcome Messages Toggle */

	$('.ml-welcome-js.ml-pseudowidget-action, .ml-welcome-js.ml-pseudowidget-close').live('click',function(){

		$(this).closest('.ml-single-welcome').children('.widget-inside').slideToggle(300);

		return false;

	});


});