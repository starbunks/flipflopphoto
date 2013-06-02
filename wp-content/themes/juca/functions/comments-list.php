<?php 

function meydjer_comment($comment, $args, $depth) {

	$GLOBALS['comment'] = $comment; ?>

	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
	
	<div id="comment-<?php comment_ID(); ?>" class="ml-comment-box">
	
	<?php if ($comment->comment_approved == '0') : ?>

	<strong><?php _e('Your comment is awaiting moderation.','meydjer') ?></strong><br /><br />

	<?php endif; ?>
	

		<!-- .ml-comment-ava -->
		<div class="ml-comment-ava">

			<a href="<?php comment_author_url() ?>" rel="external nofollow" class="url ml-avatar-img">
				<div class="ml-comment-avatar ml-nav-img">

					<?php echo get_avatar($comment,$size='47'); ?>

					<div class="ml-nav-img-frame"></div>

				</div>
			</a>

		</div>
		<!-- /.ml-comment-ava -->


		
		<?php /* Comment content */ ?>
		<div class="ml-comment-content">
			
			<div class="ml-comment-info">
	
				<?php comment_author_link(); ?> &nbsp;&ndash;&nbsp; <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>" class="ml-comment-date"><?php echo get_comment_date('F j, Y'); ?> <?php _e('at', 'meydjer') ?> <?php echo get_comment_date('h:ia'); ?></a> &nbsp;&ndash;&nbsp; <?php comment_reply_link(array_merge( $args, array('reply_text' => __('Reply &rarr;', 'meydjer'), 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>

				<span class="ml-comment_edit"><?php edit_comment_link(__('(Edit)','meydjer'),'&nbsp;|&nbsp;&nbsp;',''); ?></span>
			
			</div>

			<?php comment_text() ?>

		</div>
	</div>

<?php } ?>