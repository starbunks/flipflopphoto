<?php

/*-------------------------------------------------*/
/*  1. Slider Custom Post Type
/*-------------------------------------------------*/

/*--- Custom Taxonomy - Slider Categories (For Slide) ---*/

add_action( 'init', 'register_taxonomy_ml_slider_category' );



function register_taxonomy_ml_slider_category() {

	$labels = array( 
		'name' => __( 'Slider Categories', 'meydjer'),
		'singular_name' => __( 'Slider Category', 'meydjer'),
		'popular_items' => __( 'Popular Slider Categories', 'meydjer'),
		'all_items' => __( 'All Slider Categories', 'meydjer'),
		'parent_item' => __( 'Parent Slider Category', 'meydjer'),
		'parent_item_colon' => __( 'Parent Slider Category:', 'meydjer'),
		'edit_item' => __( 'Edit Slider Category', 'meydjer'),
		'update_item' => __( 'Update Slider Category', 'meydjer'),
		'add_new_item' => __( 'Add New Slider Category', 'meydjer'),
		'new_item_name' => __( 'New Slider Category Name', 'meydjer'),
		'separate_items_with_commas' => __( 'Separate Slider Categories with commas', 'meydjer'),
		'add_or_remove_items' => __( 'Add or remove Slider Categories', 'meydjer'),
		'choose_from_most_used' => __( 'Choose from the most used Slider Categories', 'meydjer'),
		'menu_name' => __( 'Slider Categories', 'meydjer'),
	);

	$args = array( 
		'labels' => $labels,
		'public' => false,
		'show_in_nav_menus' => false,
		'show_ui' => true,
		'show_tagcloud' => true,
		'hierarchical' => true,
		'rewrite' => array( 
			'slug' => 'slide-category', 
			'with_front' => true,
			'feeds' => true,
			'pages' => true
		),
		'query_var' => true
	);

	register_taxonomy( 'ml_slider_category', array('ml_slider'), $args );

}



/*--- Custom Post Type - Slide ---*/

add_action( 'init', 'register_cpt_ml_slider' );



function register_cpt_ml_slider() {

	$labels = array( 
		'name' => __( 'Slides', 'meydjer'),
		'singular_name' => __( 'Slide', 'meydjer'),
		'add_new' => __( 'Add New', 'meydjer'),
		'add_new_item' => __( 'Add New Slide', 'meydjer'),
		'edit_item' => __( 'Edit Slide', 'meydjer'),
		'new_item' => __( 'New Slide', 'meydjer'),
		'view_item' => __( 'View Slide', 'meydjer'),
		'not_found' => __( 'No Slides found', 'meydjer'),
		'not_found_in_trash' => __( 'No Slides found in Trash', 'meydjer'),
		'parent_item_colon' => __( 'Parent Slide:', 'meydjer'),
		'menu_name' => __( 'Slides', 'meydjer'),
	);

	$args = array( 
		'labels' => $labels,
		'hierarchical' => false,
		'supports' => array( 'title','author' ),
		'taxonomies' => array( 'ml_slider_category' ),
		'public' => false,
		'show_ui' => true,
		'show_in_menu' => true,        
		'show_in_nav_menus' => false,
		'publicly_queryable' => true,
		'exclude_from_search' => true,
		'has_archive' => false,
		'query_var' => true,
		'can_export' => true,
		'rewrite' => array( 
			'slug' => 'slider', 
			'with_front' => true,
			'feeds' => true,
			'pages' => true
		),
		'capability_type' => 'post'
	);

	register_post_type( 'ml_slider', $args );

}





/*-------------------------------------------------*/
/*    2. META BOX
/*-------------------------------------------------*/

$prefix = '_ml_sld_';

global $ml_slider_meta;

$ml_slider_meta = array();

$ml_slider_meta[] = array(

	// Meta box id, UNIQUE per meta box
	'id' => 'ml_slide_content',

	// Meta box title - Will appear at the drag and drop handle bar
	'title' => __('Slide Content', 'meydjer'),

	// Post types, accept custom post types as well - DEFAULT is array('post'); (optional)
	'pages' => array( 'ml_slider' ),

	// Where the meta box appear: normal (default), advanced, side; optional
	'context' => 'normal',

	// Order of meta box: high (default), low; optional
	'priority' => 'high',

	// List of meta fields
	'fields' => array(

		array(
			'name'      => __('Slide Type', 'meydjer'),
			'id'        => "{$prefix}type",
			'type'      => 'radio',
			'options'   => array(
				'image'      => __('Image', 'meydjer'),
				'embedded'   => __('Embedded Content', 'meydjer'),
				'html'       => __('HTML', 'meydjer'),
				'fx'         => __('FX Slide', 'meydjer')
			),
			'std'       => 'image'
		)

	)

);


