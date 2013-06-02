<?php

$title_sizes = array(
	'h1' => __('H1', 'meydjer'),
	'h2' => __('H2', 'meydjer'),
	'h3' => __('H3', 'meydjer'),
	'h4' => __('H4', 'meydjer'),
	'h5' => __('H5', 'meydjer'),
	'h6' => __('H6', 'meydjer')
	);

$title_alignments = array(
	'left'   => __('Left',   'meydjer'),
	'center' => __('Center', 'meydjer'),
	'right'  => __('Right',  'meydjer'),
	);

$pre_text           = (get_post_meta($post_id, '_ml_cs_title_text',      true));
$pre_class          = (get_post_meta($post_id, '_ml_cs_title_class',     true));
$pre_size           = (get_post_meta($post_id, '_ml_cs_title_size',      true));
$pre_text_alignment = (get_post_meta($post_id, '_ml_cs_title_alignment', true));

$title_input_text      = ($pre_text)                  ? $pre_text           : '';
$title_input_class     = ($pre_class)                 ? $pre_class          : '.';
$title_input_alignment = ($pre_text_alignment)        ? $pre_text_alignment : 'left';

?>

<div class="ml-cs-message-area"></div>

<div class="clearfix"></div><br />



<label for="ml-cs-title-text"><?php _e('Custom Title', 'meydjer') ?>:</label>
<input type="text" class="ml-admin-input-text ml-input-medium" name="ml-cs-title-text" id="ml-cs-title-text-<?php echo $post_id ?>" value="<?php echo $title_input_text ?>"><br><span class="ml-admin-detail">(<?php _e('leave it blank to show the page title', 'meydjer') ?>)</span>

<div class="clearfix"></div><br />



<label for="ml-cs-title-text-class"><?php _e('Class', 'meydjer') ?>:</label>
<input type="text" class="ml-admin-input-text ml-input-medium" name="ml-cs-title-text-class" id="ml-cs-title-text-class-<?php echo $post_id ?>" value="<?php echo $title_input_class ?>">

<div class="clearfix"></div><br />



<label for="ml-cs-title-size-select"><?php _e('Size', 'meydjer') ?>:</label>
<select name="ml-cs-title-size-select" id="ml-cs-title-size-select-<?php echo $post_id ?>">

	<?php foreach ($title_sizes as $key => $value) :

		$selected = ($pre_size == $key) ? 'selected="selected"' : '';

		?>

		<option value="<?php echo $key ?>" <?php echo $selected ?>><?php echo $value ?></option>

	<?php endforeach; ?>
	
</select>

<div class="clearfix"></div><br />



<div class="clearfix"></div><br />

<label for="ml-cs-title-alignment-radio"><?php _e('Alignment', 'meydjer') ?>:</label>

	<?php foreach ($title_alignments as $key => $value) :

		$checked = ($title_input_alignment == $key) ? 'checked="checked"' : '';

		?>

		<label class="ml-cs-title-alignment-option">
			<input type="radio" name="ml-cs-title-alignment-radio" class="ml-cs-title-alignment-radio-<?php echo $post_id ?>" value="<?php echo $key ?>" <?php echo $checked ?>>
			<?php echo $value ?>
		</label>

	<?php endforeach; ?>

<div class="clearfix"></div><br /><br />



<a href="#" class="ml-cs-title-save ml-admin-button ml-primary" id="ml-cs-title-save-<?php echo $post_id ?>"><?php _e('Done', 'meydjer') ?></a>

<div class="clearfix"></div><br />