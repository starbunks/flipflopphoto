<?php

/*-------------------------------------------------*/
/*	Name: Content Stacker
/*	Version: 1.1
/*	Author: Meydjer Luzzoli
/*	Author URI: http://www.meydjer.com
/*	License: All Rights Reserved
/*-------------------------------------------------*/


define( 'CSTACKER_DIR', dirname( __FILE__ ) );
define( 'CSTACKER_URL', get_template_directory_uri() . '/functions/cstacker' );


/*-------------------------------------------------*/
/*	1. ENQUEUE FILES
/*-------------------------------------------------*/

function ml_cstacker_resources(){
	wp_register_script('cstacker_js', CSTACKER_URL . '/js/cstacker.js', 'jquery', '1.0');
	wp_enqueue_script('cstacker_js');

	wp_register_style( 'cstacker_admin_css', CSTACKER_URL . '/css/admin.css', false, '1.0.0' );
	wp_enqueue_style( 'cstacker_admin_css' );
}

add_action('admin_enqueue_scripts', 'ml_cstacker_resources');

function ml_viewer_resources() {

	wp_register_style( 'cstacker_css', CSTACKER_URL . '/css/cstacker.css.php', false, '1.0.0' );
	wp_enqueue_style( 'cstacker_css' );		

}

add_action('init', 'ml_viewer_resources');



/*-------------------------------------------------*/
/*	2. CONTENT STACKER CUSTOM POST TYPE
/*-------------------------------------------------*/

add_action( 'init', 'register_cpt_ml_cstacker' );

function register_cpt_ml_cstacker() {

	$args = array( 

		'query_var' => false,

		'capability_type' => 'post'

	);

	register_post_type( 'ml_cstacker', $args );

}



/*-------------------------------------------------*/
/*	3. META BOX
/*-------------------------------------------------*/


/*--- Init ---*/
add_action( 'add_meta_boxes', 'add_content_stacker_meta_box' );


/*--- Add Meta box ---*/
function add_content_stacker_meta_box() {
		add_meta_box(
				'ml_content_stacker',
				__('Content Stacker', 'meydjer'), 
				'content_stacker_template',
				'page',
				'normal',
				'high'
		);
}


/*--- Content Stacker Template ---*/
function content_stacker_template( $post ) {

	wp_nonce_field( plugin_basename( __FILE__ ), 'content_stacker_nonce' );

	require "cstacker-template.php";

}



/*-------------------------------------------------*/
/*	4. ADD ITEM
/*-------------------------------------------------*/

add_action('wp_ajax_ml_cstacker_add_item', 'ml_cstacker_add_item_callback');

function ml_cstacker_add_item_callback() {


	/*--- Post Arguments ---*/

	global $wpdb;

	$type	= $_POST['type'];
	$title	= $_POST['title'];
	$post_id	= $_POST['post_id'];

	$post = array(
		'comment_status'	=> 'closed',
		'ping_status'		=> 'closed',
		'post_content'		=> $title,
		'post_status'		=> 'publish',
		'post_title'		=> $type,
		'post_type'			=> 'ml_cstacker',
		'post_parent'		=> $post_id,
	);


	/*--- Create Post and send Content Block via AJAX ---*/

	if ($new_post_id = wp_insert_post( $post )) {

		?>

		<li id="ml-cs-item_<?php echo $new_post_id ?>" data-id="<?php echo $new_post_id ?>" data-type="<?php echo $type ?>" data-size="1" class="<?php echo $type ?>-box ml-cs-li ml-cs-size-1 ml-cs-item-<?php echo $new_post_id ?>">
			<div class="ml-cs-options">
				<a href="#" class="ml-cs-button ml-cs-sprite ml-hide-txt ml-cs-delete">&times;</a>
				<a href="#" class="ml-cs-button ml-cs-sprite ml-hide-txt ml-cs-edit">&#9998;</a>
				<a href="#" class="ml-cs-button ml-cs-sprite ml-hide-txt ml-cs-minus" data-button="minus">&#9664;</a>
				<a href="#" class="ml-cs-button ml-cs-sprite ml-hide-txt ml-cs-plus" data-button="plus">&#9654;</a>
				<span class="ml-cs-size ml-cs-sprite">1/1</a>
			</div>
			<div class="ml-cs-area">
				<div class="ml-cs-area-in">
					<h2 class="ml-cs-title"><?php echo $title ?></h2>
					<div class="ml-cs-edit-content" data-id="<?php echo $new_post_id ?>"></div>
				</div>
			</div>
		</li>

		<?php

		/*--- Meta Fields ---*/

		add_post_meta($new_post_id, '_ml_cs_size', '1');


	} else {
		echo 'error';
	}

	die();

}