$ml_slider_meta[] = array(

	// Meta box id, UNIQUE per meta box
	'id' => 'ml_image_content',

	// Meta box title - Will appear at the drag and drop handle bar
	'title' => __('Image', 'meydjer'),

	// Post types, accept custom post types as well - DEFAULT is array('post'); (optional)
	'pages' => array( 'ml_slider' ),

	// Where the meta box appear: normal (default), advanced, side; optional
	'context' => 'normal',

	// Order of meta box: high (default), low; optional
	'priority' => 'high',

	// List of meta fields
	'fields' => array(

		array(
			'name'              => __('Images', 'meydjer'),
			'id'                => "{$prefix}image",
			'class'             => "field-{$prefix}image",
			'desc'              => __('Maximum width: 1160px.', 'meydjer'),
			'max_file_uploads'  => 1,
			'type'              => 'plupload_image'
		),
		array(
			'name'              => __('Link', 'meydjer'),
			'id'                => "{$prefix}link",
			'class'             => "field-{$prefix}link",
			'desc'              => __('Link for this image (optional)', 'meydjer'),
			'type'              => 'text'
		),
		array(
			'name'              => __('Caption Title', 'meydjer'),
			'id'                => "{$prefix}caption_title",
			'class'             => "field-{$prefix}caption_title",
			'desc'              => __('Image caption title (optional)', 'meydjer'),
			'type'              => 'text'
		),
		array(
			'name'              => __('Caption Text', 'meydjer'),
			'id'                => "{$prefix}caption_text",
			'class'             => "field-{$prefix}caption_text",
			'desc'              => __('Image caption text (optional)', 'meydjer'),
			'type'              => 'textarea'
		)

	)

);


$ml_slider_meta[] = array(

	// Meta box id, UNIQUE per meta box
	'id' => 'ml_embedded_content',

	// Meta box title - Will appear at the drag and drop handle bar
	'title' => __('Embedded Content', 'meydjer'),

	// Post types, accept custom post types as well - DEFAULT is array('post'); (optional)
	'pages' => array( 'ml_slider' ),

	// Where the meta box appear: normal (default), advanced, side; optional
	'context' => 'normal',

	// Order of meta box: high (default), low; optional
	'priority' => 'high',

	// List of meta fields
	'fields' => array(

		array(
			'name'      => __('Embedded Content', 'meydjer'),
			'id'        => "{$prefix}embedded",
			'class'     => "field-{$prefix}embedded",
			'type'      => 'textarea',
			'std'       => __('Paste here the HTML code of you embedded content (E.g.: YouTube and Vimeo videos).', 'meydjer'),
			'cols'      => "40",
			'rows'      => "8"
		)

	)

);


$ml_slider_meta[] = array(

	// Meta box id, UNIQUE per meta box
	'id' => 'ml_html_content',

	// Meta box title - Will appear at the drag and drop handle bar
	'title' => __('HTML Content', 'meydjer'),

	// Post types, accept custom post types as well - DEFAULT is array('post'); (optional)
	'pages' => array( 'ml_slider' ),

	// Where the meta box appear: normal (default), advanced, side; optional
	'context' => 'normal',

	// Order of meta box: high (default), low; optional
	'priority' => 'high',

	// List of meta fields
	'fields' => array(

		array(
			'name'      => __('HTML Content', 'meydjer'),
			'id'        => "{$prefix}html",
			'class'     => "field-{$prefix}html",
			'type'      => 'wysiwyg',
			'std'       => __('Write your HTML content <strong>here</strong>.', 'meydjer')
		)


	)

);


$ml_slider_meta[] = array(

	// Meta box id, UNIQUE per meta box
	'id' => 'ml_fx_content',

	// Meta box title - Will appear at the drag and drop handle bar
	'title' => __('FX Slide', 'meydjer'),

	// Post types, accept custom post types as well - DEFAULT is array('post'); (optional)
	'pages' => array( 'ml_slider' ),

	// Where the meta box appear: normal (default), advanced, side; optional
	'context' => 'normal',

	// Order of meta box: high (default), low; optional
	'priority' => 'high',

	// List of meta fields
	'fields' => array(

		array(
			'name'      => __('FX Slide', 'meydjer'),
			'id'        => "{$prefix}fx",
			'class'     => "field-{$prefix}fx",
			'type'      => 'fx_slide'
		)


	)

);



/**
 * Register meta boxes
 *
 * @return void
 */

function ml_slider_register_meta_boxes()
{
	global $ml_slider_meta;

	if ( class_exists( 'RW_Meta_Box' ) )
	{
		foreach ( $ml_slider_meta as $meta_box )
		{
			new RW_Meta_Box( $meta_box );
		}
	}
}

add_action( 'admin_init', 'ml_slider_register_meta_boxes' );



/*-------------------------------------------------*/
/*    3. CUSTOM COLUMN
/*-------------------------------------------------*/
function add_new_ml_slider_columns($ml_slider_columns) {

	$new_columns['cb'] = '<input type="checkbox" />';

	$new_columns['title'] = __('Title', 'meydjer');

	$new_columns['slide_category'] = __('Slider Category', 'meydjer');

	$new_columns['content'] = __('Content', 'meydjer');

	return $new_columns;
}


