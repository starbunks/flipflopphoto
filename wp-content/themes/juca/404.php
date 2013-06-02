<?php

get_header();

?>


	<!-- .ml-wrapper -->
	<div class="ml-wrapper ml-blog-area ml-with-sidebar">
		
		<!-- .ml-blog-wrapper -->
		<div class="ml-blog-wrapper ml-main-content">

				<!-- .ml-post-entry -->
				<div class="ml-post-entry">
					
					<br>

					<h2 class="ml-page-title"><?php _e("Error 404", 'meydjer') ?></h2>

					<p class="ml-404-check"><?php _e('Sorry, no posts matched your criteria.', 'meydjer') ?></p>
					
					<br>

				</div>
				<!-- /.ml-post-entry -->

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