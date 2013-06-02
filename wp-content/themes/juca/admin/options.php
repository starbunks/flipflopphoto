<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'options_framework_theme'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {


	/*--- Prefix ---*/
	$prefix = 'ml-';


	/*--- Fonts Num ---*/
	$slides_num = 10;
	$slides_num_array = array();
	for ($i=1; $i <= $slides_num; $i++) { 
		$slides_num_array[$i] = $i;
	}

	/*--- Fonts Num ---*/
	$fonts_num = 10;
	$fonts_num_array = array();
	for ($i=1; $i <= $fonts_num; $i++) { 
		$fonts_num_array[$i] = $i;
	}

	/*--- Header Menu Items ---*/
	if ( has_nav_menu( 'ml-header-menu' ) ) {

		$menu_locations = get_nav_menu_locations();
		$menu = wp_get_nav_menu_items( $menu_locations['ml-header-menu'] );

		$menu_array = array('none' => __('Select one item:', 'meydjer'));
		foreach($menu as $menu_item) {
			$menu_array[$menu_item->ID] = $menu_item->post_title;
		}
		
	} else {

		$menu_array = array('none' => __('You need to build your menu.', 'meydjer'));

	}


	// Pull all the categories into an array
	$options_categories = array();  
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
    	$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all the pages into an array
	$options_pages = array();  
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages['none'] = __('Select a page:', 'meydjer');
	foreach ($options_pages_obj as $page) {
    	$options_pages[$page->ID] = $page->post_title;
	}
		
	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/admin/images/';
		
	$options = array();


	/*-------------------------------------------------*/
	/*	BASIC
	/*-------------------------------------------------*/

	$options[] = array(
		"name"		=> __('Basic', 'meydjer'),
		"type"		=> "heading"
	);


		$options[] = array(
			"name"		=> __('Fixed Header', 'meydjer'),
			"id"			=> $prefix."fixed-header",
			"desc"		=> __("Click if you don't want the animated version.", 'meydjer'),
			"type"		=> "checkbox"
		);


		$options[] = array(
			"name"		=> __('Favicon', 'meydjer'),
			"id"			=> $prefix."favicon",
			"desc"		=> __('16x16 pixels. .ico format', 'meydjer'),
			"type"		=> "upload"
		);


		$options[] = array(
			"name"		=> __('Footer Columns', 'meydjer'),
			"id"			=> $prefix."footer_columns",
			"type"		=> "images",
			"std"			=> '0',
			"options" => array(
				1 => $imagepath . 'footer-1col.gif',
				2 => $imagepath . 'footer-2cols.gif',
				3 => $imagepath . 'footer-3cols.gif',
				4 => $imagepath . 'footer-4cols.gif',
				0 => $imagepath . 'none.gif'
			)
		);

		$options[] = array(
			"name"		=> __('Copy Text', 'meydjer'),
			"id"			=> $prefix."copy",
			"desc"		=> __('(Optional)', 'meydjer'),
			"type"		=> "html",
			"class"		=> "last_option",
			"std"			=> __('&copy; Copyright 2012 &nbsp;&ndash;&nbsp; Juca WordPress Theme. All rights reserved.', 'meydjer')
		);



	/*-------------------------------------------------*/
	/*	BACKGROUND SLIDER
	/*-------------------------------------------------*/

	$options[] = array(
		"name"  => __('Default Background', 'meydjer'),
		"type"  => "heading"
	);

		$options[] = array(
			"name"     => __('Default Background', 'meydjer'),
			"id"       => $prefix . "bg-type",
			"type"     => "radio",
			"desc"     => __("<strong>Note:</strong> You will need to setup an image slider as a fallback for mobile devices (they don't allow video autoplay).", 'meydjer'),
			"std"      => 'video',
			"options"  => array(
				'video'  => __('Video', 'meydjer'),
				'images' => __('Images', 'meydjer')
			)
		);

		$options[] = array(
			"name"		=> __('Video', 'meydjer'),
			"desc"		=> "",
			"class"		=> "of_headline video_headline",
			"type"		=> "info"
		);

			$options[] = array(
				"name"		=> __('M4V video file', 'meydjer'),
				"id"			=> $prefix."m4v",
				"desc"		=> __('<strong>Tip</strong>: You can just change your ".mp4" video extension to ".m4v". <br><br>You will need the ".ogv" version too.', 'meydjer'),
				"type"		=> "upload"
			);

			$options[] = array(
				"name"		=> __('OGV video file', 'meydjer'),
				"id"			=> $prefix."ogv",
				"desc"		=> __('<strong>Tip</strong>: If you need, you can convert your video to ".ogv" at <a href="http://video.online-convert.com/convert-to-ogg" target="_blank">Online-Convert.com</a>. <br><br>You will need the ".m4v" version too.', 'meydjer'),
				"type"		=> "upload"
			);

		$options[] = array(
			"name"		=> __('Images', 'meydjer'),
			"desc"		=> "",
			"class"		=> "of_headline",
			"type"		=> "info"
		);

			$options[] = array(
				"name"  => __('Animation Duration', 'meydjer'),
				"id"    => $prefix."bg-anim-duration",
				"class" => "micro",
				"type"  => "text",
				"desc"  => __('Set the speed of animation, in milliseconds.', 'meydjer'),
				"std"   => '1000'
			);

			$options[] = array(
				"name"  => __('Slideshow Speed', 'meydjer'),
				"id"    => $prefix."bg-slide-speed",
				"class" => "micro",
				"type"  => "text",
				"desc"  => __('Set the speed of the slideshow cycling, in milliseconds.', 'meydjer'),
				"std"   => '5000'
			);

			$options[] = array(
				"name"    => __('Slides Number', 'meydjer'),
				"id"      => $prefix."bg-slide-num",
				"type"    => "select",
				"std"     => "slide",
				"class"   => "micro",
				"options" => $slides_num_array
			);

			foreach ($slides_num_array as $num) {
				$options[] = array(
					"name"		=> __('Image #', 'meydjer') . $num,
					"class"		=> 'ml-bg-slide-num',
					"id"			=> $prefix."bg-slide-" . $num,
					"type"		=> "upload"
				);
			}



	/*-------------------------------------------------*/
	/*	SLIDER
	/*-------------------------------------------------*/

	$options[] = array(
		"name"		=> __('Slider', 'meydjer'),
		"type"		=> "heading"
	);

		$options[] = array(
			"name"    => __('Animation Type', 'meydjer'),
			"id"      => $prefix."anim-type",
			"type"    => "select",
			"std"     => "slide",
			"class"   => "mini",
			"desc"    => __('Select your animation type, "Fade" or "Slide"', 'meydjer'),
			"options" => array(
				'fade'  => __('Fade', 'meydjer'),
				'slide' => __('Slide', 'meydjer')
				)
		);

		$options[] = array(
			"name"  => __('Animation Duration', 'meydjer'),
			"id"    => $prefix."anim-duration",
			"class" => "micro",
			"type"  => "text",
			"desc"  => __('Set the speed of animations, in milliseconds.', 'meydjer'),
			"std"   => '600'
		);

		$options[] = array(
			"name"  => __('Slideshow Speed', 'meydjer'),
			"id"    => $prefix."slide-speed",
			"class" => "micro",
			"type"  => "text",
			"desc"  => __('Set the speed of the slideshow cycling, in milliseconds.', 'meydjer'),
			"std"   => '8000'
		);

		$options[] = array(
			"name" => __('Animation Loop', 'meydjer'),
			"id"   => $prefix."anim-loop",
			"type" => "checkbox",
			"desc" => __('Should the animation loop?', 'meydjer'),
			"std"  => '1'
		);

		$options[] = array(
			"name" => __('Pause on Action', 'meydjer'),
			"id"   => $prefix."anim-pause-action",
			"type" => "checkbox",
			"desc" => __('Pause the slideshow when interacting with control elements. Highly recommended.', 'meydjer'),
			"std"  => '1'
		);

		$options[] = array(
			"name" => __('Pause on Hover', 'meydjer'),
			"id"   => $prefix."anim-pause-hover",
			"type" => "checkbox",
			"desc" => __('Pause the slideshow when hovering over slider, then resume when no longer hovering.', 'meydjer'),
			"std"  => '0'
		);

		$options[] = array(
			"name" => __('Randomize', 'meydjer'),
			"id"   => $prefix."randomize",
			"type" => "checkbox",
			"desc" => __('Randomize slide order.', 'meydjer'),
			"std"  => '0'
		);



	/*-------------------------------------------------*/
	/*	TYPOGRAPHY
	/*-------------------------------------------------*/

	$options[] = array(
		"name"		=> __('Typography', 'meydjer'),
		"type"		=> "heading"
	);

		$options[] = array(
			"name"		=> __('Fonts Number', 'meydjer'),
			"id"			=> $prefix . "fonts_num",
			"type"		=> "select",
			"std"			=> 5,
			"class"		=> 'micro',
			"options"	=> $fonts_num_array
		);

		/*--- Start the Fonts Loop ---*/
		for ($num=1; $num <= $fonts_num; $num++) { 

			if($num == 1) {
				$font_std 	= 'google';
				$google_std	= "Droid Sans:regular";
				$apply_std 	= 'body, .ml-post-entry .ml-quote-author, .ml-status-text, .ml-link-text a, .ml-chat-text, .ml-comment-content p';
			} else if ($num == 2) {
				$font_std 	= 'google';
				$google_std	= "Droid Sans:700";
				$apply_std 	= 'strong, b, .ml-head-menu li a, .ml-filters li a, .ml-entry-title h2, .wpcf7-submit, .ml-button, .ml-readm-link span, .ml-post-entry .ml-tags, .ml-post-entry .ml-tags strong';					
			} else if ($num == 3) {
				$font_std 	= 'google';
				$google_std	= "Droid Serif:regular";
				$apply_std 	= '.ml-copy, .ml-post-entry p';					
			} else if ($num == 4) {
				$font_std 	= 'google';
				$google_std	= "Droid Serif:700";
				$apply_std 	= 'strong, b';					
			} else if ($num == 5) {
				$font_std 	= 'google';
				$google_std	= "Droid Serif:italic";
				$apply_std 	= 'em, i, blockquote, .ml-post-entry blockquote p, .ml-wlcm, .ml-pthumb-title, .ml-caption';
			} else {
				$font_std 	= 'google';
				$google_std	= "Droid Sans:regular";
				$apply_std 	= '';					
			}

			$options[] = array(
				"name"		=> __('Font #', 'meydjer') . $num,
				"id"			=> $prefix . "font-" . $num,
				"type"		=> "radio",
				"class"		=> "ml-fonts",
				"std"			=> $font_std,
				"data-rel"	=> $num,
				"options"	=> array(

					'google' 	=> 'Google Webfonts',
					'standard'	=> __('Standard Fonts', 'meydjer')

				)
			);

			$options[] = array(
				"id"			=> $prefix . "google_fonts-" . $num,
				"type"		=> "select",
				"std"			=> $google_std,
				"desc"		=> '<a href="http://www.google.com/webfonts">Google Webfonts Demo</a>',
				"options"	=> ml_google_fonts()
			);

			$options[] = array(
				"id"			=> $prefix . "standard_fonts-" . $num,
				"type"		=> "select",
				"std"			=> '"Helvetica Neue", Helvetica, Arial, Clean, Garuda, sans-serif',
				"options"	=> ml_standard_fonts()
			);

			$options[] = array(
				"id"			=> $prefix . "apply_font_to-" . $num,
				"desc"		=> __('The CSS keys to apply.', 'meydjer'),
				"std"			=> $apply_std,
				"type"		=> "textarea"
			);

		}



	/*-------------------------------------------------*/
	/*	ADVANCED
	/*-------------------------------------------------*/

	$options[] = array(
		"name"		=> __('Advanced', 'meydjer'),
		"type"		=> "heading"
	);

	$options[] = array(
		"name"		=> __('Built-in SEO', 'meydjer'),
		"id"			=> $prefix."built-in_seo",
		"desc"		=> __('Uncheck it if you want to use a 3th party SEO Plugin.', 'meydjer'),
		"std"			=> 1,
		"type"		=> "checkbox"
	);

	$options[] = array(
		"name"		=> __('Login Image', 'meydjer'),
		"id"			=> $prefix."login-image",
		"desc"		=> __('Customize the image of your login screen. (Maximum Size: 310x145 pixels.)', 'meydjer'),
		"type"		=> "upload"
	);

	$options[] = array(
		"name"		=> __('Google Analytics Code', 'meydjer'),
		"id"			=> $prefix."google-analytics",
		"desc"		=> __('Put your Google Analytics code here.', 'meydjer'),
		"type"		=> "html"
	);

	$options[] = array(
		"name"		=> __('Custom JavaScript Code', 'meydjer'),
		"id"			=> $prefix."custom-js",
		"desc"		=> __('Paste your custom JS code here.', 'meydjer'),
		"type"		=> "html"
	);

	$options[] = array(
		"name"		=> __('Custom CSS Code', 'meydjer'),
		"id"			=> $prefix."custom-css",
		"desc"		=> __('Paste your custom CSS code here.', 'meydjer'),
		"type"		=> "html"
	);


	return $options;
}

