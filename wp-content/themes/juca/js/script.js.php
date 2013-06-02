<?php

/*--- Make it a JavaScript file ---*/
header("Content-type: text/javascript");

/*--- Load WordPress ---*/
if(file_exists('../../../../wp-load.php')) {
	include '../../../../wp-load.php';
} else {
	include '../../../../../wp-load.php';
}

$fixed_header      = of_get_option('ml-fixed-header');

$bg_type           = of_get_option('ml-bg-type', 'video');
$m4v               = of_get_option('ml-m4v');
$ogv               = of_get_option('ml-ogv');

$bg_slide_num      = of_get_option('ml-bg-slide-num', 1);
$bg_anim_duration  = of_get_option('ml-bg-anim-duration', 1000);
$bg_slide_speed    = of_get_option('ml-bg-slide-speed', 5000);

$anim_type         = of_get_option('ml-anim-type', 'slide');
$anim_duration     = of_get_option('ml-anim-duration', '600');
$slide_speed       = of_get_option('ml-slide-speed', '8000');
$anim_loop         = ml_bool(of_get_option('ml-anim-loop', '1'));
$anim_pause_action = ml_bool(of_get_option('ml-anim-pause-action', '1'));
$anim_pause_hover  = ml_bool(of_get_option('ml-anim-pause-hover', '0'));
$randomize         = ml_bool(of_get_option('ml-randomize', '0'));



?>

/*-------------------------------------------------*/
/* 1. General
/* 2. Header & Menu
/* 3. Portfolio
/* 4. Video Background
/* 5. Blog
/*-------------------------------------------------*/

