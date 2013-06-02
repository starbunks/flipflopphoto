<?php

add_action('wp_ajax_ml_cstacker_slider', 'ml_cstacker_slider_callback');

function ml_cstacker_slider_callback() {

	$post_id		= $_POST['post_id'];
	$slider_id	= $_POST['slider_id'];
	$post_type	= 'slider';

	update_post_meta($post_id, '_ml_cs_slider', $slider_id);

	die();

}

