<?php

get_header();

?>


	<!-- .ml-wrapper -->
	<div class="ml-wrapper ml-blog-area ml-with-sidebar">
		
		<!-- .ml-blog-wrapper -->
		<div class="ml-blog-wrapper ml-main-content">

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<?php

			$formats_path = dirname( __FILE__ ) . '/functions/blog/index';

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

			
			<?php endwhile; ?>


				<!-- .ml-loop-nav -->
				<div class="ml-loop-nav">
					
					<div class="ml-nav-prev"><?php next_posts_link(__('&larr; Older Entries', 'meydjer')) ?></div>
							
					<div class="ml-nav-next"><?php previous_posts_link(__('Newer Entries &rarr;', 'meydjer')) ?></div>

				</div>
				<!-- /.ml-loop-nav -->


			<?php else: ?>

				<!-- .ml-post-entry -->
				<div class="ml-post-entry">
					
					<br>

					<h2 class="ml-page-title"><?php _e("Error 404", 'meydjer') ?></h2>

					<p class="ml-404-check"><?php _e('Sorry, no posts matched your criteria.', 'meydjer') ?></p>
					
					<br>

				</div>
				<!-- /.ml-post-entry -->

			<?php endif; wp_reset_query(); ?>

		</div>
		<!-- /.ml-blog-wrapper -->


		<!-- .ml-sidebar-wrapper -->
		<div class="ml-sidebar-wrapper ml-sidebar-content">
			
			<?php get_sidebar() ?>
			
		</div>
		<!-- /.ml-sidebar-wrapper -->

			

	</div>
	<!-- /.ml-wrapper -->



<?php get_footer(); ?>