<?php

if(is_admin()) {

	add_action('wp_ajax_ml_cstacker_portfolio', 'ml_cstacker_portfolio_callback');

	function ml_cstacker_portfolio_callback() {

		$post_id       = $_POST['post_id'];
		$show_filter   = $_POST['show_filter'];
		$show_items    = $_POST['show_items'];
		$portfolio_ids = $_POST['portfolio_ids'];

		update_post_meta($post_id, '_ml_cs_port_shw_filter', $show_filter);
		update_post_meta($post_id, '_ml_cs_port_shw_items', $show_items);
		update_post_meta($post_id, '_ml_cs_port_items', $portfolio_ids);

		die();

	}

}