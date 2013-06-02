<?php

$built_in_seo = of_get_option('ml-built-in_seo', 1);

if ($built_in_seo == 1) {

	/*-------------------------------------------------*/
	/*  1. SEO Options
	/*-------------------------------------------------*/

	$prefix = '_ml_seo_';

	global $ml_seo_meta;

	$ml_seo_meta = array();

	$ml_seo_meta[] = array(

		// Meta box id, UNIQUE per meta box
		'id' => 'seo',

		// Meta box title - Will appear at the drag and drop handle bar
		'title' => __('SEO', 'meydjer'),

		// Post types, accept custom post types as well - DEFAULT is array('post'); (optional)
		'pages' => array('post', 'page'),

		// Where the meta box appear: normal (default), advanced, side; optional
		'context' => 'normal',

		// Order of meta box: high (default), low; optional
		'priority' => 'low',

		// List of meta fields
		'fields' => array(

			array(
				'name'  	=> __('Title', 'meydjer'),
				'id'		=> "{$prefix}title",
				'class' 	=> "field-{$prefix}title",
				'type'  	=> 'text',
				'clone'		=> false,
				'desc'   	=> __('Recommended size: 60 chars.', 'meydjer'),
			),

			array(
				'name'  	=> __('Description', 'meydjer'),
				'id'		=> "{$prefix}description",
				'class' 	=> "field-{$prefix}description",
				'type'  	=> 'textarea',
				'desc'   	=> __('Recommended size: 160 chars.', 'meydjer'),
				'cols'  	=> "40",
				'rows'  	=> "4"
			),

			array(
				'name'  	=> __('Keywords', 'meydjer'),
				'id'		=> "{$prefix}keywords",
				'class' 	=> "field-{$prefix}keywords",
				'type'  	=> 'textarea',
				'desc'   	=> __('A comma separated list of keywords.', 'meydjer'),
				'cols'  	=> "40",
				'rows'  	=> "4"
			),

			array(
				'name'  	=> __('Meta Robots Index', 'meydjer'),
				'id'		=> "{$prefix}index",
				'class' 	=> "field-{$prefix}index",
				'type'  	=> 'radio',
				'desc'   	=> __('Do you want meta robots to index this page?', 'meydjer'),
				'std'   	=> 'index',
				'options'	=> array(
					'index'			=> __('Index', 'meydjer'),
					'noindex'			=> __("Don't Index", 'meydjer')
				)
			),

			array(
				'name'  	=> __('Meta Robots Follow', 'meydjer'),
				'id'		=> "{$prefix}follow",
				'class' 	=> "field-{$prefix}follow",
				'type'  	=> 'radio',
				'desc'   	=> __('Do you want meta robots to follow links from this page?', 'meydjer'),
				'std'   	=> 'follow',
				'options'	=> array(
					'follow'			=> __('Follow', 'meydjer'),
					'nofollow'			=> __("Don't Follow", 'meydjer')
				)
			),

		)

	);



	/**
	 * Register meta boxes
	 *
	 * @return void
	 */

	function ml_seo_register_meta_boxes()
	{
		global $ml_seo_meta;

		if ( class_exists( 'RW_Meta_Box' ) )
		{
			foreach ( $ml_seo_meta as $meta_box )
			{
				new RW_Meta_Box( $meta_box );
			}
		}
	}

	add_action( 'admin_init', 'ml_seo_register_meta_boxes' );

}
