<?php

$gallery = ml_uploaded_images(get_the_ID(), '_ml_post_gallery');

?>

<!-- .ml-post-entry -->
<div class="ml-post-entry ml-entry-gallery">

	<?php echo ml_get_featured_image( '<br><br>' ); ?>

	<?php if($gallery) : ?>

		<!-- .ml-slider -->
		<div class="ml-slider ml-gallery">

			<ul class="slides">
				
				<?php foreach ($gallery as $image): ?>

					<li>

						<img src="<?php echo $image ?>">
						
					</li>
					
				<?php endforeach ?>

			</ul>
			
		</div>
		<!-- /.ml-slider -->

	<?php endif ?>


	<div class="clearfix"></div>

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
			<div class="ml-post-icon ml-post-i-gallery">
				<span>&#x26;</span>
			</div>
			<!-- /.ml-post-icon -->
		</div>
		<!-- /.ml-post-format -->

		<!-- .ml-post-text -->
		<div class="ml-entry-text">

			<?php the_content() ?>

			<?php if (has_tag()): ?>

				<br>

				<p class="ml-tags">
					<strong><?php _e('Tags', 'meydjer') ?></strong>:	<?php the_tags( '', ', ', '' ); ?>
				</p>
				
			<?php endif ?>


			<?php if(comments_open()) : ?>

				<br>

				<?php comments_template('', true); ?>

			<?php endif; ?>


			<br>
			<br>

		</div>
		<!-- /.ml-post-text -->

	</div>
	<!-- /.ml-read-wrapper -->

</div>
<!-- /.ml-post-entry -->