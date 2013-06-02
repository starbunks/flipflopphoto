<?php

$pre_text     = (get_post_meta($post_id, '_ml_cs_divider_text', true));
$divider_link = ($pre_text) ? $pre_text : '';

?>

<div class="ml-cs-message-area"></div>

<div class="clearfix"></div><br />


<label for="ml-cs-divider-text" class="ml-admin-single-label"><?php _e('Back-to-top Text (optional)', 'meydjer') ?>:</label>
<input type="text" class="ml-admin-input-text ml-input-medium" name="ml-cs-divider-text" id="ml-cs-divider-text-<?php echo $post_id ?>" value="<?php echo $divider_link ?>">


<div class="clearfix"></div><br /><br />

<a href="#" class="ml-cs-divider-save ml-admin-button ml-primary" id="ml-cs-divider-save-<?php echo $post_id ?>"><?php _e('Done', 'meydjer') ?></a>

<div class="clearfix"></div><br />