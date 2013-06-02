<?php

/*-------------------------------------------------*/
/*	1. POST FORMATS SUPPORT
/*-------------------------------------------------*/

$post_formats = array(
	'aside',
	'audio',
	'chat',
	'gallery',
	'image',
	'link',
	'quote',
	'status',
	'video'
);

add_theme_support( 'post-formats', $post_formats );



/*-------------------------------------------------*/
/*	2. POST FORMAT META BOX
/*-------------------------------------------------*/

$prefix = '_ml_post_';

global $ml_post_meta;

$ml_post_meta = array();

$ml_post_meta[] = array(

	// Meta box id, UNIQUE per meta box
	'id' => $prefix . 'm_status',

	// Meta box title - Will appear at the drag and drop handle bar
	'title' => __('Status', 'meydjer'),

	// Post types, accept custom post types as well - DEFAULT is array('post'); (optional)
	'pages' => array( 'post' ),

	// Where the meta box appear: normal (default), advanced, side; optional
	'context' => 'normal',

	// Order of meta box: high (default), low; optional
	'priority' => 'high',

	// List of meta fields
	'fields' => array(

		array(
			'name'		=> __('Status Text', 'meydjer'),
			'id'			=> "{$prefix}status",
			'type'		=> 'textarea',
			'std'			=> __('Write here your status.', 'meydjer'),
			'cols'		=> "40",
			'rows'		=> "8"
		)

	)

);



$ml_post_meta[] = array(

	// Meta box id, UNIQUE per meta box
	'id' => $prefix . 'm_chat',

	// Meta box title - Will appear at the drag and drop handle bar
	'title' => __('Chat', 'meydjer'),

	// Post types, accept custom post types as well - DEFAULT is array('post'); (optional)
	'pages' => array( 'post' ),

	// Where the meta box appear: normal (default), advanced, side; optional
	'context' => 'normal',

	// Order of meta box: high (default), low; optional
	'priority' => 'high',

	// List of meta fields
	'fields' => array(

		array(
			'name'		=> __('Chat Text', 'meydjer'),
			'id'			=> "{$prefix}chat",
			'type'		=> 'textarea',
			'std'			=> __('Write here your chat.', 'meydjer'),
			'cols'		=> "40",
			'rows'		=> "8"
		)

	)

);



$ml_post_meta[] = array(

	// Meta box id, UNIQUE per meta box
	'id' => $prefix . 'm_quote',

	// Meta box title - Will appear at the drag and drop handle bar
	'title' => __('Quote', 'meydjer'),

	// Post types, accept custom post types as well - DEFAULT is array('post'); (optional)
	'pages' => array( 'post' ),

	// Where the meta box appear: normal (default), advanced, side; optional
	'context' => 'normal',

	// Order of meta box: high (default), low; optional
	'priority' => 'high',

	// List of meta fields
	'fields' => array(

		array(
			'name'		=> __('Quote Text', 'meydjer'),
			'id'			=> "{$prefix}quote_text",
			'type'		=> 'textarea',
			'std'			=> __('Write here the quote.', 'meydjer'),
			'cols'		=> "40",
			'rows'		=> "8"
		),

		array(
			'name'		=> __('Quote Author', 'meydjer'),
			'id'			=> "{$prefix}quote_author",
			'type'		=> 'text',
			'desc'      => __('(optional)', 'meydjer')
		)

	)

);



$ml_post_meta[] = array(

	// Meta box id, UNIQUE per meta box
	'id' => $prefix . 'm_link',

	// Meta box title - Will appear at the drag and drop handle bar
	'title' => __('Link', 'meydjer'),

	// Post types, accept custom post types as well - DEFAULT is array('post'); (optional)
	'pages' => array( 'post' ),

	// Where the meta box appear: normal (default), advanced, side; optional
	'context' => 'normal',

	// Order of meta box: high (default), low; optional
	'priority' => 'high',

	// List of meta fields
	'fields' => array(

		array(
			'name'		=> __('Link Text', 'meydjer'),
			'id'			=> "{$prefix}link_text",
			'desc'		=> __('The link Title', 'meydjer'),
			'type'		=> 'text'
		),

		array(
			'name'		=> __('Link URL', 'meydjer'),
			'id'			=> "{$prefix}link_url",
			'type'		=> 'text'
		)

	)

);



