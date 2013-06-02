<?php

add_action('wp_ajax_ml_cstacker_divider', 'ml_cstacker_divider_callback');

function ml_cstacker_divider_callback() {

	$post_id      = $_POST['post_id'];
	$divider_text = $_POST['divider_text'];

	update_post_meta($post_id, '_ml_cs_divider_text', $divider_text);

	die();

}

