<?php

get_header();

$post = $posts[0]; //Hack for the_date();

/* Author data */
if(get_query_var('author_name')) {
	$curauth = get_user_by('login', get_query_var('author_name'));
} else {
	$curauth = get_userdata(get_query_var('author'));
}


/*--- Category ---*/
if (is_category()) {
	$main_title = sprintf(__('%s', 'meydjer'), single_cat_title('',false));
	$sub_title = sprintf(__('All posts in "%s"', 'meydjer'), single_cat_title('',false));

/*--- Tag ---*/
} else if ( is_tag() ) {
	$main_title = sprintf(__('%s', 'meydjer'), single_tag_title('',false));
	$sub_title = sprintf(__('All posts tagged with "%s"', 'meydjer'), single_tag_title('',false));

/*--- Day ---*/
} else if (is_day()) {
	$main_title = get_the_time('F jS, Y');
	$sub_title = __('Archive for ', 'meydjer') . get_the_time('F jS, Y');

/*--- Month ---*/
} else if (is_month()) {
	$main_title = get_the_time('F, Y');
	$sub_title = __('Archive for ', 'meydjer') . get_the_time('F, Y');

/*--- Year ---*/
} else if (is_year()) {
	$main_title = get_the_time('Y');
	$sub_title = __('Archive for ', 'meydjer') . get_the_time('Y');

/*--- Author ---*/
} else if (is_author()) {
	$main_title = $curauth->display_name;
	$sub_title = __('All posts by ', 'meydjer') . $curauth->display_name;

/*--- Other ---*/
} else if (isset($_GET['paged']) && !empty($_GET['paged'])) {
	$main_title = __('Archives', 'meydjer');
	$sub_title = __('Blog Archives', 'meydjer');

}

?>

	<!-- .ml-cs-title-v -->
	<div class="ml-cs-title-v ml-center-text">

		<!-- .ml-wrapper -->
		<div class="ml-wrapper">
			
			<h1><?php echo $main_title ?></h1>

			<p><?php echo $sub_title ?></p>

		</div>
		<!-- /.ml-wrapper -->
		
	</div>
	<!-- /.ml-cs-title-v -->

	<div class="clearfix"></div><br><br>


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