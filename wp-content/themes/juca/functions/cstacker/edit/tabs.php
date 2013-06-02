<?php

$post_id = $_POST['post_id'];

$args = array(
	'numberposts' => -1,
	'order'       => 'ASC',
	'post_parent' => $post_id,
	'post_type'   => 'ml_cstacker'
	);

$tabs_array = get_posts($args);

?>

<div class="ml-cs-message-area"></div>

<div class="clearfix"></div><br />

<ul class="ml-tabs-list" id="ml-tabs-list-<?php echo $post_id ?>">
	

<?php if($tabs_array) : foreach($tabs_array as $tab) :

	$tab_title   = get_post_meta( $tab->ID, '_ml_cs_tab_title',   true );
	$tab_content = get_post_meta( $tab->ID, '_ml_cs_tab_content', true );

	?>

	<li id="ml-tab-li-<?php echo $tab->ID ?>" class="ml-tab-li" data-id="<?php echo $tab->ID ?>">

		<div class="ml-single-tab widget" style="">
			<div class="widget-top">
				<div class="widget-title-action">
					<a class="ml-tab-js ml-pseudowidget-action widget-action hide-if-no-js" href="#available-widgets"></a>
					<a class="widget-control-edit hide-if-js" href="/omni/wp-admin/widgets.php?editwidget=text-4&amp;sidebar=ml-all&amp;key=0"><span class="edit"><?php _e('Edit', 'meydjer') ?></span><span class="add"><?php _e('Add', 'meydjer') ?></span></a>
				</div>
				<div class="widget-title">
					<h4><?php _e('Tab', 'meydjer') ?>:<span class="in-widget-title" id="in-widget-title-<?php echo $tab->ID ?>"> <?php echo $tab_title ?></span></h4>
				</div>
			</div>


			<div id="ml-pseudowidget-inside-<?php echo $tab->ID ?>" class="widget-inside" style="display: none; ">

				<div class="widget-content">
					<p><label for="widget-text-4-title"><?php _e('Title', 'meydjer') ?>:</label>
					<input class="ml-tab-title widefat" type="text" value="<?php echo $tab_title ?>"></p>

					<textarea class="ml-tab-content widefat" rows="16" cols="20"><?php echo $tab_content ?></textarea>
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

<?php endforeach; endif; ?>


</ul>

<div class="clearfix"></div><br><br>


<a href="#" class="ml-cs-tabs-add ml-admin-button ml-secondary" id="ml-cs-tabs-add-<?php echo $post_id ?>">+&nbsp; <?php _e('Add Tab', 'meydjer') ?></a> &nbsp; &nbsp;
<a href="#" class="ml-cs-fake-save ml-cs-tabs-save ml-admin-button ml-primary" id="ml-cs-tabs-save-<?php echo $post_id ?>"><?php _e('Done', 'meydjer') ?></a>

<div class="clearfix"></div><br />