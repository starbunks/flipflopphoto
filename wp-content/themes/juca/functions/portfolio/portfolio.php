<?php

/*-------------------------------------------------*/
/*  1. Portfolio Custom Post Type
/*-------------------------------------------------*/

/*--- Custom Taxonomy - Portfolio Categories (For Portfolio) ---*/

add_action( 'init', 'register_taxonomy_ml_portfolio_category' );



function register_taxonomy_ml_portfolio_category() {

	$labels = array( 
		'name' => __( 'Portfolio Categories', 'meydjer'),
		'singular_name' => __( 'Portfolio Category', 'meydjer'),
		'popular_items' => __( 'Popular Portfolio Categories', 'meydjer'),
		'all_items' => __( 'All Portfolio Categories', 'meydjer'),
		'parent_item' => __( 'Parent Portfolio Category', 'meydjer'),
		'parent_item_colon' => __( 'Parent Portfolio Category:', 'meydjer'),
		'edit_item' => __( 'Edit Portfolio Category', 'meydjer'),
		'update_item' => __( 'Update Portfolio Category', 'meydjer'),
		'add_new_item' => __( 'Add New Portfolio Category', 'meydjer'),
		'new_item_name' => __( 'New Portfolio Category Name', 'meydjer'),
		'separate_items_with_commas' => __( 'Separate Portfolio Categories with commas', 'meydjer'),
		'add_or_remove_items' => __( 'Add or remove Portfolio Categories', 'meydjer'),
		'choose_from_most_used' => __( 'Choose from the most used Portfolio Categories', 'meydjer'),
		'menu_name' => __( 'Portfolio Categories', 'meydjer'),
	);

	$args = array( 
		'labels' => $labels,
		'public' => false,
		'show_in_nav_menus' => false,
		'show_ui' => true,
		'show_tagcloud' => true,
		'hierarchical' => true,
		'rewrite' => array( 
			'slug' => 'portfolio-category', 
			'with_front' => true,
			'feeds' => true,
			'pages' => true
		),
		'query_var' => true
	);

	register_taxonomy( 'ml_portfolio_category', array('ml_portfolio'), $args );

}



/*--- Custom Post Type - Portfolio ---*/

add_action( 'init', 'register_cpt_ml_portfolio' );



function register_cpt_ml_portfolio() {

	$labels = array( 
		'name' => __( 'Portfolio Items', 'meydjer'),
		'singular_name' => __( 'Portfolio Item', 'meydjer'),
		'add_new' => __( 'Add New', 'meydjer'),
		'add_new_item' => __( 'Add New Portfolio Item', 'meydjer'),
		'edit_item' => __( 'Edit Portfolio Item', 'meydjer'),
		'new_item' => __( 'New Portfolio Item', 'meydjer'),
		'view_item' => __( 'View Portfolio Item', 'meydjer'),
		'not_found' => __( 'No portfolio items found', 'meydjer'),
		'not_found_in_trash' => __( 'No portfolio items found in Trash', 'meydjer'),
		'parent_item_colon' => __( 'Parent Portfolio Item:', 'meydjer'),
		'menu_name' => __( 'Portfolio Items', 'meydjer'),
	);

	$args = array( 
		'labels' => $labels,
		'hierarchical' => false,
		'supports' => array('title', 'thumbnail', 'author' ),
		'taxonomies' => array( 'ml_portfolio_category' ),
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
			'slug' => 'portfolio', 
			'with_front' => true,
			'feeds' => true,
			'pages' => true
		),
		'capability_type' => 'post'
	);

	register_post_type( 'ml_portfolio', $args );

}





/*-------------------------------------------------*/
/*    2. META BOX
/*-------------------------------------------------*/


$prefix = '_ml_port_';

global $ml_portfolio_meta;

$ml_portfolio_meta = array();

$ml_portfolio_meta[] = array(

	// Meta box id, UNIQUE per meta box
	'id' => 'port_content',

	// Meta box title - Will appear at the drag and drop handle bar
	'title' => __('Portfolio Item Content', 'meydjer'),

	// Post types, accept custom post types as well - DEFAULT is array('post'); (optional)
	'pages' => array( 'ml_portfolio' ),

	// Where the meta box appear: normal (default), advanced, side; optional
	'context' => 'normal',

	// Order of meta box: high (default), low; optional
	'priority' => 'high',

	// List of meta fields
	'fields' => array(

		array(
			'name'      => __('Portfolio Item Type', 'meydjer'),
			'id'        => "{$prefix}type",
			'type'      => 'radio',
			'options'   => array(
				'images'   => __('Images', 'meydjer'),
				'embedded' => __('Embedded Content', 'meydjer')
			),
			'std'       => 'images'
		),

		array(
			'name'  => __('Images', 'meydjer'),
			'id'    => "{$prefix}images",
			'class' => "field-{$prefix}images",
			'type'  => 'plupload_image',
		),

		array(
			'name'      => __('Shortcode/Embedded Content', 'meydjer'),
			'id'        => "{$prefix}embedded",
			'class'     => "field-{$prefix}embedded",
			'type'      => 'textarea',
			'std'       => __('Paste here the Shortcode of the HTML code of you embedded content (E.g.: YouTube and Vimeo videos).', 'meydjer'),
			'cols'      => "40",
			'rows'      => "8"
		),

	)

);


