<?php

add_action('wp_ajax_ml_cstacker_cta', 'ml_cstacker_cta_callback');

function ml_cstacker_cta_callback() {

	$post_id       = $_POST['post_id'];
	$cta_title     = $_POST['cta_title'];
	$cta_btn_text  = $_POST['cta_btn_text'];
	$cta_btn_link  = $_POST['cta_btn_link'];

	update_post_meta($post_id, '_ml_cs_cta_title', $cta_title);
	update_post_meta($post_id, '_ml_cs_cta_btn_text', $cta_btn_text);
	update_post_meta($post_id, '_ml_cs_cta_btn_link', $cta_btn_link);

	die();

}

