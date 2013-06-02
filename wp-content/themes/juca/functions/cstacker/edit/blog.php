<?php

$show = get_post_meta( $post_id, '_ml_cs_blog_show', true );

?>

<div class="ml-cs-message-area"></div>

<div class="clearfix"></div><br />


<h4><?php _e('Show latest', 'meydjer') ?>:</h4>


<select name="ml-cs-blog-select" id="ml-cs-blog-select-<?php echo $post_id ?>">

	<?php for ($i=1; $i <= 20; $i++) :

		$selected = ($show == $i) ? 'selected="selected"' : '';

		?>

		<option value="<?php echo $i ?>" <?php echo $selected ?>><?php echo $i ?></option>

	<?php endfor; ?>

</select>


<div class="clearfix"></div><br /><br />

<a href="#" class="ml-cs-blog-save ml-admin-button ml-primary" id="ml-cs-blog-save-<?php echo $post_id ?>"><?php _e('Done', 'meydjer') ?></a>

<div class="clearfix"></div><br />