<?php if(get_post_type() == 'ml_portfolio') : ?>

	<ul class="ml-sidebar ml-sidebar-portfolio">

		<?php dynamic_sidebar('ml-portfolio');	?>
		
	</ul>

<?php endif; ?>



<?php if(is_page()) : ?>

	<ul class="ml-sidebar ml-sidebar-pages">

		<?php dynamic_sidebar('ml-page'); ?>
		
	</ul>

<?php endif; ?>



<?php if(is_home() || is_single() || is_category() || is_tag() || is_author() || is_date() ) : ?>

	<ul class="ml-sidebar ml-sidebar-blog">

		<?php dynamic_sidebar('ml-blog'); ?>
		
	</ul>

<?php endif; ?>



<ul class="ml-sidebar ml-sidebar-all">

	<?php dynamic_sidebar('ml-all');	?>
	
</ul>