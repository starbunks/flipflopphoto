<?php

$pre_title     = (get_post_meta($post_id, '_ml_cs_cta_title', true));
$pre_btn_text  = (get_post_meta($post_id, '_ml_cs_cta_btn_text', true));
$pre_btn_link  = (get_post_meta($post_id, '_ml_cs_cta_btn_link', true));

$cta_input_title     = ($pre_title)     ? $pre_title     : __('Title', 'meydjer');
$cta_input_btn_text  = ($pre_btn_text)  ? $pre_btn_text  : __('Button Text', 'meydjer');
$cta_input_btn_link  = ($pre_btn_link)  ? $pre_btn_link  : '';


?>

<div class="ml-cs-message-area"></div>

<div class="clearfix"></div><br />

<label for="ml-cs-cta-title"><?php _e('Title', 'meydjer') ?>:</label>
<input type="text" class="ml-admin-input-text ml-input-medium" name="ml-cs-cta-title" id="ml-cs-cta-title-<?php echo $post_id ?>" value="<?php echo $cta_input_title ?>">


<div class="clearfix"></div><br />


<label for="ml-cs-cta-btn-text"><?php _e('Button Text', 'meydjer') ?>:</label>
<input type="text" class="ml-admin-input-text ml-input-medium" name="ml-cs-cta-btn-text" id="ml-cs-cta-btn-text-<?php echo $post_id ?>" value="<?php echo $cta_input_btn_text ?>">


<div class="clearfix"></div><br /><br />


<label for="ml-cs-cta-btn-link"><?php _e('Button Link', 'meydjer') ?>:</label>
<input type="text" class="ml-admin-input-text ml-input-large" name="ml-cs-cta-btn-link" id="ml-cs-cta-btn-link-<?php echo $post_id ?>" value="<?php echo $cta_input_btn_link ?>">



<div class="clearfix"></div><br /><br />


<a href="#" class="ml-cs-cta-save ml-admin-button ml-primary" id="ml-cs-cta-save-<?php echo $post_id ?>"><?php _e('Done', 'meydjer') ?></a>

<div class="clearfix"></div><br />