<?php

add_action('wp_ajax_ml_cstacker_title', 'ml_cstacker_title_callback');

function ml_cstacker_title_callback() {

	$post_id         = $_POST['post_id'];
	$title_text      = $_POST['title_text'];
	$title_class     = $_POST['title_class'];
	$title_size      = $_POST['title_size'];
	$title_alignment = $_POST['title_alignment'];

	update_post_meta($post_id, '_ml_cs_title_text',      $title_text);
	update_post_meta($post_id, '_ml_cs_title_class',     $title_class);
	update_post_meta($post_id, '_ml_cs_title_size',      $title_size);
	update_post_meta($post_id, '_ml_cs_title_alignment', $title_alignment);

	die();

}

