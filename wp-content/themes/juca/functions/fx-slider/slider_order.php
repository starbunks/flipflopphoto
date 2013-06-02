<?php

/*--- jQuery UI Sortable ---*/
wp_enqueue_script('jquery-ui-sortable');


$args = array(
	'numberposts'	=> -1,
	'order'			=> 'ASC',
	'orderby'		=> 'menu_order',
	'post_type'		=> 'ml_slider'
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
			width:182px;
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

	<!-- #ml-slider-order -->
	<ul id="ml-slider-order" class="ml-sortable">
		
		<?php

		foreach ($posts_array as $post) :


			/*--- Content ---*/
			$slide_type = get_post_meta( $post->ID, '_ml_sld_type', true );


			/*--- Image ---*/
			if($slide_type == 'image') {

				$image = ml_uploaded_images($post->ID, '_ml_sld_image');

				if($image) {
					$thumbnail = vt_resize( NULL, $image[0], 178, 100, true );
					$slide_content = '<img src="' . $thumbnail['url'] . '" />';
				} else {
					$slide_content = __('Please upload an image.', 'meydjer');
				}


			/*--- Embedded Content ---*/
			} else if($slide_type == 'embedded') {

				$embedded_content = get_post_meta( $post->ID, '_ml_sld_embedded', true );

				if($embedded_content) {
					$slide_content = 
							'<div class="ml-fit">' .
								$embedded_content .
							'</div>';
				} else {
					$slide_content = __('Please paste your embedded content code.', 'meydjer');
				}

			/*--- HTML Content ---*/
			} else if($slide_type == 'html') {

				$html_content = get_post_meta( $post->ID, '_ml_sld_html', true );

				if($html_content) {
					$slide_content = 
							'<div class="ml-html-content">' .
								$html_content .
							'</div>';
				} else {
					$slide_content = __('Please write your HTML content.', 'meydjer');
				}


			/*--- FX Slide ---*/
			} else if($slide_type == 'fx') {

				$args = array(
					'numberposts'     => -1,
					'orderby'         => 'menu_order',
					'order'           => 'ASC',
					'post_type'       => 'ml_fx_element',
					'post_parent'     => $post->ID
					);

				$elements = get_posts($args);

				if($elements) {

					$imgs = '';
					foreach ($elements as $key => $element) {
						$image     = get_post_meta( $element->ID, '_ml_fx_image', true );
						$thumbnail = vt_resize( null, $image, 51, 51, true );
						$imgs     .= '<img src="' . $thumbnail['url'] . '" class="ml-fx-thumbnail" height="44" width="44">';
						
					}

					$slide_content = 
							'<div class="ml-fx-content ml-html-content">' .
								$imgs .
							'</div>';
				} else {
					$slide_content = __('Please edit your FX Slide.', 'meydjer');
				}


			/*--- Else... ---*/
			} else {
					$slide_content = __('Please insert your content.', 'meydjer');
			}


			/*--- Slider Categories ---*/
			$sld_cat_array = get_the_terms( $post->ID, 'ml_slider_category' );
			$sld_count     = 0;
			$sld_cat       = '';

			if($sld_cat_array) {

				foreach( $sld_cat_array as $cat ) {

					$sld_count++;

					$comma = ($sld_count == 1) ? '' : ', ';

					$sld_cat .= $comma . $cat->name;

				}

			}


		?>

			<li id="ml-sitem_<?php echo $post->ID ?>" class="ml-frame">
				<div class="ml-sort-img"><?php echo $slide_content ?></div>
				<!-- .ml-sort-info -->
				<div class="ml-sort-info">
					<span class="ml-sort-title"><?php echo $post->post_title ?></span>
					<span class="ml-sort-cat"><?php echo $sld_cat ?></span>
				</div>
				<!-- /.ml-sort-info -->
			</li>

		<?php endforeach; ?>

	</ul>
	<!-- /#ml-slider-order -->




	<script type="text/javascript">
		
		/*-------------------------------------------------*/
		/*	Sortable
		/*-------------------------------------------------*/
		jQuery(document).ready(function($) {
		
			$('#ml-slider-order').sortable({

				cursor: "move",
				placeholder: 'ml-ui-state-highlight',
				update: function() {

					var order = jQuery('#ml-slider-order').sortable('toArray');

					var ajax_data = {
						action : 'ml_slider_save_order',
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

	<p><?php _e('You don\'t have any slider item yet. <a href="' . home_url() . '/wp-admin/post-new.php?post_type=ml_slider">Click here to create your first slide!</a>', 'meydjer') ?></p>

<?php endif; ?>