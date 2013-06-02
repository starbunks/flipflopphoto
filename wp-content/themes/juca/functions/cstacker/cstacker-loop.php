<?php

$page_with_sidebar  = true;

$args = array(
	'numberposts'		=> -1,
	'orderby'			=> 'menu_order',
	'order'				=> 'ASC',
	'post_parent'		=> get_the_ID(),
	'post_type'			=> 'ml_cstacker',
	);

$contents_array = get_posts($args);



$all_content_size = array();

foreach ($contents_array as $content) {
	$this_size = get_post_meta( $content->ID, '_ml_cs_size', true );
	$all_content_size[] = ml_return_size_width($this_size);
}


$cs_count    = 0;
$queue_count = 0;
$width_sum   = 0;

if(!$contents_array) { ?>

	<!-- .ml-page-wrapper -->
	<div class="ml-page-wrapper ml-main-content">

		<!-- .ml-read-wrapper -->
		<div class="ml-read-wrapper">

			<!-- .ml-entry-title -->
			<div class="ml-entry-title ml-etitle-in">
				<div class="ml-extra-border"></div>
				<h2 class="ml-tshad-3"><?php the_title() ?></h2>
				<div class="ml-extra-border"></div>
			</div>
			<!-- /.ml-entry-title -->

			<br>

			<?php the_content(); ?>

		</div>
		<!-- /.ml-read-wrapper -->

	</div>
	<!-- /.ml-page-wrapper -->

<?php } else {

	foreach ($contents_array as $content) :

		$cs_count++;

		$current_content_type     = str_replace('ml-cs-', '', $content->post_title);
		$current_content_size_ref = get_post_meta( $content->ID, '_ml_cs_size', true );
		$current_content_size     = ml_return_size_width( $current_content_size_ref );
		if ($cs_count < count($all_content_size))
			$next_content_size = ($all_content_size[$cs_count]) ? $all_content_size[$cs_count] : null;
		

		$queue_count++;
		$clear = ( ($queue_count == 1) && ($cs_count > 1) ) ? '<div class="clearfix"></div><div class="ml-cs-space"></div>' : null;
		$first = ($queue_count == 1) ? 'ml-first' : null;

		$width_sum           += $current_content_size;
		$width_sum_plus_next  = (isset($next_content_size)) ? ($width_sum + $next_content_size) : null;


		if( intval($width_sum_plus_next) > 100 ) { $queue_count = 0; $width_sum = 0; }


		/*--- Don't wrap in specific cases ---*/

		$dont_wrapp = array(
			'alert',
			'cta',
			'title',
			'portfolio',
			'welcome'
			);

		$wrapper_top    = '';
		$wrapper_bottom = '';

		if( ($current_content_size >= 100) && (in_array($current_content_type, $dont_wrapp))) {
			$wrapper_top    = '</div></div>';
			$wrapper_bottom = '<div class="ml-wrapper"><div class="ml-grid ml-one_full ml-first">';
		}

		?>

		<?php echo $clear ?>

		<?php echo $wrapper_top ?>

			<!-- .ml-grid -->
			<div class="ml-grid ml-<?php echo ml_return_size_text($current_content_size_ref); ?> <?php echo $first; ?>">

				<?php include 'content/' . $current_content_type . '.php'; ?>

			</div>
			<!-- /.ml-grid -->

		<?php echo $wrapper_bottom ?>

		<?php

	endforeach;

} ?>


<?php if($page_with_sidebar && !$contents_array) : ?>

	<!-- .ml-sidebar-wrapper -->
	<div class="ml-sidebar-wrapper ml-sidebar-content">

		<?php get_sidebar() ?>
		
	</div>
	<!-- /.ml-sidebar-wrapper -->

<?php endif; ?>