function manage_ml_slider_columns($column_name) {

	global $wpdb;
	switch ($column_name) {

	case 'slide_category':

		$sld_categories = get_the_terms(get_the_ID(), 'ml_slider_category');

		if($sld_categories) {

			foreach($sld_categories as $category) {

				echo 
					'<a href="' . home_url() . '/wp-admin/edit-tags.php?action=edit&taxonomy=' . $category->taxonomy . '&tag_ID=' . $category->term_id . '&post_type=ml_slider">' .
						$category->name.
					'</a> <br />';

			}

		} else {

			_e('Uncategorized', 'meydjer');

		}

	break;
	

	case 'content':


		$slide_type = get_post_meta( get_the_ID(), '_ml_sld_type', true );


		/*--- Image ---*/
		if($slide_type == 'image') {

			$image = ml_uploaded_images(get_the_ID(), '_ml_sld_image');

			if($image) {
				$thumbnail = vt_resize( NULL, $image[0], 178, 100, true );
				echo
					'<a class="ml-frame" href="' . home_url() . '/wp-admin/post.php?post=' . get_the_ID() . '&amp;action=edit">' .
						'<img src="' . $thumbnail['url'] . '" />' .
					'</a>';
			} else {
				echo
					'<a href="' . home_url() . '/wp-admin/post.php?post=' . get_the_ID() . '&amp;action=edit">' .
						__('Please upload an image.', 'meydjer') .
					'</a>';
			}


		/*--- Embedded Content ---*/
		} else if($slide_type == 'embedded') {

			$embedded_content = get_post_meta( get_the_ID(), '_ml_sld_embedded', true );

			if($embedded_content) {
				echo
					'<a class="ml-frame ml-frame-embedded" href="' . home_url() . '/wp-admin/post.php?post=' . get_the_ID() . '&amp;action=edit">' .
						'<div class="ml-fit">' .
							$embedded_content .
						'</div>' .
					'</a>';
			} else {
				echo
					'<a href="' . home_url() . '/wp-admin/post.php?post=' . get_the_ID() . '&amp;action=edit">' .
						__('Please paste your embedded content code.', 'meydjer') .
					'</a>';
			}

		/*--- HTML Content ---*/
		} else if($slide_type == 'html') {

			$html_content = get_post_meta( get_the_ID(), '_ml_sld_html', true );

			if($html_content) {
				echo
					'<a class="ml-frame" href="' . home_url() . '/wp-admin/post.php?post=' . get_the_ID() . '&amp;action=edit">' .
						'<div class="ml-html-content">' .
							$html_content .
						'</div>' .
					'</a>';
			} else {
				echo
					'<a href="' . home_url() . '/wp-admin/post.php?post=' . get_the_ID() . '&amp;action=edit">' .
						__('Please write your HTML content.', 'meydjer') .
					'</a>';
			}


		/*--- FX Slide Content ---*/
		} else if($slide_type == 'fx') {

			$args = array(
				'numberposts'     => -1,
				'orderby'         => 'menu_order',
				'order'           => 'ASC',
				'post_type'       => 'ml_fx_element',
				'post_parent'     => get_the_ID()
				);

			$elements = get_posts($args);

			if($elements) {

				$imgs = '';
				foreach ($elements as $key => $element) {
					$image     = get_post_meta( $element->ID, '_ml_fx_image', true );
					$thumbnail = vt_resize( null, $image, 51, 51, true );
					$imgs     .= '<img src="' . $thumbnail['url'] . '" class="ml-fx-thumbnail" height="44" width="44">';
					
				}

				echo
					'<a class="ml-frame" href="' . home_url() . '/wp-admin/post.php?post=' . get_the_ID() . '&amp;action=edit">' .
						'<div class="ml-fx-content ml-html-content">' .
							$imgs .
						'</div>' .
					'</a>';

			} else {
				echo
					'<a href="' . home_url() . '/wp-admin/post.php?post=' . get_the_ID() . '&amp;action=edit">' .
						__('Please edit your FX Slide.', 'meydjer') .
					'</a>';
			}




		/*--- Else... ---*/
		} else {
			echo
					'<a href="' . home_url() . '/wp-admin/post.php?post=' . get_the_ID() . '&amp;action=edit">' .
						__('Please insert your content.', 'meydjer') .
					'</a>';
		}

	break;


	default:
		break;
	} // end switch
}

add_filter('manage_edit-ml_slider_columns', 'add_new_ml_slider_columns');
add_action('manage_ml_slider_posts_custom_column', 'manage_ml_slider_columns', 10, 2);




/*-------------------------------------------------*/
/*    4. ORDER
/*-------------------------------------------------*/

add_action('admin_menu','ml_slider_admin_menu');

function ml_slider_order_page() {
	require "slider_order.php";
}

function ml_slider_admin_menu() {
	add_submenu_page( 'edit.php?post_type=ml_slider', __('Slides Order', 'meydjer'), __('Slides Order', 'meydjer'), 'edit_posts', 'slider_order', 'ml_slider_order_page' );
}

/*--- AJAX ---*/

add_action('wp_ajax_ml_slider_save_order', 'ml_slider_save_order_callback');

function ml_slider_save_order_callback() {

	global $wpdb;

	foreach ($_POST['order'] as $position => $item) {

		$item_id = str_replace('ml-sitem_', '', $item);

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