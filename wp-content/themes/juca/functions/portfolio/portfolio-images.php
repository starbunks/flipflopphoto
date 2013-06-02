<!-- .ml-pcontent -->
	<div class="ml-pcontent" data-id="<?php echo $post_id ?>" data-total="<?php echo $total_items ?>" data-slug="<?php echo $post_slug ?>">

		<?php

		$count_img=0;

		foreach ($post_images as $img):

			$count_img++;

			$img_size = getimagesize($img);

		?>

			<div class="ml-pitem ml-pitem-<?php echo $count_img ?> ml-to-fade ml-pimage" data-num="<?php echo $count_img ?>" data-img="<?php echo $img ?>" data-width="<?php echo $img_size[0] ?>" data-height="<?php echo $img_size[1] ?>"></div>
			
		<?php endforeach ?>
		
	</div>
	<!-- /.ml-pcontent -->


	<!-- .ml-pcontrols -->
	<div class="ml-pcontrols">

		<a href="#" class="ml-pbutton ml-pclose"><span>&#x58;</span></a>

		<?php if ($total_items > 1): ?>
			
		<a href="#" class="ml-pbutton ml-pprev" data-direction="prev"><span>&#x3c;</span></a>
		<a href="#" class="ml-pbutton ml-pnext" data-direction="next"><span>&#x3e;</span></a>
		<a href="#" class="ml-pbutton ml-pplaypause ml-pplay"><span class="ml-splay">&#x50;</span><span class="ml-spause">&#x70;</span></a>
		<a href="#" class="ml-pbutton ml-pgrid"><span>&#x23;</span></a>

		<!-- .ml-pgridbox -->
		<div class="ml-pgridbox">

			<div class="ml-pgridneck"></div>

			<!-- .ml-pthumbs -->
			<div class="ml-pthumbs">

				<?php if ($total_items > $thumbs_to_wrap): ?>
					
				<!-- .ml-thumbsnav -->
				<div class="ml-thumbsnav">
					<a href="#" class="ml-thumbsprev" data-direction="prev"><span>&#x3c;</span></a>
					<a href="#" class="ml-thumbsnext" data-direction="next"><span>&#x3e;</span></a>
					<input type="hidden" name="ml-total-blocks" id="ml-total-blocks" value="<?php echo $total_blocks ?>">
					<input type="hidden" name="ml-current-block" id="ml-current-block" value="1">
				</div>
				<!-- /.ml-thumbsnav -->

				<?php endif ?>

				<!-- .ml-pthumbsport -->
				<div class="ml-pthumbsport">
					
					<!-- .ml-pthumbswrap -->
					<div class="ml-pthumbswrap" style="width: <?php echo $wrap_width ?>px ">

						<!-- .ml-pthumbblock -->
						<div class="ml-pthumbblock">

							<?php

							$count_img=0;

							foreach ($post_images as $img):

								$count_img++;

								$thumbnail = vt_resize( '', $img, 47, 47, true );

								$active = ($count_img == 1)
									? 'ml-active'
									: '';

								?>

								<a href="#"  class="ml-pthumb-<?php echo $count_img ?> ml-pthumblink <?php echo $active ?>" data-num="<?php echo $count_img ?>">
									<span><?php echo $count_img ?></span>
									<img src="<?php echo $thumbnail['url'] ?>" width="47" height="47">
								</a>
								
							<?php if ($count_img % $thumbs_to_wrap == 0): ?>
							</div><div class="ml-pthumbblock">
							<?php endif ?>

							<?php endforeach ?>

						</div>
						<!-- /.ml-pthumbblock -->

					</div>
					<!-- /.ml-pthumbswrap -->

				</div>
				<!-- /.ml-pthumbsport -->

			</div>
			<!-- /.ml-pthumbs -->

		</div>
		<!-- /.ml-pgridbox -->

		<?php endif ?>

	</div>
	<!-- /.ml-pcontrols -->