<?php

wp_enqueue_script('jquery-ui-core');
wp_enqueue_script('jquery-ui-tabs');

$args = array(
	'numberposts' => -1,
	'order'       => 'ASC',
	'post_parent' => $content->ID,
	'post_type'   => 'ml_cstacker'
	);

$tabs_array = get_posts($args);

?>

<!-- .ml-ui-tabs -->
<div class="ml-ui-tabs">

	<ul class="ml-clean-ul">

		<?php if($tabs_array) : foreach ($tabs_array as $tab) :

			$saved_title        = (get_post_meta($tab->ID, '_ml_cs_tab_title', true));
			$callback_tab_title = __('Tab Title', 'meydjer');
			$tab_title          = ($saved_title) ? $saved_title : $callback_tab_title;

			?>

			<li>
				<a href="#ml-tab-id-<?php echo $tab->ID ?>" rel="nofollow"><?php echo $tab_title ?></a>
			</li>

		<?php endforeach; endif; ?>

	</ul>

	<div class="ml-ui-tabs-contents">

		<?php if($tabs_array) : foreach ($tabs_array as $tab) :

			$saved_content        = (get_post_meta($tab->ID, '_ml_cs_tab_content', true));
			$callback_tab_content = __('Tab Content...', 'meydjer');
			$tab_content          = ($saved_content) ? $saved_content : $callback_tab_content;
			$tab_content          = ml_p($tab_content);

			?>

			<div id="ml-tab-id-<?php echo $tab->ID ?>">
				<?php echo do_shortcode($tab_content) ?>
			</div>

		<?php endforeach; endif; ?>

	</div>

</div>
<!-- /.ml-ui-tabs -->

<div class="clearfix"></div>