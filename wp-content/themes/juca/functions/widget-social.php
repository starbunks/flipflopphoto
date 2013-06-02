<?php


add_action( 'widgets_init', 'register_social_widget' );


function register_social_widget() {
	register_widget( 'Social_Widget' );
}


class Social_Widget extends WP_Widget {

	var $social_options;

	/* Instantiate the Widget class */
	function Social_Widget() {
		parent::WP_Widget(false, __('Theme - Social Icons', 'meydjer'));

		$this->configureOptions();
	}
	
	/* the widget in action */
	function widget( $args, $instance ) {
		extract($args);

		foreach ($this->social_options as $option) {

			// if url is defined
			if ( array_key_exists($option['field'], $instance) && !empty($instance[$option['field']]) ) {
				?>
				<li><a href="<?php echo $instance[$option['field']] ?>"><?php echo $option['icon'] ?></a></li>
				<?php
			}	

		}		
	}

	/* Update the widget data */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		foreach ($this->social_options as $option) {
			$instance[$option['field']] = $new_instance[$option['field']];
		}

		return $instance;
	}

	/* Widget configuration form */
	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance );

		foreach ($this->social_options as $option) {
    		?>
			<p>
				<label for="<?php echo $this->get_field_id($option['field']); ?>"><?php _e($option['label'], 'meydjer'); ?>:</label>
				<input type="text" name="<?php echo $this->get_field_name($option['field']) ?>" id="<?php echo $this->get_field_id($option['field']) ?> " value="<?php echo ( array_key_exists($option['field'], $instance) ? $instance[$option['field']] : '' ) ?>" size="27">
			</p>
			<?php    		
		}
		
	}

	function configureOptions() {
		$this->social_options = array();
		$this->social_options[] = array('label'=>'Email Address', 	'field'=>'emailaddress', 	'icon'=>'&#x21;');
		$this->social_options[] = array('label'=>'Google Plus URL', 'field'=>'googlePlusUrl', 	'icon'=>'&#x22;');
		$this->social_options[] = array('label'=>'Facebook URL', 	'field'=>'facebookUrl', 	'icon'=>'&#x23;');
		$this->social_options[] = array('label'=>'Twitter URL', 	'field'=>'twitterUrl', 		'icon'=>'&#x24;');
		$this->social_options[] = array('label'=>'Feed URL', 		'field'=>'feedUrl', 		'icon'=>'&#x25;');
		$this->social_options[] = array('label'=>'Youtube URL', 	'field'=>'youtubeUrl', 		'icon'=>'&#x26;');
		$this->social_options[] = array('label'=>'Vimeo URL', 		'field'=>'vimeoUrl', 		'icon'=>'&#x27;');
		$this->social_options[] = array('label'=>'Flickr URL', 		'field'=>'flickrUrl', 		'icon'=>'&#x28;');
		$this->social_options[] = array('label'=>'Picasa URL', 	'field'=>'picassaUrl', 		'icon'=>'&#x29;');
		$this->social_options[] = array('label'=>'Dribbble URL', 	'field'=>'dribbbleUrl', 	'icon'=>'&#x2a;');
		$this->social_options[] = array('label'=>'Forrst URL', 		'field'=>'forrstUrl', 		'icon'=>'&#x2b;');
		$this->social_options[] = array('label'=>'devianART URl', 	'field'=>'deviantartUrl', 	'icon'=>'&#x2c;');
		$this->social_options[] = array('label'=>'GitHub URL', 		'field'=>'githubUrl', 		'icon'=>'&#x2d;');
		$this->social_options[] = array('label'=>'Wordpress URL', 	'field'=>'wordpressUrl', 	'icon'=>'&#x2e;');
		$this->social_options[] = array('label'=>'Blogger URL', 	'field'=>'bloggerUrl', 		'icon'=>'&#x2f;');
		$this->social_options[] = array('label'=>'Tumblr URL', 		'field'=>'tumblrUrl', 		'icon'=>'&#x30;');
		$this->social_options[] = array('label'=>'Yahoo URL', 		'field'=>'yahooUrl', 		'icon'=>'&#x31;');
		$this->social_options[] = array('label'=>'Amazon URL', 		'field'=>'amazonUrl', 		'icon'=>'&#x32;');
		$this->social_options[] = array('label'=>'SoundCloud URL', 	'field'=>'soundcloudUrl', 	'icon'=>'&#x33;');
		$this->social_options[] = array('label'=>'Android URL', 	'field'=>'androidUrl', 		'icon'=>'&#x34;');
		$this->social_options[] = array('label'=>'Apple URL', 		'field'=>'appleUrl', 		'icon'=>'&#x35;');
		$this->social_options[] = array('label'=>'Windows URL', 	'field'=>'windowsUrl', 		'icon'=>'&#x36;');
		$this->social_options[] = array('label'=>'Skype URL', 		'field'=>'skypeUrl', 		'icon'=>'&#x37;');
		$this->social_options[] = array('label'=>'Reddit URL', 		'field'=>'redditUrl', 		'icon'=>'&#x38;');
		$this->social_options[] = array('label'=>'LinkedIn URL', 	'field'=>'linkedinUrl', 	'icon'=>'&#x39;');
		$this->social_options[] = array('label'=>'Last.fm URL', 	'field'=>'lastfmUrl', 		'icon'=>'&#x3a;');
		$this->social_options[] = array('label'=>'Delicious URL', 	'field'=>'deliciousUrl', 	'icon'=>'&#x3b;');
		$this->social_options[] = array('label'=>'StumbleUpon URL', 'field'=>'stumbleuponUrl', 	'icon'=>'&#x3c;');
		$this->social_options[] = array('label'=>'Pinterest URL', 	'field'=>'pinterestUrl', 	'icon'=>'&#x3d;');
	}


}

?>