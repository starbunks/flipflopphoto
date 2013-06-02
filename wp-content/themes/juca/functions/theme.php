<?php

/*-------------------------------------------------*/
/*	Logo
/*-------------------------------------------------*/


/* Return the header image; or site title; or title missing message; and the tagline. */
function ml_theme_logo() {

	$custom_tagline = '';
	$custom_title   = '';
	$custom_title   = get_header_image();

	if ( $custom_title ) {
		$custom_title = '<img src="'.$custom_title.'" alt="'.get_bloginfo('name').'" />';
	} else {
		// dont have header image
		$custom_title = get_bloginfo('name');
		if ( $custom_title ) {
			// use the site title
			$custom_title = '<div class="ml-title">'.$custom_title.'</div>';
		}

		$custom_tagline = get_bloginfo( 'description', 'display' );
		if ( $custom_tagline ) {
			// add tagline
			$custom_tagline = '<p class="ml-tagline">' . $custom_tagline . '</p>';
		}

	}

	if ( !$custom_title ) {
		// dont have header image or site title: disclaimer
		$custom_title = '<div class="ml-title-missing">' . __('You need to <a href="' . home_url() .'/wp-admin/customize.php" target="_blank">configure the site title or image</a>.', 'meydjer') . '</div>';
	}


	return
		'<div class="ml-logo">' .
			'<a href="' . home_url() . '" class="ml-logo-obj" title="' . __('Back to the Homepage', 'meydjer') . '">' .
			$custom_title .	
			$custom_tagline .
		'</a></div>';	
}




/*-------------------------------------------------*/
/*	Favicon
/*-------------------------------------------------*/

function ml_theme_favicon() {

	if (of_get_option('ml-favicon')) {

	?>
	
		<link rel="shortcut icon" href="<?php echo of_get_option('ml-favicon') ?>">

	<?php

	}

}




/*-------------------------------------------------*/
/*	SEO
/*-------------------------------------------------*/

function ml_seo_title($post_id) {

	$seo_title    = get_post_meta( $post_id, '_ml_seo_title', true );
	$built_in_seo = of_get_option('ml-built-in_seo', 1);

	if( ($built_in_seo == 1) && ((trim($seo_title) != '') || ($seo_title != NULL)) ) {

		return $seo_title;

	} else {

		return wp_title('-', false, 'right') . get_bloginfo('name');

	}


}

function ml_seo_description($post_id) {

	$seo_description = get_post_meta( $post_id, '_ml_seo_description', true );
	$built_in_seo    = of_get_option('ml-built-in_seo', 1);

	if( ($built_in_seo == 1) && ((trim($seo_description) != '') || ($seo_description != NULL)) ) {

		return $seo_description;

	} else {

		return get_bloginfo('description');

	}


}

function ml_seo_keywords($post_id) {

	$seo_keywords = get_post_meta( $post_id, '_ml_seo_keywords', true );
	$built_in_seo = of_get_option('ml-built-in_seo', 1);

	if( ($built_in_seo == 1) && ((trim($seo_keywords) != '') || ($seo_keywords != NULL)) ) {

		return $seo_keywords;

	}

}

function ml_seo_robots($post_id) {

	$index	     = get_post_meta( $post_id, '_ml_seo_index', true );
	$follow	     = get_post_meta( $post_id, '_ml_seo_follow', true );
	$built_in_seo = of_get_option('ml-built-in_seo', 1);


	if( ($built_in_seo == 1) && ($index && $follow) ) {

		return $index . ', ' . $follow;

	}

}



/*-------------------------------------------------*/
/*	Get Images Array
/*-------------------------------------------------*/

