<?php

$args = array(
	'numberposts' => -1,
	'order'       => 'ASC',
	'post_parent' => $content->ID,
	'post_type'   => 'ml_cstacker'
	);

$toggles_array = get_posts($args);


$toggle_first = (get_post_meta( $content->ID, '_ml_cs_toggles_first', true ) == 'true') ? ' ml-toggle-first' : '';
$one_allowed  = (get_post_meta( $content->ID, '_ml_cs_toggles_one',   true ) == 'true') ? ' ml-one-allowed'  : '';

?>

<!-- .ml-toggle -->
<div class="ml-toggle<?php echo $toggle_first.$one_allowed ?>">

	<?php if($toggles_array) : foreach ($toggles_array as $toggle) :

		$toggle_title   = get_post_meta($toggle->ID, '_ml_cs_toggle_title', true);
		$toggle_content = get_post_meta($toggle->ID, '_ml_cs_toggle_content', true);
		$toggle_content = ml_p($toggle_content);

		?>

		<h3 class="ml-toggle-title">
			<a href="#ml-toggle-id-<?php echo $toggle->ID ?>" rel="nofollow" class="ml-toggle-a">
				<span>+</span>
				<?php echo $toggle_title ?>
			</a>
		</h3>

		<div id="ml-toggle-id-<?php echo $toggle_content ?>">
			<?php echo do_shortcode($toggle_content) ?>
		</div>

	<?php endforeach; endif; ?>

</div>
<!-- /.ml-toggle -->

<div class="clearfix"></div>