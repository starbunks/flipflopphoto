<?php

$quote_text   = ml_p( get_post_meta( get_the_ID(), '_ml_post_quote_text', true ) );
$quote_author = get_post_meta( get_the_ID(), '_ml_post_quote_author', true );

?>

<!-- .ml-post-entry -->
<div class="ml-post-entry ml-entry-quote">

	<?php echo ml_get_featured_image(); ?>

	<!-- .ml-read-wrapper -->
	<div class="ml-read-wrapper">
		<br>

		<blockquote class="ml-with-author">
			<?php echo $quote_text ?>
		</blockquote>

		<?php if($quote_author) : ?>
			<p class="ml-quote-author"><?php echo $quote_author ?></p>
		<?php endif ?>

	</div>
	<!-- /.ml-read-wrapper -->


	<div class="clearfix"></div>

	<!-- .ml-read-wrapper -->
	<div class="ml-read-wrapper">
		
		<div class="ml-thin-divd-2"></div>

		<!-- .ml-entry-cats -->
		<div class="ml-entry-info">
			<?php echo get_the_date('F j, Y') ?>. <?php _e('In', 'meydjer') ?> <?php the_category(', ') ?>. <?php _e('By', 'meydjer') ?> <?php the_author_posts_link(); ?>.
		</div>
		<!-- /.ml-entry-cats -->

		<!-- .ml-post-format -->
		<div class="ml-post-format">
			<div class="ml-thin-divd"></div>
			<!-- .ml-post-icon -->
			<div class="ml-post-icon ml-post-i-quote">
				<span>&#x22;</span>
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