function ml_uploaded_images($id, $meta) {

	global $wpdb, $post;

	$image_meta = get_post_meta( $id, $meta, false );

	if ( !is_array( $image_meta ) )
	    $image_meta = ( array ) $image_meta;

	if ( !empty( $image_meta ) ) {

		$images_array = array();

		foreach ($image_meta as $key => $value) {
			$images_array[] = $value;
		}

	   $images_array = implode( ',', $images_array );
	   $images = $wpdb->get_col( "
			SELECT ID FROM $wpdb->posts
			WHERE post_type = 'attachment'
			AND ID IN ( $images_array )
			ORDER BY menu_order ASC
		" );

	    $images_array = array();

	    foreach ( $images as $att ) {
	        // Get image's source based on size, can be 'thumbnail', 'medium', 'large', 'full' or registed post thumbnails sizes
	        $src = wp_get_attachment_image_src( $att, 'full' );
	        $src = $src[0];

	        // Show image
	        $images_array[] = $src;
	    }
	}


	if(isset($images_array))
		return $images_array;

}



/*-------------------------------------------------*/
/*	Get Files Array
/*-------------------------------------------------*/

function ml_uploaded_files($id, $meta) {

	$files       = get_post_meta( $id, $meta, false );
	$files_array = array();

	foreach ( $files as $att )	{
		$files_array[] = wp_get_attachment_url($att);
	}

	return $files_array;

}



/*-------------------------------------------------*/
/*	Paragraph
/*-------------------------------------------------*/

function ml_p($content) {

	$text = '<p>' . preg_replace("/(\n|\r|\r\n)+(?!(.(?!<code>))*<\/code>)|(\n|\r|\r\n)+(?=<code>)/is", "</p><p>", $content) . '</p>' ;

	return $text;

}



/*-------------------------------------------------*/
/*	Rule of Three
/*-------------------------------------------------*/

if(!function_exists('ml_rot')) {

	function ml_rot($val_a1, $val_a2, $val_b1) {

		return ($val_a2 * $val_b1) / $val_a1;

	}

}


/*-------------------------------------------------*/
/*	Featured Image
/*-------------------------------------------------*/

function ml_get_featured_image( $additional_end_tags='', $add_link=true ) {
	if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) {

		if ( !$additional_end_tags ) {
			$additional_end_tags = '';
		}

		$featured_image_id  = get_post_thumbnail_id();

		$featured_image = ml_prop_featured($featured_image_id, 754);

		if ( !$featured_image ) {
			return '<h1 style="color:red;">' . __('File of "Featured Image" was not found!', 'meydjer') 
				. '</h1>' . $additional_end_tags;
		}

		$featured_image_meta = get_post($featured_image_id);

		$result = '<img src="'.$featured_image['url'].'" alt="'.$featured_image_meta->post_title.'" class="ml-ftrd-img">';

		if ( !$add_link ) {
			return $result . $additional_end_tags;
		}

		return '<a href="'.get_permalink().'" class="ml-post-ftrd">' . $result . '</a>' . $additional_end_tags;

	}	
}



/*-------------------------------------------------*/
/*	Proportional Featured Image
/*-------------------------------------------------*/

function ml_prop_featured($featured_image_id, $width){

	$featured_image_src  = wp_get_attachment_image_src($featured_image_id,'full');

	if ( !$featured_image_src ) {
		return false;
	}

	$featured_image_size = getimagesize($featured_image_src[0]);

	$featured_image_rot  = ml_rot($featured_image_size[0], $width, $featured_image_size[1]);

	$featured_image      = vt_resize( $featured_image_id, '', $width, $featured_image_rot, true );

	return $featured_image;

}



/*-------------------------------------------------*/
/*	Standard Fonts
/*-------------------------------------------------*/

function ml_standard_fonts() {

	return 
		array(

			'"Arial Black", Gadget, sans-serif' => '"Arial Black", Gadget, sans-serif',

			'"Helvetica Neue", Helvetica, Arial, Clean, Garuda, sans-serif' => '"Helvetica Neue", Helvetica, Arial, Clean, Garuda, sans-serif',

			'Verdana, Geneva, Kalimati, sans-serif' => 'Verdana, Geneva, Kalimati, sans-serif',

			'"Lucida Grande", "Lucida Sans Unicode", Garuda, sans-serif' => '"Lucida Grande", "Lucida Sans Unicode", Garuda, sans-serif',

			'Georgia, "Nimbus Roman No9 L", serif' => 'Georgia, "Nimbus Roman No9 L", serif',

			'"Palatino Linotype", "Book Antiqua", Palatino, FreeSerif, serif' => '"Palatino Linotype", "Book Antiqua", Palatino, FreeSerif, serif',


			'Tahoma, Geneva, Kalimati, sans-serif' => 'Tahoma, Geneva, Kalimati, sans-serif',

			'"Trebuchet MS", Helvetica, Jamrul, sans-serif' => '"Trebuchet MS", Helvetica, Jamrul, sans-serif',

			'"Times New Roman", Times, FreeSerif, serif' => '"Times New Roman", Times, FreeSerif, serif',

		);

}