$ml_post_meta[] = array(

	// Meta box id, UNIQUE per meta box
	'id' => $prefix . 'm_video',

	// Meta box title - Will appear at the drag and drop handle bar
	'title' => __('Video', 'meydjer'),

	// Post types, accept custom post types as well - DEFAULT is array('post'); (optional)
	'pages' => array( 'post' ),

	// Where the meta box appear: normal (default), advanced, side; optional
	'context' => 'normal',

	// Order of meta box: high (default), low; optional
	'priority' => 'high',

	// List of meta fields
	'fields' => array(

		array(
			'name'      => __('Shortcode/Embedded Content', 'meydjer'),
			'id'        => "{$prefix}video",
			'class'     => "field-{$prefix}video",
			'type'      => 'textarea',
			'std'       => __('Paste here the Shortcode of the HTML code of you embedded content (E.g.: YouTube and Vimeo videos).', 'meydjer'),
			'cols'      => "40",
			'rows'      => "8"
		)

	)

);



$ml_post_meta[] = array(

	// Meta box id, UNIQUE per meta box
	'id' => $prefix . 'm_audio',

	// Meta box title - Will appear at the drag and drop handle bar
	'title' => __('Audio', 'meydjer'),

	// Post types, accept custom post types as well - DEFAULT is array('post'); (optional)
	'pages' => array( 'post' ),

	// Where the meta box appear: normal (default), advanced, side; optional
	'context' => 'normal',

	// Order of meta box: high (default), low; optional
	'priority' => 'high',

	// List of meta fields
	'fields' => array(

		array(
			'name'      => __('Shortcode/Embedded Content', 'meydjer'),
			'id'        => "{$prefix}audio",
			'class'     => "field-{$prefix}audio",
			'type'      => 'textarea',
			'std'       => __('Paste here the Shortcode of the HTML code of you embedded content (E.g.: Soundcloud music).', 'meydjer'),
			'cols'      => "40",
			'rows'      => "8"
		)

	)

);



$ml_post_meta[] = array(

	// Meta box id, UNIQUE per meta box
	'id' => $prefix . 'm_gallery',

	// Meta box title - Will appear at the drag and drop handle bar
	'title' => __('Gallery', 'meydjer'),

	// Post types, accept custom post types as well - DEFAULT is array('post'); (optional)
	'pages' => array( 'post' ),

	// Where the meta box appear: normal (default), advanced, side; optional
	'context' => 'normal',

	// Order of meta box: high (default), low; optional
	'priority' => 'high',

	// List of meta fields
	'fields' => array(

		array(
			'name'  => __('Gallery', 'meydjer'),
			'id'    => "{$prefix}gallery",
			'class' => "field-{$prefix}gallery",
			'type'  => 'plupload_image'
		)

	)

);



$ml_post_meta[] = array(

	// Meta box id, UNIQUE per meta box
	'id' => $prefix . 'm_image',

	// Meta box title - Will appear at the drag and drop handle bar
	'title' => __('Image', 'meydjer'),

	// Post types, accept custom post types as well - DEFAULT is array('post'); (optional)
	'pages' => array( 'post' ),

	// Where the meta box appear: normal (default), advanced, side; optional
	'context' => 'normal',

	// Order of meta box: high (default), low; optional
	'priority' => 'high',

	// List of meta fields
	'fields' => array(

		array(
			'id'    => "{$prefix}image",
			'class' => "field-{$prefix}image",
			'desc'  => __('The Image Post Format uses your Featured Image.', 'meydjer'),
			'type'  => 'info'
		)

	)

);



/**
 * Register meta boxes
 *
 * @return void
 */


function ml_post_register_meta_boxes()
{
	global $ml_post_meta;

	if ( class_exists( 'RW_Meta_Box' ) )
	{
		foreach ( $ml_post_meta as $meta_box )
		{
			new RW_Meta_Box( $meta_box );
		}
	}
}



// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'ml_post_register_meta_boxes' );