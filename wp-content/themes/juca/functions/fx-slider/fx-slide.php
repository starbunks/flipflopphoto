<?php

define( 'FXSLIDER_DIR', dirname( __FILE__ ) );
define( 'FXSLIDER_URL', get_template_directory_uri() . '/functions/fx-slider' );


/*-------------------------------------------------*/
/*	1. ENQUEUE FILES
/*-------------------------------------------------*/

function ml_fx_slider_resources(){


	/*--- JS ---*/

	wp_register_script('ml_fxslide', FXSLIDER_URL . '/js/fx-slide.js', array('jquery','jquery-ui-draggable','jquery-ui-sortable'), '1.0');

	if (get_post_type() == 'ml_slider')
		wp_enqueue_script('ml_fxslide');


	/*--- CSS ---*/

	wp_register_style( 'fx_slider_admin_css', FXSLIDER_URL . '/css/admin.css', false, '1.0.0' );
	wp_enqueue_style( 'fx_slider_admin_css' );



}

add_action('admin_enqueue_scripts', 'ml_fx_slider_resources');



/*-------------------------------------------------*/
/*	1. FX SLIDE ELEMENT CUSTOM POST TYPE
/*-------------------------------------------------*/

add_action( 'init', 'register_cpt_ml_fx_element' );

function register_cpt_ml_fx_element() {

	$args = array( 

		'query_var' => false,

		'capability_type' => 'post'

	);

	register_post_type( 'ml_fx_element', $args );

	
}



/*-------------------------------------------------*/
/*	2. FX EDITOR
/*-------------------------------------------------*/

if(isset($_GET['post']) && (is_admin())) {

	if( isset($_GET['action']) && isset($_GET['post']) ) {

		$post_id = $_GET['post'];
		$action  = $_GET['action'];

		$post_type = get_post_type($post_id);

		if ( ($action == 'edit') && ($post_type == 'ml_slider') )
			require "fx-slide-template.php";

	}
	
}





/*-------------------------------------------------*/
/*	3. RESIZE SLIDER
/*-------------------------------------------------*/


add_action('wp_ajax_ml_fx_resize_slider', 'ml_fx_resize_slider_callback');

function ml_fx_resize_slider_callback() {

	$post_id	= $_POST['post_id'];
	$height  = $_POST['new_height'];

	/*--- Create Post and send Content Block via AJAX ---*/

	if (!update_post_meta($post_id, '_ml_fx_height', $height))
		echo 'error';

	die();

}



/*-------------------------------------------------*/
/*	4. ADD ITEM
/*-------------------------------------------------*/


/*--- AJAX Add Item ---*/
add_action('wp_ajax_ml_fx_element_add_item', 'ml_fx_element_add_item_callback');

