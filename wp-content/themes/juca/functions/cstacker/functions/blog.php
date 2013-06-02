<?php

add_action('wp_ajax_ml_cstacker_blog', 'ml_cstacker_blog_callback');

function ml_cstacker_blog_callback() {

	$post_id = $_POST['post_id'];
	$show    = $_POST['show'];

	update_post_meta($post_id, '_ml_cs_blog_show', $show);

	die();

}