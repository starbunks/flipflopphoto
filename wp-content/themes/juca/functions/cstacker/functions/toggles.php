<?php

/*-------------------------------------------------*/
/*	1. CREATE TOGGLE
/*-------------------------------------------------*/

add_action('wp_ajax_ml_cstacker_add_toggle', 'ml_cstacker_add_toggle_callback');

function ml_cstacker_add_toggle_callback() {

	$parent_post_id     = $_POST['post_id'];
	$new_toggle_title   = __('Toggle Title', 'meydjer');
	$new_toggle_content = __('Toggle Content...', 'meydjer');

	$post = array(
		'comment_status' => 'closed',
		'ping_status'    => 'closed',
		'post_content'   => 'ml-cs-toggle',
		'post_status'    => 'publish',
		'post_title'     => 'ml-cs-toggle',
		'post_type'      => 'ml_cstacker',
		'post_parent'    => $parent_post_id,
	);


	/*--- Create Post and send Content Block via AJAX ---*/

	if ($new_post_id = wp_insert_post( $post )) :

		add_post_meta($new_post_id, '_ml_cs_toggle_title', $new_toggle_title);
		add_post_meta($new_post_id, '_ml_cs_toggle_content', $new_toggle_content);

		?>

			<li id="ml-toggle-li-<?php echo $new_post_id ?>" class="ml-toggle-li" data-id="<?php echo $new_post_id ?>">

				<div class="ml-single-toggle widget" style="">
					<div class="widget-top">
						<div class="widget-title-action">
							<a class="ml-toggle-js ml-pseudowidget-action widget-action hide-if-no-js" href="#available-widgets"></a>
							<a class="widget-control-edit hide-if-js" href="/omni/wp-admin/widgets.php?editwidget=text-4&amp;sidebar=ml-all&amp;key=0"><span class="edit"><?php _e('Edit', 'meydjer') ?></span><span class="add"><?php _e('Add', 'meydjer') ?></span></a>
						</div>
						<div class="widget-title">
							<h4><?php _e('Toggle', 'meydjer') ?>:<span class="in-widget-title" id="in-widget-title-<?php echo $new_post_id ?>"> <?php echo $new_toggle_title ?></span></h4>
						</div>
					</div>


					<div id="ml-pseudowidget-inside-<?php echo $new_post_id ?>" class="widget-inside" style="display: none; ">

						<div class="widget-content">
							<p><label for="widget-text-4-title"><?php _e('Title', 'meydjer') ?>:</label>
							<input class="ml-toggle-title widefat" type="text" value="<?php echo $new_toggle_title ?>"></p>

							<textarea class="ml-toggle-content widefat" rows="16" cols="20"><?php echo $new_toggle_content ?></textarea>
						</div>

						<div class="widget-control-actions">
							<div class="alignleft">
								<a href="#" class="button-primary ml-toggle-js ml-pseudowidget-save"><?php _e('Save', 'meydjer') ?></a>
								<a class="ml-toggle-js ml-pseudowidget-remove widget-control-remove" href="#remove"><?php _e('Delete', 'meydjer') ?></a> |
								<a class="ml-toggle-js ml-pseudowidget-close widget-control-close" href="#close"><?php _e('Close', 'meydjer') ?></a>
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
/*	2. UPDATE TOGGLE
/*-------------------------------------------------*/

add_action('wp_ajax_ml_cstacker_update_toggle', 'ml_cstacker_update_toggle_callback');

function ml_cstacker_update_toggle_callback() {

	$post_id         = $_POST['post_id'];
	$toggle_title    = $_POST['toggle_title'];
	$toggle_content  = $_POST['toggle_content'];

	update_post_meta($post_id, '_ml_cs_toggle_title', $toggle_title);
	update_post_meta($post_id, '_ml_cs_toggle_content', $toggle_content);

	die();

}




/*-------------------------------------------------*/
/*	3. DELETE TOGGLE
/*-------------------------------------------------*/

add_action('wp_ajax_ml_cstacker_delete_toggle', 'ml_cstacker_delete_toggle_callback');

function ml_cstacker_delete_toggle_callback() {

	$post_id  = $_POST['post_id'];

	if (!wp_delete_post( $post_id, true ))
		echo 'error' ;

	die();

}




/*-------------------------------------------------*/
/*	4. UPDATE OPTION
/*-------------------------------------------------*/

add_action('wp_ajax_ml_cstacker_toggles_option', 'ml_cstacker_toggles_option_callback');

function ml_cstacker_toggles_option_callback() {

	$post_id = $_POST['post_id'];
	$option  = $_POST['option'];
	$boolean = $_POST['this_boolean'];

	if (!update_post_meta($post_id, '_ml_cs_toggles_'.$option, $boolean))
		echo 'error' ;

	die();

}
