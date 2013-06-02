<?php

$pre_text         = (get_post_meta($post_id, '_ml_cs_column_text', true));
$column_input_text = ($pre_text) ? $pre_text : __('Column Text', 'meydjer');


?>

<div class="ml-cs-message-area"></div>

<div class="clearfix"></div><br />

<label for="ml-cs-column-text"><?php _e('Text', 'meydjer') ?>:</label>
<textarea class="ml-admin-textarea" name="ml-cs-column-text" id="ml-cs-column-text-<?php echo $post_id ?>" rows="8" cols="30"><?php echo $column_input_text ?></textarea>


<div class="clearfix"></div><br /><br />

<a href="#" class="ml-cs-column-save ml-admin-button ml-primary" id="ml-cs-column-save-<?php echo $post_id ?>"><?php _e('Done', 'meydjer') ?></a>

<div class="clearfix"></div><br />