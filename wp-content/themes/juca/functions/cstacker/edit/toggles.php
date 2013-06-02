<?php

$post_id = $_POST['post_id'];

$args = array(
	'numberposts' => -1,
	'order'       => 'ASC',
	'post_parent' => $post_id,
	'post_type'   => 'ml_cstacker'
	);

$toggles_array = get_posts($args);


$toggle_first = (get_post_meta( $post_id, '_ml_cs_toggles_first', true ) == 'true') ? 'checked="checked"' : '';
$one_allowed  = (get_post_meta( $post_id, '_ml_cs_toggles_one',   true ) == 'true') ? 'checked="checked"' : '';

?>

<div class="ml-cs-message-area"></div>

<div class="clearfix"></div><br />

<ul class="ml-toggles-list" id="ml-toggles-list-<?php echo $post_id ?>">
	

<?php if($toggles_array) : foreach($toggles_array as $toggle) :

	$toggle_title   = get_post_meta( $toggle->ID, '_ml_cs_toggle_title',   true );
	$toggle_content = get_post_meta( $toggle->ID, '_ml_cs_toggle_content', true );

	?>

	<li id="ml-toggle-li-<?php echo $toggle->ID ?>" class="ml-toggle-li" data-id="<?php echo $toggle->ID ?>">

		<div class="ml-single-toggle widget" style="">
			<div class="widget-top">
				<div class="widget-title-action">
					<a class="ml-toggle-js ml-pseudowidget-action widget-action hide-if-no-js" href="#available-widgets"></a>
					<a class="widget-control-edit hide-if-js" href="/omni/wp-admin/widgets.php?editwidget=text-4&amp;sidebar=ml-all&amp;key=0"><span class="edit"><?php _e('Edit', 'meydjer') ?></span><span class="add"><?php _e('Add', 'meydjer') ?></span></a>
				</div>
				<div class="widget-title">
					<h4><?php _e('Toggle', 'meydjer') ?>:<span class="in-widget-title" id="in-widget-title-<?php echo $toggle->ID ?>"> <?php echo $toggle_title ?></span></h4>
				</div>
			</div>


			<div id="ml-pseudowidget-inside-<?php echo $toggle->ID ?>" class="widget-inside" style="display: none; ">

				<div class="widget-content">
					<p><label for="widget-text-4-title"><?php _e('Title', 'meydjer') ?>:</label>
					<input class="ml-toggle-title widefat" type="text" value="<?php echo $toggle_title ?>"></p>

					<textarea class="ml-toggle-content widefat" rows="16" cols="20"><?php echo $toggle_content ?></textarea>
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

<?php endforeach; endif; ?>


</ul>

<div class="clearfix"></div>



<label for="ml-toggle-first-<?php echo $post_id ?>">
	<input type="checkbox" name="ml-toggle-first" class="ml-toggle-first" id="ml-toggle-first-<?php echo $post_id ?>" data-option="first" <?php echo $toggle_first ?>>
	<?php _e('Toggle First', 'meydjer') ?>
</label>

<div class="clearfix"></div>

<label for="ml-toggle-one-allowed-<?php echo $post_id ?>">
	<input type="checkbox" name="ml-toggle-one-allowed" class="ml-toggle-one-allowed" id="ml-toggle-one-allowed-<?php echo $post_id ?>" data-option="one" <?php echo $one_allowed ?>>
	<?php _e('Only One Toggle Is Allowed', 'meydjer') ?>
</label>

<div class="clearfix"></div><br><br>




<a href="#" class="ml-cs-toggles-add ml-admin-button ml-secondary" id="ml-cs-toggles-add-<?php echo $post_id ?>">+&nbsp; <?php _e('Add Toggle', 'meydjer') ?></a> &nbsp; &nbsp;
<a href="#" class="ml-cs-toggles-save ml-admin-button ml-primary" id="ml-cs-toggles-save-<?php echo $post_id ?>"><?php _e('Done', 'meydjer') ?></a>

<div class="clearfix"></div><br />