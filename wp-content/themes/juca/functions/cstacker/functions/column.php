<?php

add_action('wp_ajax_ml_cstacker_column', 'ml_cstacker_column_callback');

function ml_cstacker_column_callback() {

	$post_id          = $_POST['post_id'];
	$column_text      = $_POST['column_text'];

	update_post_meta($post_id, '_ml_cs_column_text', $column_text);

	die();

}