function ml_fx_element_add_item_callback() {


	/*--- Post Arguments ---*/

	global $wpdb;

	$post_id	  = $_POST['post_id'];
	$image     = $_POST['image'];
	$class     = '.' . ml_sanitize_file_name($image);
	$thumbnail = vt_resize( null, $image, 51, 51, true );

	$post = array(
		'comment_status'	=> 'closed',
		'ping_status'		=> 'closed',
		'post_content'		=> 'image',
		'post_status'		=> 'publish',
		'post_title'		=> 'image',
		'post_type'			=> 'ml_fx_element',
		'post_parent'		=> $post_id,
	);


	/*--- Create Post and send Content Block via AJAX ---*/

	if ($new_post_id = wp_insert_post( $post )) {


		/*--- Meta Fields ---*/
		add_post_meta($new_post_id, '_ml_fx_image', $image);
		add_post_meta($new_post_id, '_ml_fx_link', null);
		add_post_meta($new_post_id, '_ml_fx_animation', 'none');
		add_post_meta($new_post_id, '_ml_fx_easing', 'none');
		add_post_meta($new_post_id, '_ml_fx_delay', '0');
		add_post_meta($new_post_id, '_ml_fx_duration', '1000');
		add_post_meta($new_post_id, '_ml_fx_class', $class);
		add_post_meta($new_post_id, '_ml_fx_to_x', 0);
		add_post_meta($new_post_id, '_ml_fx_to_y', 0);

		$image_size = getimagesize($image);

		?>


		<li id="ml-fx-item-<?php echo $new_post_id ?>" class="ml-fx-item-li" data-id="<?php echo $new_post_id ?>">

			<div class="ml-fx-area-div ml-fx-area-visible">
				<a href="#" class="ml-fx-item-action ml-fx-item-visibility"></a>
			</div>

			<div class="ml-fx-area-div ml-fx-area-move">
				<div class="ml-fx-item-action ml-fx-item-move"></div>
			</div>

			<div class="ml-fx-area-div ml-fx-area-image">
				<img src="<?php echo $thumbnail['url'] ?>" class="ml-fx-thumbnail" height="51" width="51">
			</div>
			
			<div class="ml-fx-area-div ml-fx-area-link">
				<input type="text" name="ml-fx-input-link" id="ml-fx-input-link" class="ml-admin-input-text ml-admin-input-link" value="" data-meta="link">
			</div>

			<div class="ml-fx-area-div ml-fx-area-animation">
				<div class="ml-fx-animation-box">
						<a href="#" class="ml-animation-check ml-animation-topleft " data-dir="topleft"></a>
						<a href="#" class="ml-animation-check ml-animation-top" data-dir="top"></a>
						<a href="#" class="ml-animation-check ml-animation-topright " data-dir="topright"></a>
						<br>
						<a href="#" class="ml-animation-check ml-animation-left " data-dir="left"></a>
						<a href="#" class="ml-animation-check ml-animation-none ml-active" data-dir="none"></a>
						<a href="#" class="ml-animation-check ml-animation-right " data-dir="right"></a>
						<br>
						<a href="#" class="ml-animation-check ml-animation-bottomleft " data-dir="bottomleft"></a>
						<a href="#" class="ml-animation-check ml-animation-bottom " data-dir="bottom"></a>
						<a href="#" class="ml-animation-check ml-animation-bottomright " data-dir="bottomright"></a>
				</div>
			</div>
			
			<div class="ml-fx-area-div ml-fx-area-easing">
				<select name="ml-fx-select-easing" id="ml-fx-select-easing-620" class="ml-fx-select-easing" data-meta="easing">
						<option value="none" selected="selected"><?php _e('None', 'meydjer') ?></option>
						<option value="easeOutBack"><?php _e('Back', 'meydjer') ?></option>
						<option value="easeOutBounce"><?php _e('Bounce', 'meydjer') ?></option>
						<option value="easeOutCirc"><?php _e('Circ', 'meydjer') ?></option>
						<option value="easeOutCubic"><?php _e('Cubic', 'meydjer') ?></option>
						<option value="easeOutElastic"><?php _e('Elastic', 'meydjer') ?></option>
						<option value="easeOutExpo"><?php _e('Expo', 'meydjer') ?></option>
						<option value="easeOutQuad"><?php _e('Quad', 'meydjer') ?></option>
						<option value="easeOutQuart"><?php _e('Quart', 'meydjer') ?></option>
						<option value="easeOutQuint"><?php _e('Quint', 'meydjer') ?></option>
						<option value="easeOutSine"><?php _e('Sine', 'meydjer') ?></option>
				</select>
			</div>

			<div class="ml-fx-area-div ml-fx-area-delay">
				<input type="text" name="ml-fx-input-delay" id="ml-fx-input-delay" class="ml-admin-input-text ml-admin-input-delay" value="0" data-meta="delay">
			</div>

			<div class="ml-fx-area-div ml-fx-area-duration">
				<input type="text" name="ml-fx-input-duration" id="ml-fx-input-duration" class="ml-admin-input-text ml-admin-input-duration" value="1000" data-meta="duration">
			</div>

			<div class="ml-fx-area-div ml-fx-area-class">
				<input type="text" name="ml-fx-input-class" id="ml-fx-input-class" class="ml-admin-input-text ml-admin-input-class" value="<?php echo $class ?>" data-meta="class">
			</div>

			<div class="ml-fx-area-div ml-fx-area-delete">
				<a href="#" class="ml-fx-item-action ml-fx-item-delete"></a>
			</div>

		</li>

		|ml-split|

		<img id="ml-fx-<?php echo $new_post_id ?>" class="ml-fx-element <?php echo $class ?> ui-draggable" src="<?php echo $image ?>" data-id="<?php echo $new_post_id ?>" data-animation="none" data-easing="" data-delay="0" data-duration="1000" data-from_x="0px" data-to_x="0px" data-from_y="0px" data-to_y="0px" style="left:0px;top:0px;z-index:1000" width="<?php echo $image_size[0] ?>" height="<?php echo $image_size[1] ?>">


		<?php

	} else {
		echo 'error';
	}

	die();

}


