<?php

$pre_text     = (get_post_meta($content->ID, '_ml_cs_divider_text', true));

$divider_link =
	($pre_text)
		? '<a href="#ml-header" class="ml-back-to-top">' . $pre_text . '</a>'
		: '';

?>

<div class="ml-divider"><?php echo $divider_link ?></div>

<div class="clearfix"></div>