/*-------------------------------------------------*/
/*	Google Fonts
/*-------------------------------------------------*/

/*--- Store Latest Google Foonts ---*/

function ml_get_latest_google_fonts($interval, $list_url) {

	$db_cache_field = 'google_font-cache';
	$db_cache_field_last_updated = 'google_font-cache-last-updated';
	$last = get_option( $db_cache_field_last_updated );
	$now = time();


	// check the cache
	if ( !$last || (( $now - $last ) > $interval) ) {

		// cache doesn't exist, or is old, so refresh it
		$cache = file_get_contents($list_url);

		if ($cache) {			
			// we got good results	
			update_option( $db_cache_field, $cache );
			update_option( $db_cache_field_last_updated, time() );
		} 

		// read from the cache file
		$google_font_data = get_option( $db_cache_field );

	} else {

		// cache file is fresh enough, so read from it
		$google_font_data = get_option( $db_cache_field );

	}

	$contents = utf8_encode($google_font_data); 
	$contents = json_decode($contents, true); 


	return $contents;
}


/*--- Generate Google Fonts Options ---*/

function ml_google_fonts() {

	$interval =  6 * 60 * 60; //6 hours
	$list_url = 'https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyDokGWTGskEh0tkCICgYQfZg7bXeKJ8nQg'; //Google Fonts list URL

	//Blank Google Fonts array
	$google_fonts = array();

	$list_content = ml_get_latest_google_fonts($interval, $list_url);

	//If has content, start the party
	if($list_content) {

		$google_fonts_array = $list_content['items'];

		//Gets each font-face...
		foreach($google_fonts_array as $font) {

			//...and build and <option>
			foreach($font['variants'] as $variant => $font_variant) {

				if($font_variant == 'regular') { //"regular" exception

					$font_style = NULL;
					$font_weight = 'Regular';
					$font_weight_number = NULL;
					
				} else if($font_variant == 'bolditalic') { //"bolditalic" exception
					
					$font_style = 'Italic';
					$font_weight = 'Bold ';
					$font_weight_number = NULL;

				} else if($font_variant == 'bold') { //"bold" exception
					
					$font_style = NULL;
					$font_weight = 'Bold';
					$font_weight_number = NULL;

				} else if($font_variant == 'italic') { //"italic" exception
					
					$font_style = 'Italic';
					$font_weight = NULL;
					$font_weight_number = NULL;

				} else {

					//check if is italic
					$font_style = (substr($font_variant,3)) ? ' Italic' : NULL;

					//get the first 3 characters and write the weight name
					$font_weight_number = substr($font_variant,0,3);
					if($font_weight_number < 200) $font_weight = 'Ultra-Light';
					if($font_weight_number >= 200) $font_weight = 'Light';
					if($font_weight_number >= 300) $font_weight = 'Book';
					if($font_weight_number >= 400) $font_weight = 'Normal';
					if($font_weight_number >= 500) $font_weight = 'Medium';
					if($font_weight_number >= 600) $font_weight = 'Semi-Bold';
					if($font_weight_number >= 700) $font_weight = 'Bold';
					if($font_weight_number >= 800) $font_weight = 'Extra-Bold';
					if($font_weight_number >= 900) $font_weight = 'Ulta-Bold';

					$font_weight .= ' ';

				}

				//write the <option> tag
				$google_fonts[ $font['family'] . ':' . $font_variant ] = $font['family'] . ' - ' . $font_weight . $font_weight_number . $font_style;

			}

		}

	//if Google Fonts API is down, show and error and use a sans-serif font
	} else {

		$google_fonts['Merriweather:regular'] = __('Google Fonts API is currently down.', 'meydjer');

	}

	return $google_fonts;

}