/*--- Silent Post ---*/

function ml_silent_post() {

	global $wpdb;

	$args = array(
		'post_type'      => 'ml_fx_element',
		'post_name'      => 'ml-add-item',
		'post_status'    => 'draft',
		'comment_status' => 'closed',
		'ping_status'    => 'closed'
		);

	$query = 'SELECT ID '.
	         'FROM ' . $wpdb->posts . ' ' .
	         'WHERE post_parent = 0';
	foreach ( $args as $key => $value ) {
		$query .= ' AND ' . $key . ' = "' . $value . '"';
	}
	$posts = $wpdb->get_row( $query );

	if ( count( $posts ) ) {
		$post_id = $posts->ID;

	} else {
		$post_id = wp_insert_post( $args );

	}

	return $post_id;

}



/*-------------------------------------------------*/
/*	5. DELETE ITEM
/*-------------------------------------------------*/


/*--- AJAX Add Item ---*/
add_action('wp_ajax_ml_fx_element_delete_item', 'ml_fx_element_delete_item_callback');

function ml_fx_element_delete_item_callback() {

	$post_id	= $_POST['post_id'];

	if ( !wp_delete_post( $post_id, true ) )
		echo 'error';

	die();

}



/*-------------------------------------------------*/
/*	6. NEW POSITION
/*-------------------------------------------------*/


add_action('wp_ajax_ml_fx_new_element_position', 'ml_fx_new_element_position_callback');

function ml_fx_new_element_position_callback() {

	$post_id	= $_POST['post_id'];
	$to_x    = $_POST['left'];
	$to_y    = $_POST['top'];

	if ( (!update_post_meta($post_id, '_ml_fx_to_x', $to_x)) || (!update_post_meta($post_id, '_ml_fx_to_y', $to_y)) )
		echo 'error';

	die();

}



/*-------------------------------------------------*/
/*	6. UPDATE META
/*-------------------------------------------------*/

add_action('wp_ajax_ml_fx_update_meta', 'ml_fx_update_meta_callback');

function ml_fx_update_meta_callback() {

	$post_id	= $_POST['post_id'];
	$value   = $_POST['value'];
	$meta    = $_POST['meta'];


	if ( !update_post_meta($post_id, '_ml_fx_' . $meta, $value) )
		echo 'error';

	die();

}



/*-------------------------------------------------*/
/*	6. UPDATE ORDER
/*-------------------------------------------------*/

add_action('wp_ajax_ml_fx_update_order', 'ml_fx_update_order_callback');

function ml_fx_update_order_callback() {

	global $wpdb;

	$order = $_POST['order'];

	foreach ($order as $position => $item) {

		$item = str_replace('ml-fx-item-', '', $item);

		$wpdb->query( $wpdb->prepare( 
			"
				UPDATE $wpdb->posts 
				SET menu_order = $position
				WHERE ID = $item 
			"
		) );

	}

	die();

}

