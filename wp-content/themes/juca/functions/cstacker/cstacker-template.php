<?php

$items_array = array(
	'ml-cs-alert'        => __('Alert', 'meydjer'),
	'ml-cs-blank'        => __('Blank', 'meydjer'),
	'ml-cs-blog'         => __('Blog Entries', 'meydjer'),
	'ml-cs-cta'          => __('Call to Action', 'meydjer'),
	'ml-cs-column'       => __('Column', 'meydjer'),
	'ml-cs-divider'      => __('Divider', 'meydjer'),
	'ml-cs-page-content' => __('Page Content', 'meydjer'),
	'ml-cs-portfolio'    => __('Portfolio', 'meydjer'),
	'ml-cs-slider'       => __('Slider', 'meydjer'),
	'ml-cs-tabs'         => __('Tabs', 'meydjer'),
	'ml-cs-title'        => __('Title', 'meydjer'),
	'ml-cs-toggles'      => __('Toggles', 'meydjer'),
	'ml-cs-welcome'      => __('Welcome Message', 'meydjer')
	);

?>

<div class="clearfix"></div><br />

<input type="hidden" name="ml-theme-url" id="ml-theme-url" value="<?php echo get_template_directory_uri() ?>">

<div id="ml-sort-update"></div>



<label for="ml-add-item-select" class="ml-add-item ml-add-item-label"><?php _e('Select item:', 'meydjer') ?></label><br><br>
<select name="ml-add-item-select" id="ml-add-item-select" class="ml-add-item">
	<?php foreach ($items_array as $key => $value) : ?>
		<option value="<?php echo $key ?>"><?php echo $value ?></option>
	<?php endforeach; ?>
</select>

<a href="#" class="ml-admin-button ml-primary ml-add-item" id="ml-add-item-button">+ <?php _e('Add Item', 'meydjer') ?></a>

<div class="clearfix"></div><br />


<ul id="ml-cs-items" class="ml-cs-items">

	<?php

	$args = array(
	    'numberposts'     => -1,
	    'orderby'         => 'menu_order',
	    'order'           => 'ASC',
	    'post_parent'     => get_the_ID(),
	    'post_type'       => 'ml_cstacker'
	    );

	$posts_array = get_posts($args);

	if($posts_array) : foreach ($posts_array as $object => $post) :

		$post_size		= get_post_meta($post->ID, '_ml_cs_size', true); 
		$size_fraction	= ml_return_size_fraction($post_size); 

		?>
		
		<li id="ml-cs-item_<?php echo $post->ID ?>" data-id="<?php echo $post->ID ?>" data-type="<?php echo $post->post_title ?>" data-size="<?php echo $post_size ?>" class="<?php echo $post->post_title ?>-box ml-cs-li ml-cs-size-<?php echo $post_size ?> ml-cs-item-<?php echo $post->ID ?>">
			<div class="ml-cs-options">
				<a href="#" class="ml-cs-button ml-cs-sprite ml-hide-txt ml-cs-delete">&times;</a>
				<a href="#" class="ml-cs-button ml-cs-sprite ml-hide-txt ml-cs-edit">&#9998;</a>
				<a href="#" class="ml-cs-button ml-cs-sprite ml-hide-txt ml-cs-minus" data-button="minus">&#9664;</a>
				<a href="#" class="ml-cs-button ml-cs-sprite ml-hide-txt ml-cs-plus" data-button="plus">&#9654;</a>
				<span class="ml-cs-size ml-cs-sprite"><?php echo $size_fraction ?></a>
			</div>
			<div class="ml-cs-area">
				<div class="ml-cs-area-in">
					<h2 class="ml-cs-title"><?php echo $post->post_content ?></h2>
					<div class="ml-cs-edit-content" data-id="<?php echo $post->ID ?>"></div>
				</div>
			</div>
		</li>

	<?php endforeach; endif; ?>

</ul>