add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts() { ?>

<style type="text/css">

#optionsframework .of_headline h4 {
	border-bottom: 4px solid #f5f5f5 !important;
	border-top: 4px solid #f5f5f5;
	color: #d54e21;
	font: 30px "HelveticaNeue-Light","Helvetica Neue Light","Helvetica Neue",sans-serif;
	line-height: 250%;
	margin: 20px 0 !important;
	padding-left: 12px !important;
	text-align: center;
}

#optionsframework .of_image {
	margin:-30px 0 -30px 10px;
	padding:0;
	text-align: center;
}

#optionsframework .of_image h4 {
	border-bottom: 0 !important;
}

.last_option {
	margin-bottom: 80px;
}

#optionsframework .ml-fonts .of-radio {
	clear: none;
	width: 22px;
}

#optionsframework .ml-fonts label {
	margin-right:20px;
}

#optionsframework .micro .controls input,
#optionsframework .micro .controls select {
	width: 50px;
}

.ml-hide-font-config {
	display: none;
}

#optionsframework .section.three_images_column .controls {
	width:53%;
}

#optionsframework #section-ml-bg-type input.of-radio {
	clear: none;
	width: 25px;
}

#optionsframework #section-ml-bg-type label {
	margin-right:1.5em;
}

#section-ml-bg-type .explain,
.video_headline,
#section-ml-m4v,
#section-ml-ogv {
	display: none;
}

