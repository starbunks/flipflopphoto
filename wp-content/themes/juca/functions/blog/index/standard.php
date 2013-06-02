<!-- .ml-post-entry -->
<div class="ml-post-entry ml-entry-standard">


	<?php echo ml_get_featured_image(); ?>


	<!-- .ml-entry-title -->
	<div class="ml-entry-title">
		<div class="ml-extra-border"></div>
		<a href="<?php the_permalink() ?>"><h2 class="ml-tshad-3"><?php the_title() ?></h2></a>
		<div class="ml-extra-border"></div>
	</div>
	<!-- /.ml-entry-title -->


	<!-- .ml-read-wrapper -->
	<div class="ml-read-wrapper">
		
		<!-- .ml-entry-cats -->
		<div class="ml-entry-info">
			<?php echo get_the_date('F j, Y') ?>. <?php _e('In', 'meydjer') ?> <?php the_category(', ') ?>. <?php _e('By', 'meydjer') ?> <?php the_author_posts_link(); ?>.
		</div>
		<!-- /.ml-entry-cats -->

		<!-- .ml-post-format -->
		<div class="ml-post-format">
			<div class="ml-thin-divd"></div>
			<!-- .ml-post-icon -->
			<div class="ml-post-icon ml-post-i-standard">
				<span>&#x24;</span>
			</div>
			<!-- /.ml-post-icon -->
		</div>
		<!-- /.ml-post-format -->

		<!-- .ml-post-text -->
		<div class="ml-entry-text">
			
			<?php the_excerpt() ?>

		</div>
		<!-- /.ml-post-text -->

		<!-- .ml-read-more -->
		<div class="ml-read-more">

			<a href="<?php the_permalink() ?>" class="ml-readm-link"><span><?php _e('Read More +', 'meydjer') ?></span></a>

			<div class="ml-divider-2"></div>
			
		</div>
		<!-- /.ml-read-more -->

	</div>
	<!-- /.ml-read-wrapper -->

</div>
<!-- /.ml-post-entry -->