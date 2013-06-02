<?php  
/*  This is comment.phps by Christian Montoya, http://www.christianmontoya.com 

	Available to you under the do-whatever-you-want license. If you like it,  
	you are totally welcome to link back to me.  
	 
	Use of this code does not grant you the right to use the design or any of the  
	other files on my site. Beyond this file, all rights are reserved, unless otherwise noted.  
	 
	Used with slight modifications for this theme. 
*/ 
?> 

<!-- Comments code provided by christianmontoya.com --> 

<?php if (!empty($post->post_password) && $_COOKIE['wp-postpass_'.COOKIEHASH]!=$post->post_password) : ?> 

<div class="ml-comments">

	<p id="comments-locked"><?php _e('Enter your password to view comments.', 'meydjer'); ?></p> 

</div><!-- end div.ml_comments -->

<?php return; endif; ?> 



<?php if ($comments) : ?> 

<div class="ml-comments">

<?php  

	/* Count the totals */ 
	$numPingBacks = 0; 
	$numComments  = 0; 

	/* Loop throught comments to count these totals */ 
	foreach ($comments as $comment) { 
		if (get_comment_type() != "comment") { $numPingBacks++; } 
		else { $numComments++; } 
	} 
	 
	/* Used to stripe comments */ 
	$thiscomment = 'odd';  
?> 

<?php 

	/* This is a loop for printing pingbacks/trackbacks if there are any */ 
	if ($numPingBacks != 0) : ?> 

	<h4 class="ml-comments_header"><?php _e($numPingBacks); ?> <?php _e('Trackbacks/Pingbacks', 'meydjer'); ?></h4> 

	<ul id="trackbacks"> 
	 
		<?php foreach ($comments as $comment) : ?> 
		
			<?php if (get_comment_type()!="comment") : ?> 
			
				<li id="comment-<?php comment_ID() ?>" class="<?php _e($thiscomment); ?>"> 

					<?php comment_type(__('Comment','meydjer'), __('Trackback','meydjer'), __('Pingback','meydjer')); ?>:  
	
					<?php comment_author_link(); ?> <?php _e('on', 'meydjer'); ?> <?php comment_date(); ?> 

				</li> 
				 
				<?php if('odd'==$thiscomment) { $thiscomment = 'even'; } else { $thiscomment = 'odd'; } ?> 
				 
			<?php endif; ?>
	
		<?php endforeach; ?> 

	</ul> 

<?php endif; ?> 



		<?php  /* Print comments */ 
		
		if ( have_comments() ) :

			if ( ! empty($comments_by_type['comment']) ) : ?>
		
				<br>

				<div id="comments">

					<!-- .ml-entry-title -->
					<div class="ml-entry-title ml-etitle-in">
						<div class="ml-extra-border"></div>
						<h2 class="ml-tshad-3"><?php _e('Comments', 'meydjer') ?></h2>
						<div class="ml-extra-border"></div>
					</div>
					<!-- /.ml-entry-title -->

					<br>

					<ul id="all-comments" class="ml-all-comments">
			
					  <?php wp_list_comments('callback=meydjer_comment'); ?>
			
					</ul>
			
				</div>
			
				<br>

				<?php endif; ?> 
		
			</div><!-- end div.ml_comments -->
		
			<?php endif; ?> 
			 
		<?php endif; ?> 
		


		<?php if (comments_open()) : ?> 
				
			<div class="ml-comments">

			<?php if(have_comments()) : ?>

				<div class="ml-divider"></div>
			
			<?php endif; ?>
				
			<div id="comment-form" class="ml-comment-form-area"> 

				<!-- #respond -->
				<div id="respond">

					<!-- .ml-entry-title -->
					<div class="ml-entry-title ml-etitle-in">
						<div class="ml-extra-border"></div>
						<h2 class="ml-tshad-3"><?php

							echo comment_form_title(
							__('Leave Your Comment', 'meydjer'),
							__('Reply To %s', 'meydjer') ); 

						?></h2>
						<div class="ml-extra-border"></div>
					</div>
					<!-- /.ml-entry-title -->

				</div>
				<!-- /#respond -->

			<div class="clearfix"></div>

			<?php if (get_option('comment_registration') && !$user_ID ) : ?> 
				<p id="comments-blocked"><?php printf(__('You must be %1$slogged in%2$s to post a comment.', 'meydjer'), '<a href="'.get_option('siteurl').'/wp-login.php?redirect_to='.urlencode(get_permalink()).'">', '</a>') ?></p> 
			<?php else : ?> 
		
			<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform" class="ml-comment-form"> 
				
				<p class="ml-center-text"><?php cancel_comment_reply_link(__('Click here to cancel your reply.', 'meydjer')); ?></p>

				<br>
				
			<?php if ($user_ID) : ?> 
			
				<p class="ml-center-text"><?php printf(__('Logged in as %1$s - %2$s(Log out) %3$s', 'meydjer'), '<a href="'.get_option('siteurl').'/wp-admin/profile.php">'.$user_identity.'</a>', '<a href="'.(function_exists('wp_logout_url') ? wp_logout_url(get_permalink()) : get_option('siteurl').'/wp-login.php?action=logout" title="').'" title="'.__('Log out of this account', 'meydjer').'">', '</a>') ?> 
				</p> 

				<br>
			 
			<?php else : ?>

				<label for="author"><?php _e('* Name', 'meydjer') ?></label>			
				<input type="text" class="input-text" name="author" id="author" value="<?php echo $comment_author; ?>" />

				<div class="clearfix"></div><br>
				
				<label for="email"><?php _e('* Email', 'meydjer') ?></label>			
				<input type="email" class="input-text" name="email" id="email" value="<?php echo $comment_author_email; ?>" />

				<div class="clearfix"></div><br>

				<label for="url"><?php _e('Website', 'meydjer') ?></label>			
				<input type="url" class="input-text" name="url" id="url" value="<?php echo $comment_author_url; ?>" /> 

				<div class="clearfix"></div><br>
						 
			<?php endif; ?>

				<label for="comment"><?php _e('* Comment', 'meydjer') ?></label>
				<textarea name="comment" id="comment" rows="8" cols="40" class="input-textarea"></textarea>
				 
				<?php /* Buttons are easier to style than input[type=submit],  
						but you can replace:  
						<button type="submit" name="submit" id="sub">Submit</button> 
						with:  
						<input type="submit" name="submit" id="sub" value="Submit" /> 
						if you like */  
				?> 

				<div class="clearfix"></div><br>
				
				<button type="submit" name="submit" id="submit-button" tabindex="5" class="ml-comment-submit ml-button"><?php _e('Submit', 'meydjer'); ?></button> 
					<?php comment_id_fields(); ?>
			 
					<?php do_action('comment_form', $post->ID); ?>
		
			</form> 
		
			<div class="ml-nav-next"><?php next_comments_link(__('&lt; Older Comments', 'meydjer')) ?></div>
			<div class="ml-nav-prev"><?php previous_comments_link(__('Newer Comments &gt;', 'meydjer')) ?></div>
	
		</div>
		
		<div class="clearfix"></div>
	
	<?php endif; // If registration required and not logged in ?> 
	
</div><!-- end div.ml_comments -->



<?php endif; ?>