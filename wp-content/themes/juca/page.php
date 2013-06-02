<?php

get_header();

$page_with_comments = false;

?>

<!-- .ml-main -->
<div id="page-<?php the_ID(); ?>" <?php post_class('ml-main'); ?>>

	<!-- .ml-wrapper -->
	<div class="ml-wrapper">

		<?php	if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<!-- .ml-page-content -->
			<div class="ml-page-content <?php // echo ml_layout_has_sidebar($content_layout) ?> <?php //echo ml_layout_content_align($content_layout) ?>">
				
				<?php get_template_part('functions/cstacker/cstacker-loop') ?>

			</div>
			<!-- /.ml-page-content -->

			<div class="clearfix"></div>



		<?php endwhile; ?>



			<?php if(comments_open() && $page_with_comments) : ?>

				<div class="ml-divider"></div>
				<?php comments_template('', true); ?>

			<?php endif; ?>
			


			<div class="clearfix"></div>



		<?php else: ?>



			<div class="clearfix"></div>

			<!-- .ml-404-area -->
			<div class="ml-404-area">

				<h2 class="ml-page-title"><?php _e("Error 404", 'meydjer') ?></h2>

				<p class="ml-404-check"><?php _e('Sorry, no posts matched your criteria.', 'meydjer') ?></p>
				
			</div>
			<!-- /.ml-404-area -->

			<div class="ml-divider ml-margin-bottom"></div>



		<?php endif; ?>

		<?php wp_reset_query(); ?>

	</div>
	<!-- /.ml-wrapper -->

</div>
<!-- /.ml-main -->

<?php get_footer(); ?>