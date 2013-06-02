<?php

$args = array(
	'numberposts' => -1,
	'order'       => 'ASC',
	'post_parent' => $content->ID,
	'post_type'   => 'ml_cstacker'
	);

$wmessages_array = get_posts($args);

?>
<div class="ml-wlcm">
	<div class="ml-wlcm-top"></div>
	<!-- .ml-wrapper -->
	<div class="ml-wrapper">
		<?php

		$count_welc=0;

		if($wmessages_array) : foreach ($wmessages_array as $welcome) :

			$count_welc++;

			$saved_content         = (get_post_meta($welcome->ID, '_ml_cs_welc_content', true));
			$callback_welc_content = __('Welcome Content...', 'meydjer');
			$welcome_content       = ($saved_content) ? $saved_content : $callback_welc_content;
			$welcome_content       = ml_p($welcome_content);

			$active_welcome        = ($count_welc == 1) ? 'ml-active-welc' : '';

			?>

			<div class="ml-welc-cont <?php echo $active_welcome ?>" data-rel="<?php echo $count_welc ?>">
				<?php echo do_shortcode($welcome_content) ?>
			</div>

		<?php endforeach; endif; ?>
	</div>
	<!-- /.ml-wrapper -->
	<div class="ml-wlcm-bottom"></div>
</div>