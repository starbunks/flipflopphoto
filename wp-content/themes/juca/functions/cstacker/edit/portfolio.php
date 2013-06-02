<?php

$args = array(
	'numberposts'     => -1,
	'orderby'         => 'title',
	'order'           => 'ASC',
	'post_type'       => 'ml_portfolio'
	);

$port_items = get_posts( $args );


$checked_items      = get_post_meta( $post_id, '_ml_cs_port_items', true );
$checked_items      = explode(',', $checked_items);
$show_filter        = get_post_meta( $post_id, '_ml_cs_port_shw_filter', true );
$show_items         = get_post_meta( $post_id, '_ml_cs_port_shw_items', true );
$display_items_list = ($show_items == 'selected')
	? 'block'
	: 'none';


$block_items = ceil( (count($port_items) / 3) );

?>

<div class="ml-cs-message-area"></div>

<div class="clearfix"></div>



<h4><?php _e('Portfolio Settings', 'meydjer') ?>:</h4>

<label for="ml-cs-port-show-filter"><?php _e('Show Filter', 'meydjer') ?>:</label>
<input type="checkbox" name="ml-cs-port-show-filter" class="ml-cs-port-show-filter" id="ml-cs-port-show-filter-<?php echo $post_id ?>" <?php checked( $show_filter, 'true' ); ?>>

<div class="clearfix"></div>
<label for="ml-cs-port-show-filter"><?php _e('Show Items', 'meydjer') ?>:</label>
<label class="ml-cs-in-label">
	<input type="radio" name="ml-cs-port-show-items" class="ml-cs-port-show-items-<?php echo $post_id ?>" id="ml-cs-port-show-all-<?php echo $post_id ?>" class="ml-input-radio" value="all" <?php checked( $show_items, 'all' ); ?>>
	<?php _e('All', 'meydjer') ?>
</label>
<label class="ml-cs-in-label">
	<input type="radio" name="ml-cs-port-show-items" class="ml-cs-port-show-items-<?php echo $post_id ?>" id="ml-cs-port-show-selected-<?php echo $post_id ?>" class="ml-input-radio" value="selected" <?php checked( $show_items, 'selected' ); ?>>
	<?php _e('Select', 'meydjer') ?>
</label>



<div class="clearifx"></div><br><br>




<!-- .ml-cs-port-items-list -->
<div class="ml-cs-port-items-list" style="display:<?php echo $display_items_list ?>">
	<br>
	<h4><?php _e('Select items', 'meydjer') ?>:</h4>



	<?php if($port_items) : ?>

		<!-- #ml-cs-port-items -->
		<div id="ml-cs-port-items-<?php echo $post_id ?>">

			<!-- .ml-cs-port-block -->
			<div class="ml-cs-port-block">

				<?php

					$count=0;

					foreach ($port_items as $item) :

					$count++;

					$new_block = ( ($count == $block_items) || ($count == ($block_items * 2)) ) ? '</div><div class="ml-cs-port-block">' : '';
					$checked   = ( in_array($item->ID, $checked_items) ) ? 'checked="checked"' : '';


					?>

					<label>
						<input type="checkbox" name="ml-port-item-<?php echo $item->ID ?>" id="ml-port-item-<?php echo $item->ID ?>" class="ml-input-check ml-port-item" value="<?php echo $item->ID ?>" <?php echo $checked ?>><?php echo $item->post_title ?>
					</label>

					<?php echo $new_block ?>

				<?php endforeach; ?>

			</div>
			<!-- /.ml-cs-port-block -->

		</div>
		<!-- /#ml-cs-port-items -->



	<?php else : ?>

		<a href="<?php echo home_url() ?>/wp-admin/post-new.php?post_type=ml_portfolio">

			<?php _e('Please create some portfolio items.', 'meydjer') ?>

		</a>


	<?php endif; ?>
</div>
<!-- /.ml-cs-port-items-list -->


<div class="clearfix"></div><br /><br />

<a href="#" class="ml-cs-portfolio-save ml-admin-button ml-primary" id="ml-cs-portfolio-save-<?php echo $post_id ?>"><?php _e('Done', 'meydjer') ?></a>

<div class="clearfix"></div><br />