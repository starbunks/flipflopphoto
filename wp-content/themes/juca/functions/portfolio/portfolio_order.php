<?php


/*--- jQuery UI Sortable ---*/
wp_enqueue_script('jquery-ui-sortable');


$args = array(
	'numberposts'	=> -1,
	'order'			=> 'ASC',
	'orderby'		=> 'menu_order',
	'post_type'		=> 'ml_portfolio'
	);
$posts_array = get_posts( $args );



?>

<?php if($posts_array) : ?>

	<style type="text/css">
		
		.ml-sortable li {
			cursor: move;
			float:left;
			height:260px;
			margin: 10px;
			width:104px;
		}

		.ml-sort-info {
			height:160px;
			position: relative;
			overflow: hidden;
			width:100%;
		}

		.ml-sort-title {
			font-size:16px;
			float:left;
			line-height:1.5em;
			margin: 5px 3px;
		}

		.ml-ui-state-highlight {
			background:#f5f5f5;
			border: 4px dashed #ccc;
			border-radius: 4px;
				-webkit-border-radius: 4px;
				-khtml-border-radius: 4px;
				-moz-border-radius: 4px;
				-ms-border-radius: 4px;
				-o-border-radius: 4px;
			padding: 3px;
		}

		.ml-sort-cat {
			bottom:0px;
			color: #777;
			float:left;
			left:0px;
			margin: 0 3px 5px;
			position: absolute;
		}

	</style>




	<div id="ml-sort-update"></div> 

	<!-- #ml-portfolio-order -->
	<ul id="ml-portfolio-order" class="ml-sortable">
		
		<?php

		foreach ($posts_array as $post) :


			/*--- Thumbnail ---*/
			if(get_post_thumbnail_id($post->ID)) {

			    $attach_id = get_post_thumbnail_id($post->ID);
			    $resized = vt_resize( $attach_id, '', 100, 100, true );      
			    $image = '<img src="'. $resized['url'] .'" />';

			} else {

	         $image = '<strong>' . __('Please set a featured image', 'meydjer') . '</strong>';

			}


			/*--- Portfolio Categories ---*/
			$port_cat_array = get_the_terms( $post->ID, 'ml_portfolio_category' );
			$port_count = 0;
			$port_cat = '';

			if($port_cat_array) {

				foreach( $port_cat_array as $cat ) {

					$port_count++;

					$comma = ($port_count == 1) ? '' : ', ';

					$port_cat .= $comma . $cat->name;

				}

			}


		?>

			<li id="ml-pitem_<?php echo $post->ID ?>" class="ml-frame">
				<div class="ml-sort-img"><?php echo $image ?></div>
				<!-- .ml-sort-info -->
				<div class="ml-sort-info">
					<span class="ml-sort-title"><?php echo $post->post_title ?></span>
					<span class="ml-sort-cat"><?php echo $port_cat ?></span>
				</div>
				<!-- /.ml-sort-info -->
			</li>

		<?php endforeach; ?>

	</ul>
	<!-- /#ml-portfolio-order -->




	<script type="text/javascript">
		
		/*-------------------------------------------------*/
		/*	Sortable
		/*-------------------------------------------------*/
		jQuery(document).ready(function($) {
		
			$('#ml-portfolio-order').sortable({

				cursor: "move",
				placeholder: 'ml-ui-state-highlight',
				update: function() {

					var order = jQuery('#ml-portfolio-order').sortable('toArray');

					var ajax_data = {
						action : 'ml_portfolio_save_order',
						order  : order
					};

					$.post(ajaxurl, ajax_data, function(response) {
						
						if(response == 'error') { alert('Error: cannot save order.'); }

					});

				}

			});
		
		});

	</script>

<?php else : ?>

	<p><?php _e('You don\'t have any portfolio item yet. <a href="' . home_url() . '/wp-admin/post-new.php?post_type=ml_portfolio">Click here to create your first portfolio item!</a>', 'meydjer') ?></p>

<?php endif; ?>