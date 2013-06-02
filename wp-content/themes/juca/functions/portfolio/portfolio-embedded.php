<!-- .ml-pcontent -->
<div class="ml-pcontent" data-id="<?php echo $post_id ?>" data-total="1" data-slug="<?php echo $post_slug ?>">

	<div class="ml-pitem ml-to-fade ml-phtml">

		<?php if (preg_match('/youtube|youtu.be|vimeo|blip.tv|viddler|kickstarter/', $post_content)): ?>

			<div class="ml-fit">
				<?php echo do_shortcode($post_content) ?>
			</div>

		<?php else : ?>

			<div class="ml-try-middle">
				<?php echo do_shortcode($post_content) ?>
			</div>

		<?php endif ?>

	</div>
	
</div>
<!-- /.ml-pcontent -->


<!-- .ml-pcontrols -->
<div class="ml-pcontrols">

	<a href="#" class="ml-pbutton ml-pclose"><span>&#x58;</span></a>

</div>
<!-- /.ml-pcontrols -->