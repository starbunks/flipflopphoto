<?php

$page_id    = get_post($content->ID)->post_parent;
$page_title = get_the_title($page_id);

$pre_text           = 'h1';
$pre_text           = (get_post_meta($content->ID, '_ml_cs_title_text',      true));
$pre_class          = (get_post_meta($content->ID, '_ml_cs_title_class',     true));
$pre_size           = (get_post_meta($content->ID, '_ml_cs_title_size',      true));
$pre_text_alignment = (get_post_meta($content->ID, '_ml_cs_title_alignment', true));

$clean_class = str_replace('.', ' ', $pre_class);


$title_input_text      = ($pre_text != '')            ? $pre_text           : $page_title;
$title_input_class     = ($pre_class)                 ? $clean_class        : '';
$title_input_alignment = ($pre_text_alignment)        ? $pre_text_alignment : 'left';

?>

<<?php echo $pre_size ?> class="ml-cs-title-v ml-<?php echo $title_input_alignment ?>-text <?php echo $title_input_class ?>">
	<div class="ml-wrapper">
		<?php echo do_shortcode($title_input_text) ?>
	</div>
</<?php echo $pre_size ?>>