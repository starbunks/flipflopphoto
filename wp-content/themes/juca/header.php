<?php

global $post;

$post_id      = ($post) ? $post->ID : NULL;

$fixed_header = of_get_option('ml-fixed-header');

$header_class = ($fixed_header == 1)
	? 'ml-fixed-header'
	: 'ml-animated-header';

?>

<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri() ?>/js/libs/css3-mediaqueries.js"></script>
<![endif]-->

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title><?php echo ml_seo_title($post_id) ?></title>
	<meta name="description" content="<?php echo ml_seo_description($post_id) ?>">
	<meta name="keywords" content="<?php echo ml_seo_keywords($post_id) ?>">
	<meta name="robots" CONTENT="<?php echo ml_seo_robots($post_id) ?>">
	<?php ml_theme_favicon() ?>

	<meta name="viewport" content="width=device-width,initial-scale=1">

	<?php echo ml_get_google_fonts(); ?>

	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/images/socialicons/socialicons.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/images/themeicons/themeicons.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/images/posticons/posticons.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/base.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/style.css.php">


	<?php

	/*--- Load jQuery scripts ---*/

	wp_enqueue_script('fitvids');
	wp_enqueue_script('superfish');
	wp_enqueue_script('easing');
	wp_enqueue_script('metadata');
	wp_enqueue_script('jplayer');
	wp_enqueue_script('isotope');
	wp_enqueue_script('fullscreen');
	wp_enqueue_script('flexslider');


	wp_enqueue_script('ml_plugins');
	wp_enqueue_script('ml_scripts');
	wp_localize_script( 'ml_scripts', 'ml_ajax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );  
	

	/*--- User Custom Codes ---*/

	ml_google_analytics();
	ml_custom_js();
	ml_custom_css();

	wp_head();

	?>


</head>
<body <?php body_class($header_class); ?>>
	<!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->

	<?php

	/*--- Other ---*/

	ml_video_alert();

	ml_get_bg($post_id);

	?>

	<div id="ml-portal" class="ml-portal" data-loop="false"></div>

	<!-- .ml-video-bg-wrapper -->
	<div class="ml-video-bg-wrapper">
		<input type="hidden" name="ml-video-bg-width" id="ml-video-bg-width" value="480">
		<input type="hidden" name="ml-video-bg-height" id="ml-video-bg-height" value="270">
		<div id="ml-video-bg" class="jp-jplayer ml-video-bg"></div>	
	</div>
	<!-- /.ml-video-bg-wrapper -->


	<!-- #header -->
	<div id="header" class="ml-header">
		
		<!-- .ml-wrapper -->
		<div class="ml-wrapper">
			
			<!-- .ml-social -->
			<ul class="ml-social">

				<?php dynamic_sidebar('ml-social'); ?>

			</ul>
			<!-- /.ml-social -->

			<div class="clearfix ml-header-clear"></div>

			<?php

				/*--- Header Menu ---*/
				if ( has_nav_menu( 'ml-header-menu' ) ) {
					wp_nav_menu(
						array(
							'container' 		=> false,
							'menu_class'		=> 'ml-head-menu ml-a-anim',
							'theme_location'	=> 'ml-header-menu'
						)
					);
				} else {

					echo '<p>' . __('You need to <a href="' . home_url() .'/wp-admin/nav-menus.php" target="_blank">build your menu</a>.', 'meydjer') . '</p>';

				}

				if ( has_nav_menu( 'ml-header-menu' ) )
					wp_nav_menu(array(
						'container' 		=> false,
						'items_wrap'     => '<select class="ml-select-menu">%3$s</select>',
						'theme_location'	=> 'ml-header-menu',
						'walker'         => new Walker_Nav_Menu_Dropdown()
					));

			?>

		</div>
		<!-- /.ml-wrapper -->
	</div>
	<!-- /#header -->


	<!-- .ml-h-arrow -->
	<div class="ml-h-arrow">
		<!-- .ml-h-bar -->
		<div class="ml-h-bar"></div>
		<!-- /.ml-h-bar -->
		&#x56;
	</div>
	<!-- /.ml-h-arrow -->



	<div class="clearfix"></div>


	<!-- .ml-logo -->
	<?php echo ml_theme_logo(); ?>
	<!-- /.ml-logo -->


	<div class="clearfix"></div>
