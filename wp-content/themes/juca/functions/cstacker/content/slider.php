<?php

$slider_cat = get_post_meta( $content->ID, '_ml_cs_slider', true );

$args = array(
	'numberposts' => -1,
	'orderby'     => 'menu_order',
	'order'       => 'ASC',
	'post_type'   => 'ml_slider',
	'tax_query'   => array(
		array(
			'taxonomy' => 'ml_slider_category',
			'field'    => 'id',
			'terms'    => $slider_cat
		)
	)
	);

$slides_array = get_posts($args); ?>



<!-- .ml-cs-slider -->
<div class="ml-cs-slider">

	<!-- .ml-fit -->
	<div class="ml-fit">

		<!-- .ml-fx-slider -->
		<div class="ml-fx-slider ml-slider">

			<ul class="slides">

				<?php

				$count=0;

				foreach ($slides_array as $slide) :

					$count++;

					$slide_type = get_post_meta( $slide->ID, '_ml_sld_type', true );

					if($slide_type == 'image') {

						$image         = ml_uploaded_images($slide->ID, '_ml_sld_image');
						$link          = get_post_meta( $slide->ID, '_ml_sld_link', true );
						$caption_title = get_post_meta( $slide->ID, '_ml_sld_caption_title', true );
						$caption_text  = get_post_meta( $slide->ID, '_ml_sld_caption_text', true );

						if($link) {
							$open_link  = '<a href="' . $link . '">';
							$close_link = '</a>';
						} else {
							$open_link  = '';
							$close_link = '';
						}

						$caption_div = '';

						if($caption_title || $caption_text) {

							$caption_div .= '<div class="ml-caption">';

							if($caption_title)
								$caption_div .= '<span class="ml-caption-title">' . $caption_title . '</span>';

							if($caption_title && $caption_text)
								$caption_div .= '<div class="ml-caption-divider"></div>';

							if($caption_text)							
								$caption_div .= $caption_text;

							$caption_div .= '</div>';
							
						}


						?>

						<li class="ml-slide-<?php echo $count ?>">

							<?php echo $open_link ?>

							<img src="<?php echo $image[0] ?>" />

							<?php echo $caption_div ?>

							<?php echo $close_link ?>

						</li>

						<?php



					} else if($slide_type == 'embedded') {

						$slide_content = get_post_meta( $slide->ID, '_ml_sld_embedded', true );

						?>
						
						<li class="ml-slide-<?php echo $count ?>">
							
							<?php echo $slide_content ?>

						</li>

						<?php



					} else if($slide_type == 'html') {

						$slide_content = get_post_meta( $slide->ID, '_ml_sld_html', true );

						?>

						<li class="ml-slide-<?php echo $count ?>">

							<?php echo $slide_content ?>
							
						</li>

						<?php



					} else if($slide_type == 'fx') {

						$slider_height = get_post_meta( $slide->ID, '_ml_fx_height', true );

						?>

						<li class="ml-slide-<?php echo $count ?> ml-fx-slide" data-height="<?php echo $slider_height ?>" data-wait="600" style="height:<?php echo $slider_height ?>px">

							<?php

							$args = array(
								'numberposts'     => -1,
								'orderby'         => 'menu_order',
								'order'           => 'DESC',
								'post_type'       => 'ml_fx_element',
								'post_parent'     => $slide->ID
								); 

							$elements = get_posts($args);

							foreach ($elements as $key => $element) :

								$image     = get_post_meta( $element->ID, '_ml_fx_image', true );
								$animation = get_post_meta( $element->ID, '_ml_fx_animation', true );
								$link      = get_post_meta( $element->ID, '_ml_fx_link', true );
								$easing    = get_post_meta( $element->ID, '_ml_fx_easing', true );
								$delay     = get_post_meta( $element->ID, '_ml_fx_delay', true );
								$duration  = get_post_meta( $element->ID, '_ml_fx_duration', true );
								$class     = get_post_meta( $element->ID, '_ml_fx_class', true );
								$to_x      = get_post_meta( $element->ID, '_ml_fx_to_x', true );
								$to_y      = get_post_meta( $element->ID, '_ml_fx_to_y', true );

								$the_easing = ($easing != 'none') ? $easing : null;
								$the_class  = str_replace('.', '', $class);
								$the_class  = str_replace(',', ' ', $class);
								$the_to_x   = ml_rot(1200, 100, $to_x) . '%';
								$the_to_y   = ml_rot($slider_height, 100, $to_y) . '%';

								$image_size       = getimagesize($image);
								$image_width      = $image_size[0];
								$image_height     = $image_size[1];
								$the_image_width  = ml_rot(1200, 100, $image_width) . '%';
								$the_image_height = ml_rot($slider_height, 100, $image_height) . '%';


								if($animation == 'topleft') {
									$from_x = '-' . $the_image_width;
									$from_y = '-' . $the_image_height;
								} else if($animation == 'top') {
									$from_x = $the_to_x;
									$from_y = '-' . $the_image_height;
								} else if($animation == 'topright') {
									$from_x = '100%';
									$from_y = '-' . $the_image_height;
								} else if($animation == 'left') {
									$from_x = '-' . $the_image_width;
									$from_y = $the_to_y;
								} else if($animation == 'right') {
									$from_x = '100%';
									$from_y = $the_to_y;
								} else if($animation == 'bottomleft') {
									$from_x = '-' . $the_image_width;
									$from_y = '100%';
								} else if($animation == 'bottom') {
									$from_x = $the_to_x;
									$from_y = '100%';
								} else if($animation == 'bottomright') {
									$from_x = '100%';
									$from_y = '100%';
								} else {
									$from_x = $the_to_x;
									$from_y = $the_to_y;
								}


								?>

								<?php if ($link && (trim($link) != '' ) ): ?>

									<a href="<?php echo $link ?>">
									
								<?php endif ?>

										<img id="ml-fx-<?php echo $element->ID ?>" class="ml-fx-element <?php echo $the_class ?>" src="<?php echo $image ?>" data-delay="<?php echo $delay ?>" data-duration="<?php echo $duration ?>" data-easing="<?php echo $the_easing ?>" data-from_x="<?php echo $from_x ?>" data-to_x="<?php echo $the_to_x ?>" data-from_y="<?php echo $from_y ?>"  data-to_y="<?php echo $the_to_y ?>" width="<?php echo $the_image_width ?>" style="left:<?php echo $from_x ?>;top:<?php echo $from_y ?>" />

								<?php if ($link && (trim($link) != '' ) ): ?>

									</a>
									
								<?php endif ?>

							<?php endforeach; ?>

						</li>


						<?php

					}



					?>

				<?php endforeach; ?>

			</ul>

		</div>
		<!-- /.ml-fx-slider -->

	</div>
	<!-- /.ml-fit -->

</div>
<!-- /.ml-cs-slider -->