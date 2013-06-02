<?php

$pre_color     = (get_post_meta($content->ID, '_ml_cs_alert_color', true));
$pre_text      = (get_post_meta($content->ID, '_ml_cs_alert_text', true));
$pre_text_size = (get_post_meta($content->ID, '_ml_cs_alert_text_size', true));

$alert_input_color     = ($pre_color)     ? $pre_color     : 'red';
$alert_input_text      = ($pre_text)      ? $pre_text      : __('Alert Text', 'meydjer');
$alert_input_text_size = ($pre_text_size) ? $pre_text_size : '1.1em';

?>

<div class="ml-alert ml-alrt-<?php echo $alert_input_color ?>" style="font-size:<?php echo $alert_input_text_size ?>;"> <?php echo do_shortcode($alert_input_text) ?> </div>

<div class="clearfix"></div>