<?php

$checked_items = get_post_meta( $content->ID, '_ml_cs_port_items', true );
$checked_items = explode(',', $checked_items);
$show_filter   = get_post_meta( $content->ID, '_ml_cs_port_shw_filter', true );
$show_items    = get_post_meta( $content->ID, '_ml_cs_port_shw_items', true );

?>



<?php if ($show_filter == 'true'): ?>
	
	<?php	$terms = get_terms( 'ml_portfolio_category'); ?>

	<!-- .ml-filter -->
	<div class="ml-filter">

		<?php
		/*--- Prevent errors ---*/
		if(!$terms) exit('<h1 style="color:red;">' . __('You need create some Portfolio Categories to use the filter.', 'meydjer') . '</h1>');
		?>

		<!-- .ml-wrapper -->
		<div class="ml-wrapper">
			<ul id="ml-filters" class="ml-filters">

				<li>
					<a href="#" data-filter="*" class="ml-selected"><?php _e('All', 'meydjer') ?><span class="ml-flt-arr">&#x76;</span></a>
				</li>


				<?php if ($show_items == 'selected'): ?>


					<?php

					/* Print only the terms of the checked items */

					$active_terms = array();

					foreach ($checked_items as $item) {
						$the_terms = get_the_terms( $item, 'ml_portfolio_category' );
						foreach ($the_terms as $term) {
							$active_terms[] = $term->slug;
						}
					}

					?>
					

					<?php foreach($terms as $term) : ?>

						<?php if (in_array($term->slug, $active_terms)): ?>
							
							<li>
								<a href="#" data-filter=".ml-c-<?php echo $term->slug ?>" class="ml-port-cat-link ml-unselected"><?php echo $term->name ?><span class="ml-flt-arr">&#x76;</span></a>
							</li>

						<?php endif ?>

					<?php endforeach; ?>


				<?php else : ?>


					<?php foreach($terms as $term) : ?>
						<li>
							<a href="#" data-filter=".ml-c-<?php echo $term->slug ?>" class="ml-port-cat-link ml-unselected"><?php echo $term->name ?><span class="ml-flt-arr">&#x76;</span></a>
						</li>

					<?php endforeach; ?>


				<?php endif ?>


			</ul>
		</div>
		<!-- /.ml-wrapper -->
	</div>
	<!-- /.ml-filter -->


<?php endif ?>




	<div class="clearfix"></div>



	<?php

	if($show_items == 'selected') {
		$args = array(
			'numberposts' => -1,
			'offset'      => 0,
			'orderby'     => 'menu_order',
			'order'       => 'ASC',
			'post__in'    => $checked_items,
			'post_type'   => 'ml_portfolio'
			);

	} else {
		$args = array(
			'numberposts' => -1,
			'offset'      => 0,
			'orderby'     => 'menu_order',
			'order'       => 'ASC',
			'post_type'   => 'ml_portfolio'
			);

	}


	$portfolio_items = get_posts( $args ); 

	?>

	<!-- #ml-port-items -->
	<div id="ml-port-items">

		<?php
		/*--- Prevent errors ---*/
		if(!$portfolio_items) exit('<h1 style="color:red;">' . __('You need create some Portfolio Items.', 'meydjer') . '</h1>');
		?>
		
		<!-- .ml-wrapper -->
		<div class="ml-wrapper">
			
			<!-- #ml-port-block -->
			<div id="ml-port-block" class="ml-port-block ml-4cols" data-cols="4">

				<?php

				foreach ($portfolio_items as $item):

					/*--- Terms ---*/
					$terms = get_the_terms( $item->ID, 'ml_portfolio_category' );
					$slugs = '';

					if($terms) {
						foreach ($terms as $term) {
							$slugs .= ' ml-c-' . $term->slug;
						}
					}

					/*--- Thumbnail ---*/
					if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail($item->ID)) ) {
						$attach_id           = get_post_thumbnail_id($item->ID);
						$featured_image      = vt_resize($attach_id, '', 260, 260, true);
						$featured_image_meta = get_post($featured_image_id);

						$the_thumbnail = '<img src="' . $featured_image['url'] . '" alt="' . $featured_image_meta->post_title . '" class="ml-pthumb-img">';

					} else {
						$the_thumbnail = '<div style="padding:1em;text-align:center">' .
							__('Please, set a Featured Image.', 'meydjer') .
							'</div>';
					}

				?>

					<div class="ml-pthumb<?php echo $slugs ?>">
						<a href="<?php the_permalink() ?>#!/<?php echo $item->post_name ?>/" class="ml-pfull-link">
							<?php echo $the_thumbnail ?>
							<div class="ml-glare"></div>
							<span class="ml-pthumb-title"><?php echo $item->post_title ?></span>
						</a>
					</div>
					
				<?php endforeach ?>

				
			</div>
			<!-- /#ml-port-block -->

		</div>
		<!-- /.ml-wrapper -->

	</div>
	<!-- /#ml-port-items -->