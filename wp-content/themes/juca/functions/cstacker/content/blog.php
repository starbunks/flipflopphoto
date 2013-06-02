<?php

$show    = (get_post_meta( $content->ID, '_ml_cs_blog_show', true )) ? get_post_meta( $content->ID, '_ml_cs_blog_show', true ) : 1;

if($show == 1) {
	$grid = 'ml-one_full';
} else if($show == 2) {
	$grid = 'ml-one_half';
} else if($show == 3) {
	$grid = 'ml-one_third';
} else {
	$grid = 'ml-one_fourth';
}

?>


<!-- .ml-l-posts-area -->
	<div class="ml-l-posts-area">

		<?php

		/*--- Loop ---*/
		$post_query = new WP_Query( array( 'showposts' => $show ) );
		$post_count = -1;

		if ( $post_query->have_posts() ) : while ( $post_query->have_posts() ) : $post_query->the_post();

			$post_count++;

			if($show == 1) {
				$first = ' ml-first';
				$clear = '<div class="clearfix"></div>';

			} else if($show == 2) {
				$first = ($post_count % 2 != 0) ? '' : ' ml-first';
				$clear = ($post_count % 2 != 0) ? '' : '<div class="clearfix"></div>';

			} else if($show == 3) {
				$first = ($post_count % 3 != 0) ? '' : ' ml-first';
				$clear = ($post_count % 3 != 0) ? '' : '<div class="clearfix"></div>';

			} else {
				$first = ($post_count % 4 != 0) ? '' : ' ml-first';
				$clear = ($post_count % 4 != 0) ? '' : '<div class="clearfix"></div>';
			}

			?>

		<?php echo $clear ?>

		<!-- .ml-lsts-in -->
		<div class="ml-lsts-in ml-grid <?php echo $grid . $first?>">


		<?php
			
			$formats_path = dirname( __FILE__ ) . '../../../blog/index';

			if ( has_post_format( 'aside' ) ) {
				include $formats_path . '/aside.php';

			} else if ( has_post_format( 'audio' ) ) {
				include $formats_path . '/audio.php';

			} else if ( has_post_format( 'chat' ) ) {
				include $formats_path . '/chat.php';

			} else if ( has_post_format( 'gallery' ) ) {
				include $formats_path . '/gallery.php';

			} else if ( has_post_format( 'image' ) ) {
				include $formats_path . '/image.php';

			} else if ( has_post_format( 'link' ) ) {
				include $formats_path . '/link.php';

			} else if ( has_post_format( 'quote' ) ) {
				include $formats_path . '/quote.php';

			} else if ( has_post_format( 'status' ) ) {
				include $formats_path . '/status.php';

			} else if ( has_post_format( 'video' ) ) {
				include $formats_path . '/video.php';

			} else {
				include $formats_path . '/standard.php';

			}

		?>

		</div>
		<!-- /.ml-lsts-in -->


	<?php endwhile; ?>


	</div>
	<!-- /.ml-l-posts-area -->



	<?php else: ?>



		<div class="clearfix"></div>

			<br>

			<p class="ml-center-text"><?php _e('No posts.', 'meydjer') ?></p>

		<div class="ml-divider ml-margin-bottom"></div>



	<?php endif; ?>

	<?php wp_reset_query(); ?>