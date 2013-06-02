<?php

/*-------------------------------------------------*/
/*	1. CREATE WELCOME MESSAGE
/*-------------------------------------------------*/

add_action('wp_ajax_ml_cstacker_add_welcome', 'ml_cstacker_add_welcome_callback');

function ml_cstacker_add_welcome_callback() {

	$parent_post_id      = $_POST['post_id'];
	$new_welcome_content = __('Welcome Message...', 'meydjer');

	$post = array(
		'comment_status' => 'closed',
		'ping_status'    => 'closed',
		'post_content'   => 'ml-cs-welcome',
		'post_status'    => 'publish',
		'post_title'     => 'ml-cs-welcome',
		'post_type'      => 'ml_cstacker',
		'post_parent'    => $parent_post_id,
	);


	/*--- Create Post and send Content Block via AJAX ---*/

	if ($new_post_id = wp_insert_post( $post )) :

		add_post_meta($new_post_id, '_ml_cs_welc_content', $new_welcome_content);

		?>

			<li id="ml-welcome-li-<?php echo $new_post_id ?>" class="ml-welcome-li" data-id="<?php echo $new_post_id ?>">

				<div class="ml-single-welcome widget" style="">
					<div class="widget-top">
						<div class="widget-title-action">
							<a class="ml-welcome-js ml-pseudowidget-action widget-action hide-if-no-js" href="#available-widgets"></a>
							<a class="widget-control-edit hide-if-js" href="/omni/wp-admin/widgets.php?editwidget=text-4&amp;sidebar=ml-all&amp;key=0"><span class="edit"><?php _e('Edit', 'meydjer') ?></span><span class="add"><?php _e('Add', 'meydjer') ?></span></a>
						</div>
						<div class="widget-title">
							<h4><?php _e('Content', 'meydjer') ?>:<span class="in-widget-title" id="in-widget-title-<?php echo $new_post_id ?>"> <?php echo ml_custom_excerpt($new_welcome_content, 3) ?></span></h4>
						</div>
					</div>


					<div id="ml-pseudowidget-inside-<?php echo $new_post_id ?>" class="widget-inside" style="display: none; ">

						<div class="widget-content">
							<textarea class="ml-welcome-content widefat" rows="16" cols="20"><?php echo $new_welcome_content ?></textarea>
						</div>

						<div class="widget-control-actions">
							<div class="alignleft">
								<a href="#" class="button-primary ml-welcome-js ml-pseudowidget-save"><?php _e('Save', 'meydjer') ?></a>
								<a class="ml-welcome-js ml-pseudowidget-remove widget-control-remove" href="#remove"><?php _e('Delete', 'meydjer') ?></a> |
								<a class="ml-welcome-js ml-pseudowidget-close widget-control-close" href="#close"><?php _e('Close', 'meydjer') ?></a>
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
/*	2. UPDATE WELCOME MESSAGE
/*-------------------------------------------------*/

add_action('wp_ajax_ml_cstacker_update_welcome', 'ml_cstacker_update_welcome_callback');

function ml_cstacker_update_welcome_callback() {

	$post_id         = $_POST['post_id'];
	$welcome_content = $_POST['welcome_content'];

	update_post_meta($post_id, '_ml_cs_welc_content', $welcome_content);

	die();

}






/*-------------------------------------------------*/
/*	3. DELETE WELCOME MESSAGE
/*-------------------------------------------------*/

add_action('wp_ajax_ml_cstacker_delete_welcome', 'ml_cstacker_delete_welcome_callback');

function ml_cstacker_delete_welcome_callback() {

	$post_id  = $_POST['post_id'];

	if (!wp_delete_post( $post_id, true ))
		echo 'error' ;

	die();

}







