<?php

$selected_slider = get_post_meta($post_id, '_ml_cs_slider', true);


/*--- Slider Categories ---*/
$slider_cats = get_terms( 'ml_slider_category');

?>

<div class="ml-cs-message-area"></div>

<div class="clearfix"></div><br />



<?php if($slider_cats) : ?>

	<select name="ml-cs-slider-select-<?php echo $post_id ?>" id="ml-cs-slider-select-<?php echo $post_id ?>">

	<?php foreach ($slider_cats as $object => $cat) :
		
		$selected = ($selected_slider == $cat->term_id) ? 'selected="selected"' : null;
		
		?>

		<option value="<?php echo $cat->term_id ?>" <?php echo $selected ?>><?php echo $cat->name ?></option>

	<?php endforeach; ?>

	</select>


<?php else : ?>

	<a href="<?php echo home_url() ?>/wp-admin/edit-tags.php?taxonomy=ml_slider_category&post_type=ml_slider">

		<?php _e('Please create some slider categories.', 'meydjer') ?>

	</a>


<?php endif; ?>



<div class="clearfix"></div><br /><br />

<a href="#" class="ml-cs-slider-save ml-admin-button ml-primary" id="ml-cs-slider-save-<?php echo $post_id ?>"><?php _e('Done', 'meydjer') ?></a>

<div class="clearfix"></div><br />