/*--- Write Google Fonts Stylesheets ---*/

function ml_get_google_fonts() {

	$fonts_num	= of_get_option('ml-fonts_num', 3);
	$fonts_link	= NULL;

	for ($count=1; $count <= $fonts_num; $count++) {

		$font_type = of_get_option('ml-font-'.$count);

		if($font_type == 'google') {

			$font = of_get_option('ml-google_fonts-'.$count);

			$font_parts   = explode(':', $font);
			$font_family  = $font_parts[0];
			$font_variant = $font_parts[1];

			if($font_variant == 'regular') {

				$fonts_link .= '<link href="http://fonts.googleapis.com/css?family=' . $font_family . '" rel="stylesheet" type="text/css">';

			} else if($font_variant == 'bold') {

				$fonts_link .= '<link href="http://fonts.googleapis.com/css?family=' . $font_family . ':700" rel="stylesheet" type="text/css">';

			} else if($font_variant == 'bolditalic') {

				$fonts_link .= '<link href="http://fonts.googleapis.com/css?family=' . $font_family . ':700italic" rel="stylesheet" type="text/css">';

			} else {

				$fonts_link .= '<link href="http://fonts.googleapis.com/css?family=' . $font . '" rel="stylesheet" type="text/css">';

			}

		}

	}

	return $fonts_link;

}



/*-------------------------------------------------*/
/*	Estimated Reading Time
/*-------------------------------------------------*/

function ml_estimated_reading_time($content) {

	$word = str_word_count(strip_tags($content));

	$minutes = floor($word / 200);

	$ert = $minutes . ' min' . ($minutes == 1 ? '' : 's');

	return $ert;

}



/*-------------------------------------------------*/
/*	Custom Codes
/*-------------------------------------------------*/


/*--- Google Analytics Code ---*/

function ml_google_analytics() {

	if(of_get_option('ml-google-analytics'))
		echo of_get_option('ml-google-analytics');
	
}



/*--- Custom JS ---*/

function ml_custom_js() {

	if(of_get_option('ml-custom-js'))
		echo 
				'<script type="text/javascript">' .
					of_get_option('ml-custom-js') .
				'</script>';

}



/*--- Custom CSS ---*/

function ml_custom_css() {

	if(of_get_option('ml-custom-css'))
		echo 
				'<style type="text/css">' .
					of_get_option('ml-custom-css') .
				'</style>';

}



/*-------------------------------------------------*/
/* Video Alert
/*-------------------------------------------------*/

function ml_video_alert() {

	$bg_type = of_get_option('ml-bg-type', 'video');
	$m4v     = of_get_option('ml-m4v');
	$ogv     = of_get_option('ml-ogv');

	if($bg_type == 'video') {

		if(!isset($m4v) || trim($m4v)==='') _e('<h1 style="color:red">You need to upload your M4V video.</h1>', 'meydjer');
		if(!isset($ogv) || trim($ogv)==='') _e('<h1 style="color:red">You need to upload your OGV video.</h1>', 'meydjer');

	}

}



/*-------------------------------------------------*/
/*	Return Boolean
/*-------------------------------------------------*/

function ml_bool($val){

	if($val == '1') {
		return 'true';
	} else {
		return 'false';
	}

}



/*-------------------------------------------------*/
/* Search Content Stacker
/*-------------------------------------------------*/

function ml_search_cstacker($s) {

	global $wpdb;	

	$item_id =  $wpdb->get_results( 
		"
		SELECT post_id
		FROM $wpdb->postmeta
		WHERE meta_value
		LIKE '%$s%'
		"
	);

	$pages = '';

	foreach ($item_id as $key => $value) {

		$item_object = get_post( $value->post_id );

		if($item_object->post_type == 'ml_cstacker') {

			$item_parent = $item_object->post_parent;

			$page_object = get_post( $item_parent );

			if($page_object->post_type == 'page') {

				/*--- Level 1 ---*/

				$page_id = $page_object->ID;

			} else {

				/*--- Level 2 ---*/

				$page_id = $page_object->post_parent;
				
			}

			$pages .= $page_id . ',';

		}

	}

	$pages = substr($pages,0,-1);

	return $pages;

}