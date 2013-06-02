<?php

get_header();

?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<!-- .ml-wrapper -->
	<div class="ml-wrapper ml-blog-area ml-with-sidebar">
		
		<!-- .ml-blog-wrapper -->
		<div class="ml-blog-wrapper ml-main-content">

			<?php

			$formats_path = dirname( __FILE__ ) . '/functions/blog/single';

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
		<!-- /.ml-blog-wrapper -->


		<!-- .ml-sidebar-wrapper -->
		<div class="ml-sidebar-wrapper ml-sidebar-content">
			
			<?php get_sidebar() ?>
			
		</div>
		<!-- /.ml-sidebar-wrapper -->

			

	</div>
	<!-- /.ml-wrapper -->

<?php endwhile; else: ?>

	<!-- .ml-post-entry -->
	<div class="ml-post-entry">
		
		<br>

		<h2 class="ml-page-title"><?php _e("Error 404", 'meydjer') ?></h2>

		<p class="ml-404-check"><?php _e('Sorry, no posts matched your criteria.', 'meydjer') ?></p>
		
		<br>

	</div>
	<!-- /.ml-post-entry -->

<?php endif; wp_reset_query(); ?>

<?php get_footer(); ?>