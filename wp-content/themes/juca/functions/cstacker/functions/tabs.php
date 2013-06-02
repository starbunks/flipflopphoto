<?php

/*-------------------------------------------------*/
/*	1. CREATE TAB
/*-------------------------------------------------*/

add_action('wp_ajax_ml_cstacker_add_tab', 'ml_cstacker_add_tab_callback');

function ml_cstacker_add_tab_callback() {

	$parent_post_id  = $_POST['post_id'];
	$new_tab_title   = __('Tab Title', 'meydjer');
	$new_tab_content = __('Tab Content...', 'meydjer');

	$post = array(
		'comment_status' => 'closed',
		'ping_status'    => 'closed',
		'post_content'   => 'ml-cs-tab',
		'post_status'    => 'publish',
		'post_title'     => 'ml-cs-tab',
		'post_type'      => 'ml_cstacker',
		'post_parent'    => $parent_post_id,
	);


	/*--- Create Post and send Content Block via AJAX ---*/

	if ($new_post_id = wp_insert_post( $post )) :

		add_post_meta($new_post_id, '_ml_cs_tab_title', $new_tab_title);
		add_post_meta($new_post_id, '_ml_cs_tab_content', $new_tab_content);

		?>

			<li id="ml-tab-li-<?php echo $new_post_id ?>" class="ml-tab-li" data-id="<?php echo $new_post_id ?>">

				<div class="ml-single-tab widget" style="">
					<div class="widget-top">
						<div class="widget-title-action">
							<a class="ml-tab-js ml-pseudowidget-action widget-action hide-if-no-js" href="#available-widgets"></a>
							<a class="widget-control-edit hide-if-js" href="/omni/wp-admin/widgets.php?editwidget=text-4&amp;sidebar=ml-all&amp;key=0"><span class="edit"><?php _e('Edit', 'meydjer') ?></span><span class="add"><?php _e('Add', 'meydjer') ?></span></a>
						</div>
						<div class="widget-title">
							<h4><?php _e('Tab', 'meydjer') ?>:<span class="in-widget-title" id="in-widget-title-<?php echo $new_post_id ?>"> <?php echo $new_tab_title ?></span></h4>
						</div>
					</div>


					<div id="ml-pseudowidget-inside-<?php echo $new_post_id ?>" class="widget-inside" style="display: none; ">

						<div class="widget-content">
							<p><label for="widget-text-4-title"><?php _e('Title', 'meydjer') ?>:</label>
							<input class="ml-tab-title widefat" type="text" value="<?php echo $new_tab_title ?>"></p>

							<textarea class="ml-tab-content widefat" rows="16" cols="20"><?php echo $new_tab_content ?></textarea>
						</div>

						<div class="widget-control-actions">
							<div class="alignleft">
								<a href="#" class="button-primary ml-tab-js ml-pseudowidget-save"><?php _e('Save', 'meydjer') ?></a>
								<a class="ml-tab-js ml-pseudowidget-remove widget-control-remove" href="#remove"><?php _e('Delete', 'meydjer') ?></a> |
								<a class="ml-tab-js ml-pseudowidget-close widget-control-close" href="#close"><?php _e('Close', 'meydjer') ?></a>
							</div>
							<div class="alignright">
								<img src="http://themes.dev:8888/omni/wp-admin/images/wpspin_light.gif" class="ajax-feedback" title="" alt="">
								<br class="clear">
							</div>
							<div class="clearfix"></div>
						</div>

					</div>

				</div>

			</li>

		<?php

	else :

		echo 'error';

	endif;

	die();

}




/*-------------------------------------------------*/
/*	2. UPDATE TAB
/*-------------------------------------------------*/

add_action('wp_ajax_ml_cstacker_update_tab', 'ml_cstacker_update_tab_callback');

function ml_cstacker_update_tab_callback() {

	$post_id      = $_POST['post_id'];
	$tab_title    = $_POST['tab_title'];
	$tab_content  = $_POST['tab_content'];

	update_post_meta($post_id, '_ml_cs_tab_title', $tab_title);
	update_post_meta($post_id, '_ml_cs_tab_content', $tab_content);

	die();

}






/*-------------------------------------------------*/
/*	3. DELETE TAB
/*-------------------------------------------------*/

add_action('wp_ajax_ml_cstacker_delete_tab', 'ml_cstacker_delete_tab_callback');

function ml_cstacker_delete_tab_callback() {

	$post_id  = $_POST['post_id'];

	if (!wp_delete_post( $post_id, true ))
		echo 'error' ;

	die();

}







