<?php

$post_id = $_POST['post_id'];

$args = array(
	'numberposts' => -1,
	'order'       => 'ASC',
	'post_parent' => $post_id,
	'post_type'   => 'ml_cstacker'
	);

$wmessages_array = get_posts($args);

?>

<div class="ml-cs-message-area"></div>

<div class="clearfix"></div><br />

<ul class="ml-wmessages-list" id="ml-wmessages-list-<?php echo $post_id ?>">
	

<?php if($wmessages_array) : foreach($wmessages_array as $welcome) :

	$welcome_content = get_post_meta( $welcome->ID, '_ml_cs_welc_content', true );

	?>

	<li id="ml-welcome-li-<?php echo $welcome->ID ?>" class="ml-welcome-li" data-id="<?php echo $welcome->ID ?>">

		<div class="ml-single-welcome widget" style="">
			<div class="widget-top">
				<div class="widget-title-action">
					<a class="ml-welcome-js ml-pseudowidget-action widget-action hide-if-no-js" href="#available-widgets"></a>
					<a class="widget-control-edit hide-if-js" href="/omni/wp-admin/widgets.php?editwidget=text-4&amp;sidebar=ml-all&amp;key=0"><span class="edit"><?php _e('Edit', 'meydjer') ?></span><span class="add"><?php _e('Add', 'meydjer') ?></span></a>
				</div>
				<div class="widget-title">
					<h4><?php _e('Content', 'meydjer') ?>:<span class="in-widget-title" id="in-widget-title-<?php echo $welcome->ID ?>"> <?php echo ml_custom_excerpt($welcome_content, 3) ?></span></h4>
				</div>
			</div>


			<div id="ml-pseudowidget-inside-<?php echo $welcome->ID ?>" class="widget-inside" style="display: none; ">

				<div class="widget-content">
					<textarea class="ml-welcome-content widefat" rows="16" cols="20"><?php echo $welcome_content ?></textarea>
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

<?php endforeach; endif; ?>


</ul>

<div class="clearfix"></div><br><br>


<a href="#" class="ml-cs-wmessages-add ml-admin-button ml-secondary" id="ml-cs-wmessages-add-<?php echo $post_id ?>">+&nbsp; <?php _e('Add Welcome Message', 'meydjer') ?></a> &nbsp; &nbsp;
<a href="#" class="ml-cs-fake-save ml-cs-wmessages-save ml-admin-button ml-primary" id="ml-cs-wmessages-save-<?php echo $post_id ?>"><?php _e('Done', 'meydjer') ?></a>

<div class="clearfix"></div><br />