.ml-bg-slide-num {
	display: none;
}


</style>

<script type="text/javascript">
	
jQuery(document).ready(function($) {

	/*-------------------------------------------------*/
	/* Options Panel - Background
	/*-------------------------------------------------*/

	/*--- Change between video and images ---*/

	var video_elements = $('#section-ml-bg-type .explain, .video_headline, #section-ml-m4v, #section-ml-ogv');

	if($('#juca-ml-bg-type-video').is(':checked'))
		video_elements.show();

	$('#juca-ml-bg-type-video').click(function(){
		video_elements.fadeIn(300);
			$('#section-ml-bg-type .explain').animate(
				{'background-color': 'red',
				'color':'#fff'},function(){
					$(this).animate(
					{'background-color': 'transparent',
					'color':'#777'});
				}
				);
	});	

	$('#juca-ml-bg-type-images').click(function(){
		video_elements.fadeOut(300);
	});


	/*--- Select Images Num ---*/

	var images_num   = parseInt($('#ml-bg-slide-num').val());
	var total_images = $('.ml-bg-slide-num').length;

	for (var num = 1; num <= images_num; num++) {
		$('#section-ml-bg-slide-'+num).show();
	};

	$('#ml-bg-slide-num').change(function(){

		var images_to_show = parseInt($(this).val());

		for (var num = 1; num <= images_to_show; num++) {
			$('#section-ml-bg-slide-'+num).fadeIn();
		};

		var images_to_hide = images_to_show + 1;

		for (var num = images_to_hide; num <= total_images; num++) {
			$('#section-ml-bg-slide-'+num).fadeOut();
		};

	});

});

</script>

<?php
}