/*-------------------------------------------------*/
/*	5. DELETE ITEM
/*-------------------------------------------------*/

add_action('wp_ajax_ml_cstacker_delete_item', 'ml_cstacker_delete_item_callback');

function ml_cstacker_delete_item_callback() {

	$post_id	= $_POST['post_id'];

	if ( !wp_delete_post( $post_id, true ) )
		echo 'error';

	die();

}



/*-------------------------------------------------*/
/*	6. EDIT ITEM
/*-------------------------------------------------*/


/*--- AJAX Edit ---*/

add_action('wp_ajax_ml_cstacker_edit_item', 'ml_cstacker_edit_item_callback');

function ml_cstacker_edit_item_callback() {

	$post_id		= $_POST['post_id'];
	$post_type	= $_POST['post_type'];
	$edit			= str_replace('ml-cs-', '', $post_type);

	require 'edit/' . $edit . '.php';

	die();

}




/*-------------------------------------------------*/
/*	7. RESIZE ITEM
/*-------------------------------------------------*/


/*--- AJAX Resize ---*/

add_action('wp_ajax_ml_cstacker_resize_item', 'ml_cstacker_resize_item_callback');

function ml_cstacker_resize_item_callback() {

	$post_id		= $_POST['post_id'];
	$post_size	= $_POST['post_size'];

	if ( !update_post_meta($post_id, '_ml_cs_size', $post_size) )
		echo 'error';

	die();

}


/*--- Return Size Fraction ---*/

function ml_return_size_fraction($post_size) {

	if($post_size == 2) {
		return '3/4';
	} else if($post_size == 3) {
		return '2/3';
	} else if($post_size == 4) {
		return '1/2';
	} else if($post_size == 5) {
		return '1/3';
	} else if($post_size == 6) {
		return '1/4';
	} else {
		return '1/1';
	}

}



/*-------------------------------------------------*/
/*	8. ELEMENT FUNCTIONS
/*-------------------------------------------------*/

$files = glob( CSTACKER_DIR . '/functions/*.php' );

foreach ($files as $file){
	require $file;
}



/*-------------------------------------------------*/
/*	9. SAVE ORDER
/*-------------------------------------------------*/

/*--- AJAX Function ---*/

add_action('wp_ajax_ml_cstacker_save_order', 'ml_cstacker_save_order_callback');

function ml_cstacker_save_order_callback() {

	global $wpdb;

	foreach ($_POST['order'] as $position => $item) {

		$item_id = str_replace('ml-cs-item_', '', $item);

		$wpdb->query( $wpdb->prepare( 
			"
				UPDATE $wpdb->posts 
				SET menu_order = $position
				WHERE ID = $item_id
			"
		) );

	}

	die();

}



/*-------------------------------------------------*/
/*	10. OTHER FUNCTIONS
/*-------------------------------------------------*/

/*--- Return Size ---*/

function ml_return_size_text($post_size) {

	if($post_size == 2) {
		return 'three_fourth';
	} else if($post_size == 3) {
		return 'two_third';
	} else if($post_size == 4) {
		return 'one_half';
	} else if($post_size == 5) {
		return 'one_third';
	} else if($post_size == 6) {
		return 'one_fourth';
	} else {
		return 'one_full';
	}

}

function ml_return_size_width($content_size) {

	if($content_size == 2) {
		return 75;
	} else if($content_size == 3) {
		return 66.6666666666667;
	} else if($content_size == 4) {
		return 50;
	} else if($content_size == 5) {
		return 33.3333333333333;
	} else if($content_size == 6) {
		return 25;
	} else {
		return 100;
	}

}


/*--- Sanitize File Name ---*/

function ml_sanitize_file_name($file){

	$file = explode('/', $file);

	$file = $file[count($file)-1];

	$file = sanitize_title($file);

	return $file;
}



/*--- Rule of Three ---*/

if(!function_exists('ml_rot')) {

	function ml_rot($val_a1, $val_a2, $val_b1) {

		return ($val_a2 * $val_b1) / $val_a1;

	}

}
