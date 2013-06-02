<?php

add_action('wp_ajax_ml_cstacker_alert', 'ml_cstacker_alert_callback');

function ml_cstacker_alert_callback() {

	$post_id         = $_POST['post_id'];
	$alert_color     = $_POST['alert_color'];
	$alert_text      = $_POST['alert_text'];
	$alert_text_size = $_POST['alert_text_size'];

	update_post_meta($post_id, '_ml_cs_alert_color', $alert_color);
	update_post_meta($post_id, '_ml_cs_alert_text', $alert_text);
	update_post_meta($post_id, '_ml_cs_alert_text_size', $alert_text_size);

	die();

}

