<?php

add_action('admin_footer', 'ml_fx_slide_modal');

function ml_fx_slide_modal() {

	/*--- Enqueue jQuery UI Draggable ---*/
	wp_enqueue_script('jquery-ui-draggable');



	$args = array(
		'numberposts'     => -1,
		'orderby'         => 'menu_order',
		'order'           => 'ASC',
		'post_type'       => 'ml_fx_element',
		'post_parent'     => get_the_ID()
		);

	$elements = get_posts($args);



	/*--- Slider Height ---*/

	if(get_post_meta( get_the_ID(), '_ml_fx_height', true )) {
		$slider_height = get_post_meta( get_the_ID(), '_ml_fx_height', true );

	} else {
		add_post_meta(get_the_ID(), '_ml_fx_height', 500, true);
		$slider_height = 500;

	}



	/*--- Animation Directions ---*/
	$animation_dirs = array(
		'topleft',
		'top',
		'topright',
		'left',
		'none',
		'right',
		'bottomleft',
		'bottom',
		'bottomright'
		);


	/*--- Easings ---*/
	$easings = array(
		'none'           => __('None', 'meydjer'),
		'easeOutBack'    => __('Back', 'meydjer'),
		'easeOutBounce'  => __('Bounce', 'meydjer'),
		'easeOutCirc'    => __('Circ', 'meydjer'),
		'easeOutCubic'   => __('Cubic', 'meydjer'),
		'easeOutExpo'    => __('Expo', 'meydjer'),
		'easeOutElastic' => __('Elastic', 'meydjer'),
		'easeOutQuad'    => __('Quad', 'meydjer'),
		'easeOutQuart'   => __('Quart', 'meydjer'),
		'easeOutQuint'   => __('Quint', 'meydjer'),
		'easeOutSine'    => __('Sine', 'meydjer')
		);


?>



	<!-- #ml-fx-modal -->
	<div id="ml-fx-modal" class="ml-fx-modal">
		


		<!-- .ml-fx-slider-prev -->
		<div class="ml-fx-slider-prev" style="height:<?php echo $slider_height ?>px">


			<?php foreach ($elements as $key => $element) :


				$image     = get_post_meta( $element->ID, '_ml_fx_image', true );
				$animation = get_post_meta( $element->ID, '_ml_fx_animation', true );
				$easing    = get_post_meta( $element->ID, '_ml_fx_easing', true );
					if($easing == 'none') $easing = null;
				$delay     = get_post_meta( $element->ID, '_ml_fx_delay', true );
				$duration  = get_post_meta( $element->ID, '_ml_fx_duration', true );
				$class     = get_post_meta( $element->ID, '_ml_fx_class', true );
					$class  = str_replace('.', '', $class);
					$class  = str_replace(',', ' ', $class);
				$to_x      = get_post_meta( $element->ID, '_ml_fx_to_x', true ) . 'px';
				$to_y      = get_post_meta( $element->ID, '_ml_fx_to_y', true ) . 'px';


				$image_size = getimagesize($image);

				if($animation == 'topleft') {
					$from_x = '-' . $image_size[0] . 'px';
					$from_y = '-' . $image_size[1] . 'px';
				} else if($animation == 'top') {
					$from_x = $to_x;
					$from_y = '-' . $image_size[1] . 'px';
				} else if($animation == 'topright') {
					$from_x = '1160px';
					$from_y = '-' . $image_size[1] . 'px';
				} else if($animation == 'left') {
					$from_x = '-' . $image_size[0] . 'px';
					$from_y = $to_y;
				} else if($animation == 'right') {
					$from_x = '1160px';
					$from_y = $to_y;
				} else if($animation == 'bottomleft') {
					$from_x = '-' . $image_size[0] . 'px';
					$from_y = $slider_height . 'px';
				} else if($animation == 'bottom') {
					$from_x = $to_x;
					$from_y = $slider_height . 'px';
				} else if($animation == 'bottomright') {
					$from_x = '1160px';
					$from_y = $slider_height . 'px';
				} else {
					$from_x = $to_x;
					$from_y = $to_y;
				}

			?>

				<img id="ml-fx-<?php echo $element->ID ?>" class="ml-fx-element <?php echo $class ?>" src="<?php echo $image ?>" data-id="<?php echo $element->ID ?>" data-animation="<?php echo $animation ?>" data-easing="<?php echo $easing ?>" data-delay="<?php echo $delay ?>" data-duration="<?php echo $duration ?>" data-from_x="<?php echo $from_x ?>" data-to_x="<?php echo $to_x ?>" data-from_y="<?php echo $from_y ?>"  data-to_y="<?php echo $to_y ?>" style="left:<?php echo $to_x ?>;top:<?php echo $to_y ?>;z-index:<?php echo 1000 - $element->menu_order ?>" width="<?php echo $image_size[0] ?>" height="<?php echo $image_size[1] ?>" />

			<?php endforeach; ?>

			
		</div>
		<!-- /.ml-fx-slider-prev -->


		<!-- .ml-fx-current-height -->
		<div class="ml-fx-current-height">
			
			<?php _e('Height', 'meydjer') ?>: <input type="text" name="ml-fx-height" id="ml-fx-height" class="ml-fx-height" value="<?php echo $slider_height ?>"> px &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

		</div>
		<!-- /.ml-fx-current-height -->


		<!-- .ml-fx-controls -->
		<div class="ml-fx-controls">

			<a href="#" id="ml-fx-add-element" class="ml-admin-button ml-primary upload_button" data-rel="<?php echo ml_silent_post() ?>">+&nbsp; <?php _e('Add Element', 'meydjer') ?>&nbsp;</a>
			<a href="#" id="ml-fx-preview" class="ml-admin-button ml-secondary"><?php _e('Preview', 'meydjer') ?></a>
			<a href="#" id="ml-fx-done" class="ml-admin-button ml-primary ml-right"><?php _e('Done', 'meydjer') ?>!</a>
			
		</div>
		<!-- /.ml-fx-controls -->

		<div class="clearfix"></div>

		<div id="ml-fx-items-box" class="ml-fx-items-box">
			<div class="ml-fx-options ml-cs-options">
				<span class="ml-fx-icon ml-fx-icon-visible"></span>
				<span class="ml-fx-icon ml-fx-icon-move"></span>
				<span class="ml-fx-icon ml-fx-icon-image"></span>
				<span class="ml-fx-icon ml-fx-icon-delete"></span>
				<div class="ml-fx-label ml-fx-link"><?php _e('Link', 'meydjer') ?></div>
				<div class="ml-fx-label ml-fx-animation"><?php _e('Animation', 'meydjer') ?></div>
				<div class="ml-fx-label ml-fx-easing"><?php _e('Easing', 'meydjer') ?></div>
				<div class="ml-fx-label ml-fx-delay"><?php _e('Delay', 'meydjer') ?></div>
				<div class="ml-fx-label ml-fx-duration"><?php _e('Duration', 'meydjer') ?></div>
				<span class="ml-fx-label ml-fx-class"><?php _e('Class', 'meydjer') ?></span>
			</div>
			<div class="ml-cs-area">
				<div class="ml-cs-area-in">

					<div id="ml-sort-update"></div>

					<ul class="ml-fx-items">


						<?php foreach ($elements as $key => $element) :

							$image     = get_post_meta( $element->ID, '_ml_fx_image', true );
							$link      = get_post_meta( $element->ID, '_ml_fx_link', true );
							$animation = get_post_meta( $element->ID, '_ml_fx_animation', true );
							$easing    = get_post_meta( $element->ID, '_ml_fx_easing', true );
							$delay     = get_post_meta( $element->ID, '_ml_fx_delay', true );
							$duration  = get_post_meta( $element->ID, '_ml_fx_duration', true );
							$class     = get_post_meta( $element->ID, '_ml_fx_class', true );


							$thumbnail = vt_resize( null, $image, 51, 51, true );


							$image_size = getimagesize($image);


							?>

							<li id="ml-fx-item-<?php echo $element->ID ?>" class="ml-fx-item-li" data-id="<?php echo $element->ID ?>">

								<div class="ml-fx-area-div ml-fx-area-visible">
									<a href="#" class="ml-fx-item-action ml-fx-item-visibility"></a>
								</div>

								<div class="ml-fx-area-div ml-fx-area-move">
									<div class="ml-fx-item-action ml-fx-item-move"></div>
								</div>

								<div class="ml-fx-area-div ml-fx-area-image">
									<img src="<?php echo $thumbnail['url'] ?>" class="ml-fx-thumbnail" height="51" width="51">
								</div>
								
								<div class="ml-fx-area-div ml-fx-area-link">
									<input type="text" name="ml-fx-input-link" id="ml-fx-input-link" class="ml-admin-input-text ml-admin-input-link" value="<?php echo $link ?>" data-meta="link">
								</div>

								<div class="ml-fx-area-div ml-fx-area-animation">
									<div class="ml-fx-animation-box">

										<?php

										$count_dir=0;

										foreach($animation_dirs as $dir) :

											$count_dir++;

											$active = ($dir == $animation) ? 'ml-active' : ''; ?>

											<a href="#" class="ml-animation-check ml-animation-<?php echo $dir ?> <?php echo $active ?>" data-dir="<?php echo $dir ?>"></a>

											<?php if(($count_dir % 3) == 0) echo '<br />' ?>

										<?php endforeach; ?>

									</div>
								</div>
								
								<div class="ml-fx-area-div ml-fx-area-easing">
									<select name="ml-fx-select-easing" id="ml-fx-select-easing-<?php echo $element->ID ?>" class="ml-fx-select-easing" data-meta="easing">

										<?php foreach ($easings as $key => $value) :

											$selected = ($key == $easing) ? 'selected="selected"' : '';

											?>

											<option value="<?php echo $key ?>" <?php echo $selected ?>><?php echo $value ?></option>

										<?php endforeach; ?>

									</select>
								</div>

								<div class="ml-fx-area-div ml-fx-area-delay">
									<input type="text" name="ml-fx-input-delay" id="ml-fx-input-delay" class="ml-admin-input-text ml-admin-input-delay" value="<?php echo $delay ?>" data-meta="delay">
								</div>

								<div class="ml-fx-area-div ml-fx-area-duration">
									<input type="text" name="ml-fx-input-duration" id="ml-fx-input-duration" class="ml-admin-input-text ml-admin-input-duration" value="<?php echo $duration ?>" data-meta="duration">
								</div>

								<div class="ml-fx-area-div ml-fx-area-class">
									<input type="text" name="ml-fx-input-class" id="ml-fx-input-class" class="ml-admin-input-text ml-admin-input-class" value="<?php echo $class ?>" data-meta="class">
								</div>

								<div class="ml-fx-area-div ml-fx-area-delete">
									<a href="#" class="ml-fx-item-action ml-fx-item-delete"></a>
								</div>

							</li>

						<?php endforeach; ?>
						

					</ul>
				</div>
			</div>
		</div>



	</div>
	<!-- /#ml-fx-modal -->



	<div id="ml-fx-modal-mask" class="ml-fx-modal-mask TB_overlayBG"></div>


<?php }