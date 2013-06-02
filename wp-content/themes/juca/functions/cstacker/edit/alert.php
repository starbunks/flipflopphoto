<?php

$alert_colors = array(
	'red'    => __('Red', 'meydjer'),
	'blue'   => __('Blue', 'meydjer'),
	'green'  => __('Green', 'meydjer'),
	'yellow' => __('Yellow', 'meydjer'),
	'black'  => __('Black', 'meydjer')
	);


$pre_color     = (get_post_meta($post_id, '_ml_cs_alert_color', true));
$pre_text      = (get_post_meta($post_id, '_ml_cs_alert_text', true));
$pre_text_size = (get_post_meta($post_id, '_ml_cs_alert_text_size', true));

$alert_input_text      = ($pre_text)      ? $pre_text      : __('Alert Text', 'meydjer');
$alert_input_text_size = ($pre_text_size) ? $pre_text_size : '1.1em';


?>

<div class="ml-cs-message-area"></div>

<div class="clearfix"></div><br />

<label for="ml-cs-alert-color-select"><?php _e('Color', 'meydjer') ?>:</label>

<select name="ml-cs-alert-color-select" id="ml-cs-alert-color-select-<?php echo $post_id ?>">

	<?php foreach ($alert_colors as $key => $value) :

		$selected = ($pre_color == $key) ? 'selected="selected"' : '';

		?>

		<option value="<?php echo $key ?>" <?php echo $selected ?>><?php echo $value ?></option>

	<?php endforeach; ?>
	
</select>

<br>
<br>

<label for="ml-cs-alert-text-size"><?php _e('Text Size', 'meydjer') ?>:</label>
<input type="text" class="ml-admin-input-text ml-input-mini" name="ml-cs-alert-text-size" id="ml-cs-alert-text-size-<?php echo $post_id ?>" value="<?php echo $alert_input_text_size ?>">



<div class="clearfix"></div><br />


<label for="ml-cs-alert-text"><?php _e('Text', 'meydjer') ?>:</label>
<textarea class="ml-admin-textarea" name="ml-cs-alert-text" id="ml-cs-alert-text-<?php echo $post_id ?>" rows="8" cols="30"><?php echo $alert_input_text ?></textarea>


<div class="clearfix"></div><br /><br />

<a href="#" class="ml-cs-alert-save ml-admin-button ml-primary" id="ml-cs-alert-save-<?php echo $post_id ?>"><?php _e('Done', 'meydjer') ?></a>

<div class="clearfix"></div><br />