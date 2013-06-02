<?php

/*-------------------------------------------------*/
/*	Localization
/*-------------------------------------------------*/
load_theme_textdomain('meydjer', get_template_directory() . '/lang');



/*-------------------------------------------------*/
/*	Register and load common JavaScripts
/*-------------------------------------------------*/

/*--- Load other scripts ---*/
function ml_register_js() {

	wp_register_script('fitvids', get_template_directory_uri() . '/js/libs/jquery.fitvids.min.js', 'jquery', '1.0');
	wp_register_script('easing', get_template_directory_uri() . '/js/libs/jquery.easing.min.js', 'jquery', '1.0');

	wp_register_script('superfish', get_template_directory_uri() . '/js/libs/superfish.min.js', 'jquery', '1.0');
	wp_register_script('metadata', get_template_directory_uri() . '/js/libs/jquery.metadata.js', 'jquery', '1.0');
	wp_register_script('jplayer', get_template_directory_uri() . '/js/libs/jquery.jplayer.min.js', 'jquery', '1.0');
	wp_register_script('isotope', get_template_directory_uri() . '/js/libs/jquery.isotope.min.js', 'jquery', '1.0');
	wp_register_script('fullscreen', get_template_directory_uri() . '/js/libs/jquery.fullscreen.js', 'jquery', '1.0');


	wp_enqueue_script('jquery');
	wp_enqueue_script('fitvids');
	wp_enqueue_script('easing');

	
	if (!is_admin()) {

		wp_register_script('flexslider', get_template_directory_uri() . '/js/libs/jquery.flexslider-min.js', 'jquery', '1.0');
		wp_register_script('ml_plugins', get_template_directory_uri() . '/js/plugins.js', 'jquery', '1.0');
		wp_register_script('ml_scripts', get_template_directory_uri() . '/js/script.js.php', 'jquery', '1.0');
		
	}
	

}

add_action('init', 'ml_register_js');




/*-------------------------------------------------*/
/*	Admin CSS/JS
/*-------------------------------------------------*/
function ml_admin_css() {

	$style_path = get_template_directory_uri() . '/css/admin.css';

	echo '<link rel="stylesheet" href="' . $style_path . '" type="text/css" media="screen" />';

}

function ml_admin_js() {

	if ( is_admin() ) {

		wp_register_script('ml_admin_js', get_template_directory_uri() . '/js/admin.js', 'jquery', '1.0');

		wp_enqueue_script('ml_admin_js');

	}

}

add_action('admin_head', 'ml_admin_css');
add_action('admin_head', 'ml_admin_js');



/*-------------------------------------------------*/
/*	Minimal Settings
/*-------------------------------------------------*/

/*--- Theme Support ---*/
add_theme_support( 'post-thumbnails' );
add_theme_support( 'automatic-feed-links' );

/*--- Max Content Width ---*/
if ( ! isset( $content_width ) ) $content_width = 1160;

/*--- Post and comment RSS feed links to head ---*/
add_theme_support('automatic-feed-links');

/*--- Load single scripts only on single pages ---*/
function ml_single_scripts() {
	if(is_singular()) wp_enqueue_script( 'comment-reply' ); // Visit http://codex.wordpress.org/Migrating_Plugins_and_Themes_to_2.7/Enhanced_Comment_Display for more info
}






/*-------------------------------------------------*/
/*	Excerpts
/*-------------------------------------------------*/

function new_excerpt_more($more) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');


function new_excerpt_length($length) {

	return 30;
	
}

add_filter('excerpt_length', 'new_excerpt_length');


//custom excerpt length functions
function ml_custom_excerpt($string, $word_limit)
{
  $words = explode(' ', $string, ($word_limit + 1));
  if(count($words) > $word_limit) {
	  array_pop($words);
	  $words = str_replace('...','',$words);
	  return implode(' ', $words).'...';
  } else {
	  return implode(' ', $words);  
  }
}



/*-------------------------------------------------*/
/*	Main Menu
/*-------------------------------------------------*/
function ml_register_menu() {

  register_nav_menus(
    array('ml-header-menu' => 'Header Menu' )
  );

}
add_action( 'init', 'ml_register_menu' );



/*-------------------------------------------------*/
/*	Responsive (Select) Menu
/*-------------------------------------------------*/

class Walker_Nav_Menu_Dropdown extends Walker_Nav_Menu {

	function is_dropdown() {
		return true;
	}

	function start_el( &$output, $item, $depth, $args ) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		$classes[] = 'menu-item-depth-' . $depth;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_unique( array_filter( $classes ) ), $item, $args ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';

		$selected = in_array( 'current-menu-item', $classes ) ? ' selected="selected"' : '';

		$output .= $indent . '<option' . $class_names .' value="'. $item->url .'"'. $selected .'>';

		$indent_string = str_repeat( apply_filters( 'dropdown_menus_indent_string', '- ', $item, $depth, $args ), ( $depth ) ? $depth : 0 );
		$indent_string .= !empty( $indent_string ) ? apply_filters( 'dropdown_menus_indent_after', '', $item, $depth, $args ) : '';

		$item_output = $args->before . $indent_string;
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_dropdown_start_el', $item_output, $item, $depth, $args );
	}

	function end_el( &$output, $item, $depth ) {
		$output .= apply_filters( 'walker_nav_menu_dropdown_end_el', "</option>\n", $item, $depth);
	}
}



/*-------------------------------------------------*/
/*	Utils
/*-------------------------------------------------*/

// convert hexadecimal color to CSS rgba function.
function ml_hexToRGBA($hex, $alpha) {
	$hex = ereg_replace("#", "", $hex);
	$color = array();

	if(strlen($hex) == 3) {
		$color['r'] = hexdec(substr($hex, 0, 1) . $r);
		$color['g'] = hexdec(substr($hex, 1, 1) . $g);
		$color['b'] = hexdec(substr($hex, 2, 1) . $b);
	}
	else if(strlen($hex) == 6) {
		$color['r'] = hexdec(substr($hex, 0, 2));
		$color['g'] = hexdec(substr($hex, 2, 2));
		$color['b'] = hexdec(substr($hex, 4, 2));
	}

	return 'rgba(' . $color['r'] . ',' . $color['g'] . ',' . $color['b'] . ',' . $alpha . ')';
}



/*-------------------------------------------------*/
/*	Options Framework
/*-------------------------------------------------*/

if ( !function_exists( 'optionsframework_init' ) ) {
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/admin/' );
	require_once dirname(dirname( __FILE__ )) . '/admin/options-framework.php';
}



/*-------------------------------------------------*/
/*	Custom Login Image
/*-------------------------------------------------*/
function ml_custom_login() {

	/* if you don't have any custom logo, return the WordPress logo */
	$wp_logo = home_url() . '/wp-admin/images/wordpress-logo.png';
	$theme_logo = of_get_option('ml-login-image');

	if( $theme_logo || (trim($theme_logo) != '') ) {
		$the_logo = $theme_logo; 
	} else {
		$the_logo = $wp_logo; 
	}


	echo '<style type="text/css">'; 
	echo '	#login {margin:0 auto 7em auto;}';
	echo '	#login h1 a {';
	echo '		background:url(' . $the_logo . ') no-repeat center bottom;';
	echo '		height:145px;';
	echo '		margin:20px auto;';
	echo '		padding:0 8px;';
	echo '		width:310px;';
	echo '	}';
	echo '</style>';
}
add_action('login_head', 'ml_custom_login');