jQuery(document).ready(function($) {


	/*-------------------------------------------------*/
	/*	1. GENERAL
	/*-------------------------------------------------*/

	$('.ml-fit').fitVids();

	/*--- Rule of Three ---*/
	function ml_rot(val_a1, val_a2, val_b1) {

		return (val_a2 * val_b1) / val_a1;

	}



	/*-------------------------------------------------*/
	/*	2. HEADER & MENU
	/*-------------------------------------------------*/

	var fixed_header  = '<?php echo $fixed_header ?>';

	var header_height = $('.ml-header').height();

	if(fixed_header != '1') {

		$('.ml-header').delay(2000).animate({top: -header_height}, 900, 'easeInOutQuad');

		$('.ml-header, .ml-h-arrow').hover(function(){
			$('.ml-header').animate({top: 0}, 900, 'easeOutBounce');
			$('.ml-header').addClass('ml-h-down');

		}, function(){
			$('.ml-header').delay(1000).removeClass('ml-h-down');

			setTimeout(function() {
				if(!$('.ml-header').hasClass('ml-h-down')) {
					header_height = $('.ml-header').height();
					$('.ml-header').animate({top: -header_height}, 300, 'easeInOutQuad');
				}
			}, 1000);

		});

		$(window).resize(function() {
			if(!$('.ml-header').hasClass('ml-h-down')){
				header_height = $('.ml-header').height();
				$('.ml-header').css({top: -header_height});
			}
		});

	}


	$('.ml-head-menu').superfish({
		autoArrows: false,
		dropShadows: false
	});


	/*--- Responsive (Select) Menu ---*/

	$('.ml-select-menu').change(function(){

		var go_to = $(this).children(':selected').val();

		window.location.replace(go_to);

	});



	/*-------------------------------------------------*/
	/*	3. PORTFOLIO
	/*-------------------------------------------------*/



	/*--- Grid ---*/

	$('.ml-port-block').isotope({
		animationEngine  : 'best-available',
		animationOptions : {
			duration: 750,
			easing: 'linear',
			queue: false
		},
		itemSelector     : '.ml-pthumb',
		layoutMode       : 'fitRows'
	});

	function ml_resize_port_block() {
		$('.ml-port-block').each(function(){

			var port_parent_width = Math.ceil($(this).parent().width());
			var port_cols         = parseInt($(this).attr('data-cols'));
			var blocks_space      = 300;
			var new_width, new_margin;

			if( port_parent_width < ((blocks_space*2)-40) ) {
				new_width  = blocks_space*1;
				new_margin = (port_parent_width - new_width) / 2;

			} else if( port_parent_width < ((blocks_space*3)-40) ) {
				new_width  = blocks_space*2;
				new_margin = (port_parent_width - new_width) / 2;

			} else if( port_parent_width < ((blocks_space*4)-40) ) {
				new_width  = blocks_space*3;
				new_margin = (port_parent_width - new_width) / 2;

			} else {
				new_width  = '103.448275%';
				new_margin = '-1.515151515%';
				
			}

			$(this).width(new_width);
			$(this).css('margin-left', new_margin );

		});
	}

	ml_resize_port_block();

	$(window).resize(function() {
		ml_resize_port_block();
	});




	/*--- Filter ---*/

	$('.ml-filters li a').live('click',function(){

		$('.ml-selected').removeClass('ml-selected').addClass('ml-unselected');
		$(this).addClass('ml-selected').removeClass('ml-unselected');

		var selector = $(this).attr('data-filter');

		$(this).closest('.ml-grid').find('.ml-port-block').isotope({ filter: selector });

		return false;

	});



	/* Resize images to fit the browser */

	var fit_images = false;

	function ml_fit_images(fit_images, the_images) {

		var browser_width  = $(window).outerWidth();
		var browser_height = window.innerHeight ? window.innerHeight : $(window).outerHeight();

		the_images.each(function(){

			var initial_image_width  = parseInt($(this).attr('width'));
			var initial_image_height = parseInt($(this).attr('height'));

			var image_ratio   = initial_image_width / initial_image_height;
			var browser_ratio = browser_width / browser_height;

			var ratio;
			if ( fit_images ) {
				ratio = (image_ratio < browser_ratio)
					? initial_image_width / browser_width
					: initial_image_height / browser_height;
			} else {
				ratio = (image_ratio > browser_ratio)
					? initial_image_width / browser_width
					: initial_image_height / browser_height;
			}

			var new_image_height = (initial_image_height / ratio);
			var new_image_width  = (initial_image_width / ratio);

			$(this).css({
				'height' : new_image_height,
				'left'   : (browser_width - new_image_width) / 2,
				'top'    : (browser_height - new_image_height) / 2,
				'width'  : new_image_width
			});

		});
		
	}

	ml_fit_images(fit_images, $('.ml-pimage img'));

	$(window).resize(function() {
		ml_fit_images(fit_images, $('.ml-pimage img'));
	});



	/* Resize videos to fit the browser (needs fitVids.js) */

	function ml_fit_videos() {

		$('.ml-fit').fitVids();

		var browser_width  = $(window).outerWidth();
		var browser_height = window.innerHeight ? window.innerHeight : $(window).outerHeight();

		$('.ml-phtml iframe').each(function(){

			var initial_video_width  = parseInt($(this).attr('width'));
			var initial_video_height = parseInt($(this).attr('height'));

			var video_ratio   = initial_video_width / initial_video_height;
			var browser_ratio = browser_width / browser_height;

			var ratio = (video_ratio > browser_ratio)
				? initial_video_width / browser_width
				: initial_video_height / browser_height;

			var new_video_height = (initial_video_height / ratio);
			var new_video_width  = (initial_video_width / ratio);

			$(this).closest('.fluid-width-video-wrapper').css({
				'margin-top'  : (browser_height - new_video_height) / 2
			});

			$(this).closest('.ml-fit').css({
				'margin-left'  : (browser_width - new_video_width) / 2,
				'margin-right' : (browser_width - new_video_width) / 2
			});

		});

		$('.ml-try-middle').css({
			width : browser_width,
			height : browser_height
		});
		
	}

	ml_fit_videos();

	$(window).resize(function() {
		ml_fit_videos();
	});




	/*--- Click Grid Item ---*/

	// if($.support.fullscreen){

	// 	$('.ml-pfull-link').click(function(){
	// 		$('#ml-portal').fullScreen();
	// 	});
	// }



	/*--- Thumbnails Nav ---*/

	$('.ml-pthumblink').live('click',function(){

		var go_to = parseInt($(this).children('span').html());

		$('.ml-pthumblink.ml-active').removeClass('ml-active');

		$(this).addClass('ml-active');

		ml_update_hash(go_to);

		ml_pause_slide();

		return false;

	});




	/*--- Animate Thumbnails Block ---*/

	function ml_animate_block(animated){

		var current_block = parseInt($('#ml-current-block').val());
		var show_block    = (current_block * 220) - 220;

		if(animated) {
			$('.ml-pthumbswrap').animate({left:'-'+show_block+'px'});
			
		} else {
			$('.ml-pthumbswrap').css('left','-'+show_block+'px');

		}

	}




	/*--- Show Thumbnails Grid ---*/

	$('.ml-pgrid, .ml-pgridbox').live({

		mouseenter: function(){
	
			ml_animate_block(false);
			$('.ml-pgridbox').addClass('ml-pgridbox-active').fadeIn(300,'easeInOutQuad');
	
		},

		 mouseleave: function(){

			$('.ml-pgridbox').delay(1000).removeClass('ml-pgridbox-active');

			setTimeout(function() {
				if(!$('.ml-pgridbox').hasClass('ml-pgridbox-active')) {
					$('.ml-pgridbox').fadeOut(300, 'easeInOutQuad');
				}
			}, 1000);
		}
	});

	$('.ml-pgrid').live('click',function(){return false});

	function ml_show_block(blocks_direction) {

		var total_blocks  = parseInt($('#ml-total-blocks').val());
		var current_block = parseInt($('#ml-current-block').val());
		var go_to_block;

		if( (blocks_direction == 'next') && (current_block == total_blocks) ) {
			go_to_block = 1;

		} else if( (blocks_direction == 'prev') && (current_block == 1) ) {
			go_to_block = total_blocks;

		} else if(blocks_direction == 'next') {
			go_to_block = current_block + 1;

		} else if(blocks_direction == 'prev') {
			go_to_block = current_block - 1;

		}

		var slide_blocks = (go_to_block * 220) - 220;

		$('#ml-current-block').val(go_to_block);

		ml_animate_block(true);

	}

	function ml_show_thumbnail_num(go_to_thumbnail) {

		$('.ml-pthumbswrap .ml-active').removeClass('ml-active');

		$('.ml-pthumb-' + go_to_thumbnail + '').addClass('ml-active');

	}

	$('.ml-thumbsnav a').live('click',function(){

		var blocks_direction = $(this).attr('data-direction');

		ml_show_block(blocks_direction);

		return false;

	});




	/*--- Display Portfolio Items ---*/

	/* Settings */
	var fade_time  = 300;
	var pause_time = 5000 + fade_time;



	/*--- Fade Content ---*/

	function ml_load_image(the_content) {

		if(the_content.hasClass('ml-pimage')) {

			var the_img        = the_content.attr('data-img');
			var the_img_width  = the_content.attr('data-width');
			var the_img_height = the_content.attr('data-height');

			the_content.html('<img src="'+ the_img +'" width="'+ the_img_width +'" height="'+ the_img_height +'" />');

		}

	}

	function ml_fade_content(the_content) {

		$('.ml-pvisible').removeClass('ml-pvisible').fadeOut(fade_time, 'easeInOutQuad');


		ml_load_image(the_content);

		/*--- PreLoad Next Images ---*/

		ml_load_image(the_content.next());
		ml_load_image(the_content.next().next());
		ml_load_image(the_content.next().next().next());

		if(the_content.load()) {
			the_content.closest('.ml-to-fade').addClass('ml-pvisible').fadeIn(fade_time, 'easeInOutQuad');

		} else {
			the_content.load(function() {
				the_content.closest('.ml-to-fade').addClass('ml-pvisible').fadeIn(fade_time, 'easeInOutQuad');
			});
		}

		var current_num   = parseInt(the_content.attr('data-num'));

		var current_block = Math.ceil(current_num / 16);

		$('#ml-current-block').val(current_block);

		if(the_content.hasClass('ml-pimage')) {
			ml_fit_images(fit_images, $('.ml-pimage img'));
			
		} else {
			ml_fit_videos();

		}

		ml_start_loop();

	}



	/*--- Update Hash ---*/

	function ml_get_hash_num() {
		var current_hash = window.location.hash;
		var return_hash = parseInt(current_hash.split('/')[2]);
		if ((return_hash < 1) || (isNaN(return_hash))) return_hash = 1;
		return return_hash;
	}

	function ml_update_hash(num) {
		var current_hash = window.location.hash;
		window.location.hash = '#!/' + current_hash.split('/')[1] + '/' + num;
	}



	/*--- Show Specific Item ---*/

	function ml_show_item(direction) {

		var go_to;
		var total_items = parseInt($('.ml-pcontent').attr('data-total'));
		var current   = ml_get_hash_num();

		if( (direction == 'next') && (current >= total_items) ) {
			go_to = 1;

		} else if( (direction == 'prev') && (current <= 1) ) {
			go_to = total_items;

		} else if(direction == 'next') {
			go_to = current + 1;

		} else if(direction == 'prev') {
			go_to = current - 1;

		}

		ml_update_hash(go_to);

		ml_show_thumbnail_num(go_to);

		var total_thumbs   = $('.ml-pthumblink').length;
		var thumbs_to_wrap = 16;

	}




	/*--- Show Controls ---*/

	var timer;

	function ml_show_controls() {
		if (timer) {
			clearTimeout(timer);
			timer = 0;
		}

		$('.ml-pcontrols').fadeIn(300, 'easeInOutQuad');

		timer = setTimeout(function() {
			if(!$('html').hasClass('mobile')) {
				$('.ml-pcontrols').fadeOut(900, 'easeInOutQuad');
			}
		}, 3000);

	}

	ml_show_controls();

	$('html').mousemove(function() {
		ml_show_controls();
	});

	$('html').mousedown(function() {
		ml_show_controls();
	});




	/*--- Navigation ---*/

	$('.ml-pprev, .ml-pnext').live('click',function(){

		var direction = $(this).attr('data-direction');

		$('.ml-ppause').removeClass('ml-ppause').addClass('ml-pplay');

		ml_show_item(direction);

		ml_pause_slide();

		ml_animate_block(true);

		return false;

	});


	/*--- Close Portal ---*/

	function ml_close_port() {

		if (document.exitFullscreen) {
			document.exitFullscreen();
		} else if (document.mozCancelFullScreen) {
			document.mozCancelFullScreen();
		} else if (document.webkitCancelFullScreen) {
			document.webkitCancelFullScreen();
		}
		$(document).off( 'fullscreenchange mozfullscreenchange webkitfullscreenchange' );

		$('#ml-portal').fadeOut(1000,'easeInOutQuad', function(){
			$(this).empty();
		});

		$('#ml-portal').attr('data-loop', 'false');

		window.location.hash = '';
		stored_hash          = '';

	}

	$('.ml-pclose').live('click',function(){
		ml_close_port(); return false;

	});



	/*--- Keyboard Nav ---*/

	$('html').keydown(function(key){

		if(window.location.hash.split('/')[0] == '#!') {

			if( (key.keyCode == 37) || (key.keyCode == 38) ) {
				ml_show_item('prev');
			}

			else if( (key.keyCode == 39) || (key.keyCode == 40) ) {
				ml_show_item('next');
			}

			else if(key.keyCode == 27) {
				ml_close_port();
			}

		}

	});







	/*--- Loop, Play and Pause ---*/

	function ml_start_loop(){

		var play = $('#ml-portal').attr('data-loop');
		var current_hash = window.location.hash;

		if( (play == 'true') && (current_hash.split('/')[0] == '#!') ) {

			setTimeout(transition, pause_time);

			function transition() {

				var current = ml_get_hash_num();

				var play = $('#ml-portal').attr('data-loop');
				if(play == 'true')
					ml_show_item('next');

			}

		}

	}

	function ml_pause_slide() {

		$('.ml-pplaypause').removeClass('ml-ppause').addClass('ml-pplay');

		$('#ml-portal').attr('data-loop','false');

	}

	$('.ml-ppause').live('click', function(){

		ml_pause_slide();

		return false;

	});

	$('.ml-pplay').live('click', function(){

		var current = ml_get_hash_num();

		ml_animate_block(true);

		$(this).removeClass('ml-pplay').addClass('ml-ppause');

		$('#ml-portal').attr('data-loop','true');

		ml_show_item('next');

		return false;

	});



	/*--- Launch Portfolio Item ---*/

	var stored_hash = false;

	setInterval(function() {

		var live_hash = window.location.hash;

		if ( (live_hash.split('/')[0] != '#!') && ($('.ml-pcontent').length > 0) ) {
			ml_close_port();

		} else if( (live_hash != stored_hash) && (live_hash != '') ) {

			stored_hash = window.location.hash;

			var post_slug = stored_hash.split('/')[1];
			var post_img  = stored_hash.split('/')[2];

			if(post_img < 1)
				post_img = 1;

			var the_id = $(this).attr('data-id');

			var ajax_data = {
				action    : 'ml_portfolio_content',
				post_slug : post_slug
			};

			var current_slug = $('.ml-pcontent').attr('data-slug');

			if (current_slug == post_slug) {
				ml_fade_content($('.ml-pcontent .ml-pitem:nth-child(' + post_img + ')'));

			} else if (stored_hash.split('/')[0] == '#!') {
				$.post(ml_ajax.ajaxurl, ajax_data, function(response) {

					if(response != 'error') {
						$('#ml-portal').html(response).fadeIn(750,'easeInOutQuad',function(){
							$(this).addClass('ml-visible');
							ml_fade_content($('.ml-pcontent .ml-pitem:nth-child(' + post_img + ')'));

						});

					} else {
						alert('Error: cannot get item content.');

					}

				});

				
			}

		}

	}, 100);  



	/*-------------------------------------------------*/
	/*	4. BACKGROUND
	/*-------------------------------------------------*/


	/*--- Video Background ---*/

	var video_bg_width  = parseInt($('#ml-video-bg-width').val());
	var video_bg_height = parseInt($('#ml-video-bg-height').val());

	function ml_fit_video_bg() {

		var browser_width  = $(window).outerWidth();
		var browser_height = window.innerHeight ? window.innerHeight : $(window).outerHeight();

		var video_bg_ratio  = video_bg_width / video_bg_height;
		var browser_ratio = browser_width / browser_height;

		var ratio = (video_bg_ratio < browser_ratio)
			? video_bg_width / browser_width
			: video_bg_height / browser_height;

		var new_video_bg_width  = (video_bg_width / ratio);
		var new_video_bg_height = (video_bg_height / ratio);

		$('.ml-video-bg-wrapper').css({
			'height' : new_video_bg_height,
			'left'   : (browser_width - new_video_bg_width) / 2,
			'top'    : (browser_height - new_video_bg_height) / 2,
			'width'  : new_video_bg_width
		});

	}

	ml_fit_video_bg();

	$(window).resize(function() {
		ml_fit_video_bg();
	});


	var background_type = $('#ml-bg-type').val();
	var file_m4v        = $('#ml-m4v').val();
	var file_ogv        = $('#ml-ogv').val();

	function ml_fire_video_bg() {
		$("#ml-video-bg").jPlayer({
			loop: true,
			ready: function () {
				$(this).jPlayer("setMedia", {
					m4v: file_m4v,
					ogv: file_ogv
				}).jPlayer("play");
			},
			swfPath: "<?php echo get_template_directory_uri() ?>/js/libs",
			supplied: "m4v, ogv"
		});
	}



	/*--- Image Slider Background ---*/

	var bg_pause_time = <?php echo $bg_slide_speed ?>;
	var bg_fade_time  = <?php echo $bg_anim_duration ?>;

	function ml_fire_slider_bg() {

		/*--- Build Slider ---*/

		$('body').prepend('<div class="ml-sldbg" />');

		var slider_images = $('.ml-bg-slide-num');

		var slide_url, slide_width, slide_height;
		slider_images.each(function(){

			slide_url    = $(this).val();
			slide_width  = $(this).attr('data-width');
			slide_height = $(this).attr('data-height');

			$('.ml-sldbg').append('<div class="ml-sldbg-item ml-to-fade"><img src="'+slide_url+'" width="'+slide_width+'" height="'+slide_height+'" /></div>');

		});


		/*--- Fit Images ---*/

		var bg_images = $('.ml-sldbg-item img');

		if (!$('html').hasClass('mobile')) {
			ml_fit_images(true, bg_images);
		} else {
			$('html, body').animate(
				{ scrollTop: $('body').offset().top},
				300,function(){
				ml_fit_images(true, bg_images);
			});
		}


		$(window).resize(function() {
			ml_fit_images(true, bg_images);
		});


		/*--- Show First Image ---*/

		var first_bg_slide = ($('.ml-sldbg .ml-sldbg-item:first'));

		if(first_bg_slide.load()) {
			first_bg_slide.closest('.ml-to-fade').addClass('ml-svisible').animate({opacity:1},bg_fade_time,'easeInOutQuad');

		} else {
			first_bg_slide.load(function() {
				first_bg_slide.closest('.ml-to-fade').addClass('ml-svisible').animate({opacity:1},bg_fade_time,'easeInOutQuad');
			});
		}


		/*--- Start Loop ---*/

		function ml_slider_bg_show(current_sld) {

			var go_to_sld = (current_sld == slider_images.length)
				? 1
				: current_sld + 1;

			$('.ml-sldbg-item.ml-svisible').removeClass('ml-svisible').animate({opacity:0},bg_fade_time,'easeInOutQuad');

			var the_slide = ($('.ml-sldbg .ml-sldbg-item:nth-child(' + go_to_sld + ')'));

			if(the_slide.load()) {
				the_slide.closest('.ml-to-fade').addClass('ml-svisible').animate({opacity:1},bg_fade_time,'easeInOutQuad');

			} else {
				the_slide.load(function() {
					the_slide.closest('.ml-to-fade').addClass('ml-svisible').animate({opacity:1},bg_fade_time,'easeInOutQuad');
				});
			}

		}

		if(slider_images.length > 1) {

			function ml_slider_bg_loop() {
				var current_sld = $('.ml-sldbg .ml-svisible').index() + 1;
				ml_slider_bg_show(current_sld);
				setTimeout(ml_slider_bg_loop, bg_pause_time);			

			}

			setTimeout(ml_slider_bg_loop, bg_pause_time);

		}

	}




	if( (!$('html').hasClass('mobile')) && (background_type == 'video') ) {
		ml_fire_video_bg();
		
	} else {
		ml_fire_slider_bg();

	}




	/*-------------------------------------------------*/
	/*	5. BLOG
	/*-------------------------------------------------*/

	$('.ml-full-image').live('click',function(){

		return false;

	});



	/*-------------------------------------------------*/
	/*	6. SLIDER
	/*-------------------------------------------------*/

	$('.ml-gallery').flexslider({

		animation    : 'fade',
		controlNav   : false,
		slideshow    : false,
		smoothHeight : true,
		prevText: "&#x3c;",
		nextText: "&#x3e;"

	});


	/*-------------------------------------------------*/
	/*	7. FLEX-SLIDER
	/*-------------------------------------------------*/

	if($('.ml-fx-slider').length > 0) {

		function ml_resize_fx(){

			$('.ml-fx-slide').each(function(){

				var height     = $(this).attr('data-height');
				var current_width  = $(this).outerWidth();

				$(this).css('height', ml_rot(1160, height, current_width));
				
			});

		}

		$(window).resize(function() {
		  
		  ml_resize_fx();

		});

		function ml_dir_animate(slider, num){

			slider.find('.ml-slide-'+num+' .ml-fx-element').each(function(){

				if(!$(this).closest('.ml-slide-'+num).hasClass('clone')){

					var duration   = parseInt($(this).attr('data-duration'));
					var wait       = parseInt($(this).closest('.ml-fx-slide').attr('data-wait'));
					var delay      = wait + parseInt($(this).attr('data-delay'));
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

				}

			});

		}


		$('.ml-fx-slider').flexslider({

			animation         : '<?php echo $anim_type ?>',
			animationDuration : <?php echo $anim_duration ?>,
			animationLoop     : <?php echo $anim_loop ?>,
			controlNav        : false,
			pauseOnAction     : <?php echo $anim_pause_action ?>,
			pauseOnHover      : <?php echo $anim_pause_hover ?>,
			randomize         : <?php echo $randomize ?>,
			slideshowSpeed    : <?php echo $slide_speed ?>,
			prevText          : "&#x3c;",
			nextText          : "&#x3e;",

			start: function(slider){
				ml_resize_fx();

				var slide = $('.ml-slide-1');
				if ( slide.hasClass('ml-fx-slide') ) {

					ml_dir_animate(slider, 1);

				}
			},

			before: function(slider){
				var num   = slider.animatingTo + 1;
				var slide = $('.ml-slide-'+num);
				if ( slide.hasClass('ml-fx-slide') ) {
					
					ml_dir_animate(slider, num);
				}
			}

		});

	}



	/*-------------------------------------------------*/
	/* 8. OTHER
	/*-------------------------------------------------*/


	/*--- Back to Top ---*/

	$('.ml-back-to-top').click(function(){

		$('html, body').animate({ scrollTop: $('body').offset().top}, 600, 'easeInOutQuad');

		return false;

	});


	/*--- Tabs ---*/

	if($(".ml-ui-tabs").length > 0)
		$(".ml-ui-tabs").tabs({ fx: { opacity: 'toggle', duration: 100 } });
		
	
	/*--- Toggle ---*/
	
	$('.ml-toggle .ml-toggle-title').click(function() {
		/* only one is allowed to be visible */
		if($(this).parent().is('.ml-one-allowed')){
			if($(this).is('.ml-toggle-active')) {
				$(this).find('span').html('+');
				$(this).parent().children('.ml-toggle .ml-toggle-title').removeClass('ml-toggle-active').next().slideUp(200);
			}
			else {
				$(this).parent().children('.ml-toggle-title').removeClass('ml-toggle-active').next().slideUp(200);
				$(this).parent().find('.ml-toggle-title > a > span').html('+');
				$(this).removeClass('ml-toggle-active').next().slideUp(200);
				$(this).find('span').html('-');
				$(this).toggleClass('ml-toggle-active').next().slideToggle(100);
			}
		}

		/* normal */
		else {
			$(this).toggleClass('ml-toggle-active').next().slideToggle(100);
			if($(this).is('.ml-toggle-active')) {
				$(this).find('span').html('-');
			}
			else {
				$(this).find('span').html('+');
			}
		}
		return false;
	}).next().hide();
	
	/* if is choosed to start with the first toggle oppened */
	$('.ml-toggle.ml-toggle-first .ml-toggle-title:first').addClass('ml-toggle-active').find('span').html('-');
	$('.ml-toggle.ml-toggle-first .ml-toggle-title:first').next().slideToggle('400');


	/*--- Welcome Message ---*/

	function ml_welcome_loop() {

		$('.ml-wlcm').each(function(){

			var total_welc = $(this).find('.ml-welc-cont').length;

			if(total_welc > 1) {

				var active_num    = parseInt($(this).find('.ml-active-welc').attr('data-rel'));
				var go_to_welcome = active_num + 1;

				if(go_to_welcome > total_welc)
					go_to_welcome = 1;

				$(this).find('.ml-active-welc').removeClass('ml-active-welc').fadeOut(300,'easeInOutQuad',function(){
					$(this).siblings('[data-rel='+go_to_welcome+']').addClass('ml-active-welc').fadeIn(300,'easeInOutQuad');

				});
				
				setTimeout(ml_welcome_loop, 3000);

			}

		});
	}

	setTimeout(ml_welcome_loop, 3000);
	


});