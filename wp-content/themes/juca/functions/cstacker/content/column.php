<?php

$pre_text          = (get_post_meta($content->ID, '_ml_cs_column_text', true));
$pre_text          = ml_p($pre_text);
$pre_text          = do_shortcode($pre_text);
$column_input_text = ($pre_text) ? $pre_text : __('column Text', 'meydjer');

?>

<?php echo do_shortcode($column_input_text) ?>

<div class="clearfix"></div>