/**
 * Register meta boxes
 *
 * @return void
 */

function ml_portfolio_register_meta_boxes()
{
	global $ml_portfolio_meta;

	if ( class_exists( 'RW_Meta_Box' ) )
	{
		foreach ( $ml_portfolio_meta as $meta_box )
		{
			new RW_Meta_Box( $meta_box );
		}
	}
}

add_action( 'admin_init', 'ml_portfolio_register_meta_boxes' );



/*-------------------------------------------------*/
/*    3. CUSTOM COLUMN
/*-------------------------------------------------*/
function add_new_ml_portfolio_columns($ml_portfolio_columns) {

	$new_columns['cb'] = '<input type="checkbox" />';

	$new_columns['title'] = __('Title', 'meydjer');

	$new_columns['portfolio_category'] = __('Portfolio Category', 'meydjer');

	$new_columns['thumbnail'] = __('Featured Image', 'meydjer');

	return $new_columns;
}


function manage_ml_portfolio_columns($column_name) {

	global $wpdb;
	switch ($column_name) {

	case 'portfolio_category':

		$port_categories = get_the_terms(get_the_ID(), 'ml_portfolio_category');

		if($port_categories) {

			foreach($port_categories as $category) {

				echo 
					'<a href="' . home_url() . '/wp-admin/edit-tags.php?action=edit&taxonomy=' . $category->taxonomy . '&tag_ID=' . $category->term_id . '&post_type=ml_portfolio">' .
						$category->name.
					'</a> <br />';

			}

		} else {

			_e('Uncategorized', 'meydjer');

		}

	break;
	
	case 'thumbnail':

		if(get_post_thumbnail_id()) {

			$attach_id = get_post_thumbnail_id();
			$resized = vt_resize( $attach_id, '', 178, 100, true );      

			echo 
			'<a class="ml-frame" href="'. home_url() .'/wp-admin/post.php?post='.get_the_ID().'&action=edit">
				<img src="'. $resized['url'] .'" />
			</a>';

		} else {

			_e('Please set a featured image', 'meydjer');

		}

	break;

	default:
		break;
	} // end switch
}

add_filter('manage_edit-ml_portfolio_columns', 'add_new_ml_portfolio_columns');
add_action('manage_ml_portfolio_posts_custom_column', 'manage_ml_portfolio_columns', 10, 2);




/*-------------------------------------------------*/
/*    4. ORDER
/*-------------------------------------------------*/

add_action('admin_menu','ml_portfolio_admin_menu');

function ml_portfolio_order_page() {
	require "portfolio_order.php";
}

function ml_portfolio_admin_menu() {
	add_submenu_page( 'edit.php?post_type=ml_portfolio', __('Portfolio Order', 'meydjer'), __('Portfolio Order', 'meydjer'), 'edit_posts', 'portfolio_order', 'ml_portfolio_order_page' );
}


/*--- AJAX Function ---*/

add_action('wp_ajax_ml_portfolio_save_order', 'ml_portfolio_save_order_callback');

function ml_portfolio_save_order_callback() {

	global $wpdb;

	foreach ($_POST['order'] as $position => $item) {

		$item_id = str_replace('ml-pitem_', '', $item);

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
/*    5. PORTFOLIO CONTENT
/*-------------------------------------------------*/

add_action('wp_ajax_ml_portfolio_content', 'ml_portfolio_content_callback');
add_action('wp_ajax_nopriv_ml_portfolio_content', 'ml_portfolio_content_callback');

function ml_portfolio_content_callback() {

	global $wpdb;

	$post_slug      = $_POST['post_slug'];
	$post_id        = $wpdb->get_var("
		SELECT ID FROM $wpdb->posts
		WHERE post_name = '$post_slug'"
		);

	$portfolio_type = get_post_meta( $post_id, '_ml_port_type', true );

	if($portfolio_type == 'images') {

		$post_images    = ml_uploaded_images($post_id, '_ml_port_images');

		$total_items    = count($post_images);
		$thumbs_to_wrap = 16;
		$total_blocks   = ceil($total_items / $thumbs_to_wrap);
		$wrap_width     = $total_blocks * 220;

		include 'portfolio-images.php';

	} else if($portfolio_type == 'embedded') {

		$post_content = get_post_meta( $post_id, '_ml_port_embedded', true );

		include 'portfolio-embedded.php';

	}


	die();


}