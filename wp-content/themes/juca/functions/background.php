<?php

/*-------------------------------------------------*/
/*    1. META BOX
/*-------------------------------------------------*/


$prefix = '_ml_bg_';

global $ml_background_meta;

$ml_background_meta = array();

$ml_background_meta[] = array(

	// Meta box id, UNIQUE per meta box
	'id' => 'bg_content',

	// Meta box title - Will appear at the drag and drop handle bar
	'title' => __('Background', 'meydjer'),

	// Post types, accept custom post types as well - DEFAULT is array('post'); (optional)
	'pages' => array( 'post', 'page' ),

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
			'class'     => "{$prefix}type-radio",
			'options'   => array(
				'default' => __('Default', 'meydjer'),
				'video'   => __('Video', 'meydjer'),
				'images'  => __('Images', 'meydjer')
			),
			'std'       => 'default'
		),

		array(
			'id'    => "{$prefix}image",
			'class' => "field-{$prefix}video",
			'desc'  => __("<strong>Note:</strong> You will need to setup an image slider as a fallback for mobile devices (they don't allow video autoplay).", 'meydjer'),
			'type'  => 'info'
		),

		array(
			'name'  => __('M4V video file', 'meydjer'),
			'id'    => "{$prefix}m4v",
			'class' => "field-{$prefix}video",
			"desc"		=> __('<strong>Tip</strong>: You can just change your ".mp4" video extension to ".m4v". <br><br>You will need the ".ogv" version too.', 'meydjer'),
			'type'  => 'file'
		),

		array(
			'name'  => __('OGV video file', 'meydjer'),
			'id'    => "{$prefix}ogv",
			'class' => "field-{$prefix}video",
			"desc"		=> __('<strong>Tip</strong>: If you need, you can convert your video to ".ogv" at <a href="http://video.online-convert.com/convert-to-ogg" target="_blank">Online-Convert.com</a>. <br><br>You will need the ".m4v" version too.', 'meydjer'),
			'type'  => 'file'
		),

		array(
			'name'  => __('Images', 'meydjer'),
			'id'    => "{$prefix}images",
			'class' => "field-{$prefix}images",
			'type'  => 'plupload_image',
		)

	)

);


/**
 * Register meta boxes
 *
 * @return void
 */

function ml_background_register_meta_boxes()
{
	global $ml_background_meta;

	if ( class_exists( 'RW_Meta_Box' ) )
	{
		foreach ( $ml_background_meta as $meta_box )
		{
			new RW_Meta_Box( $meta_box );
		}
	}
}

add_action( 'admin_init', 'ml_background_register_meta_boxes' );



/*-------------------------------------------------*/
/* 2. FUNCTIONS
/*-------------------------------------------------*/

function ml_get_bg($post_id) {


	$this_bg_option = get_post_meta( $post_id, '_ml_bg_type', true );


	/*--- Get the Default Background via Options Panel ---*/

	if( ($this_bg_option != 'video') && ($this_bg_option != 'images') ) {

		$bg_type = of_get_option('ml-bg-type', 'video');
		echo '<input type="hidden" id="ml-bg-type" value="'.$bg_type.'">';

		if($bg_type == 'video') {
			$m4v = of_get_option('ml-m4v');
			$ogv = of_get_option('ml-ogv');
			echo '<input type="hidden" id="ml-m4v" value="'.$m4v.'">';
			echo '<input type="hidden" id="ml-ogv" value="'.$ogv.'">';

		}

		$bg_slide_num     = of_get_option('ml-bg-slide-num', 1);

		for ($i=1; $i <= $bg_slide_num; $i++) {
			$img      = of_get_option('ml-bg-slide-'.$i);
			$img_size = getimagesize($img);
			echo '<input type="hidden" class="ml-bg-slide-num" id="ml-bg-slide-num-'.$i.'" value="'.$img.'" data-width="'.$img_size[0].'" data-height="'.$img_size[1].'">';
		}



	/*--- Get the Current Background via Meta-Box ---*/

	} else {

		$bg_type = $this_bg_option;
		echo '<input type="hidden" id="ml-bg-type" value="'.$bg_type.'">';

		if($bg_type == 'video') {
			$m4v = ml_uploaded_files( $post_id, '_ml_bg_m4v');
			$ogv = ml_uploaded_files( $post_id, '_ml_bg_ogv');

			echo '<input type="hidden" id="ml-m4v" value="'.$m4v[0].'">';
			echo '<input type="hidden" id="ml-ogv" value="'.$ogv[0].'">';

		}

		$bg_slides = ml_uploaded_images($post_id, '_ml_bg_images');

		$count_img=0;

		if($bg_slides) {

			foreach ($bg_slides as $img) {
				$count_img++;
				$img_size = getimagesize($img);
				echo '<input type="hidden" class="ml-bg-slide-num" id="ml-bg-slide-num-'.$count_img.'" value="'.$img.'" data-width="'.$img_size[0].'" data-height="'.$img_size[1].'">';

			}

		} else {
			$bg_slide_num     = of_get_option('ml-bg-slide-num', 1);

			for ($i=1; $i <= $bg_slide_num; $i++) {
				$img      = of_get_option('ml-bg-slide-'.$i);
				$img_size = getimagesize($img);
				echo '<input type="hidden" class="ml-bg-slide-num" id="ml-bg-slide-num-'.$i.'" value="'.$img.'" data-width="'.$img_size[0].'" data-height="'.$img_size[1].'">';
			}
			
		}

	}


}


