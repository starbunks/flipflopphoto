<?php

$pre_title     = (get_post_meta($content->ID, '_ml_cs_cta_title', true));
$pre_btn_text  = (get_post_meta($content->ID, '_ml_cs_cta_btn_text', true));
$pre_btn_link  = (get_post_meta($content->ID, '_ml_cs_cta_btn_link', true));

$cta_input_title     = ($pre_title)     ? $pre_title     : __('Title', 'meydjer');
$cta_input_btn_text  = ($pre_btn_text)  ? $pre_btn_text  : __('Button Text', 'meydjer');
$cta_input_btn_link  = ($pre_btn_link)  ? $pre_btn_link  : '';
$this_size           = get_post_meta( $content->ID, '_ml_cs_size', true );

if($this_size != 1) {
	$cta_alignment = 'ml-cta-centered';
	$cta_clearfix  = '<div class="clearfix"></div><br><br>';
} else {
	$cta_alignment = '';
	$cta_clearfix  = '';
}

?>

<div class="ml-cta <?php echo $cta_alignment ?>">
	<div class="ml-wrapper">
		<span class="ml-cta-title"><?php echo do_shortcode($cta_input_title) ?></span>
		<?php echo $cta_clearfix ?>
		<a href="<?php echo $cta_input_btn_link ?>" class="ml-button"><?php echo $cta_input_btn_text ?></a>
	</div>
</div>

<div class="clearfix"></div>