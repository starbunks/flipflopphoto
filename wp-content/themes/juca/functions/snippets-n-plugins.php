<?php
/*
 * Resize images dynamically using wp built in functions
 * Victor Teixeira
 *
 * php 5.2+
 *
 * Usage Example:
 * 
 * <?php 
 * $thumb = get_post_thumbnail_id(); 
 * $image = vt_resize( $thumb, '', 140, 110, true );
 * ?>
 * <img src="<?php echo $image[url]; ?>" width="<?php echo $image[width]; ?>" height="<?php echo $image[height]; ?>" />
 *
 * @param int $attach_id
 * @param string $img_url
 * @param int $width
 * @param int $height
 * @param bool $crop
 * @return array
 */
function vt_resize( $attach_id = null, $img_url = null, $width, $height, $crop = false ) {

	// this is an attachment, so we have the ID
	if ( $attach_id ) {
	
		$image_src = wp_get_attachment_image_src( $attach_id, 'full' );
		$file_path = get_attached_file( $attach_id );
	
	// this is not an attachment, let's use the image url
	} else if ( $img_url ) {
		
		$file_path = parse_url( $img_url );
		$file_path = $_SERVER['DOCUMENT_ROOT'] . $file_path['path'];
		
		//$file_path = ltrim( $file_path['path'], '/' );
		//$file_path = rtrim( ABSPATH, '/' ).$file_path['path'];
		
		$orig_size = getimagesize( $file_path );
		
		$image_src[0] = $img_url;
		$image_src[1] = $orig_size[0];
		$image_src[2] = $orig_size[1];
	}
	
	$file_info = pathinfo( $file_path );
	$extension = '.'. $file_info['extension'];

	// the image path without the extension
	$no_ext_path = $file_info['dirname'].'/'.$file_info['filename'];

	$cropped_img_path = $no_ext_path.'-'.$width.'x'.$height.$extension;

	// checking if the file size is larger than the target size
	// if it is smaller or the same size, stop right here and return
	if ( $image_src[1] > $width || $image_src[2] > $height ) {

		// the file is larger, check if the resized version already exists (for $crop = true but will also work for $crop = false if the sizes match)
		if ( file_exists( $cropped_img_path ) ) {

			$cropped_img_url = str_replace( basename( $image_src[0] ), basename( $cropped_img_path ), $image_src[0] );
			
			$vt_image = array (
				'url' => $cropped_img_url,
				'width' => $width,
				'height' => $height
			);
			
			return $vt_image;
		}

		// $crop = false
		if ( $crop == false ) {
		
			// calculate the size proportionaly
			$proportional_size = wp_constrain_dimensions( $image_src[1], $image_src[2], $width, $height );
			$resized_img_path = $no_ext_path.'-'.$proportional_size[0].'x'.$proportional_size[1].$extension;			

			// checking if the file already exists
			if ( file_exists( $resized_img_path ) ) {
			
				$resized_img_url = str_replace( basename( $image_src[0] ), basename( $resized_img_path ), $image_src[0] );

				$vt_image = array (
					'url' => $resized_img_url,
					'width' => $proportional_size[0],
					'height' => $proportional_size[1]
				);
				
				return $vt_image;
			}
		}

		// no cache files - let's finally resize it
		$new_img_path = image_resize( $file_path, $width, $height, $crop );
		$new_img_size = getimagesize( $new_img_path );
		$new_img = str_replace( basename( $image_src[0] ), basename( $new_img_path ), $image_src[0] );

		// resized output
		$vt_image = array (
			'url' => $new_img,
			'width' => $new_img_size[0],
			'height' => $new_img_size[1]
		);
		
		return $vt_image;
	}

	// default output - without resizing
	$vt_image = array (
		'url' => $image_src[0],
		'width' => $image_src[1],
		'height' => $image_src[2]
	);
	
	return $vt_image;
}



/*
* As of WP 3.1.1 addition of classes for css styling to parents of custom post types doesn't exist.
* We want the correct classes added to the correct custom post type parent in the wp-nav-menu for css styling and highlighting, so we're modifying each individually...
* The id of each link is required for each one you want to modify
* 
* http://wordpress.org/support/topic/why-does-blog-become-current_page_parent-with-custom-post-type#post-2207357
*/

// if(of_get_option('ml-port_menu', 'none') != 'none') {

// 	function remove_parent_classes($class) {

// 	  // check for current page classes, return false if they exist.
// 		return ($class == 'current_page_item' || $class == 'current_page_parent' || $class == 'current_page_ancestor'  || $class == 'current-menu-item') ? FALSE : TRUE;

// 	}

// 	function add_class_to_wp_nav_menu($classes) {

// 			$menu_item_id = of_get_option('ml-port_menu');

// 			switch (get_post_type()) {

// 		     	case 'ml_portfolio':

// 		     		// we're viewing a custom post type, so remove the 'current_page_xxx and current-menu-item' from all menu items.
// 		     		$classes = array_filter($classes, "remove_parent_classes");

// 		     		// add the current page class to a specific menu item (replace ###).
// 		     		if (in_array('menu-item-'.$menu_item_id, $classes)) {
// 		     		   $classes[] = 'current_page_parent';
// 		         }

// 		     		break;

// 					// add more cases if necessary and/or a default

// 			}

// 		return $classes;

// 	}

// 	add_filter('nav_menu_css_class', 'add_class_to_wp_nav_menu');

// }


/*-------------------------------------------------*/
/*	Search Cusotm Taxonomies
/* http://wordpress.stackexchange.com/a/5404/13717
/*-------------------------------------------------*/
function ml_search_where($where){

  global $wpdb;

  if (is_search()) {

	$the_search = ml_search_cstacker(get_search_query());


	$where .= "OR (t.name LIKE '%".get_search_query()."%' AND {$wpdb->posts}.post_status = 'publish') ";
	if(trim($the_search)) $where .= "OR $wpdb->posts.ID IN ($the_search) ";
  	
  }

  return $where;

}

function ml_search_join($join){
  global $wpdb;
  if (is_search())
    $join .= "LEFT JOIN {$wpdb->term_relationships} tr ON {$wpdb->posts}.ID = tr.object_id LEFT JOIN {$wpdb->term_taxonomy} tt ON tt.term_taxonomy_id=tr.term_taxonomy_id LEFT JOIN {$wpdb->terms} t ON t.term_id = tt.term_id";
  return $join;
}

function ml_search_groupby($groupby){
  global $wpdb;

  // we need to group on post ID
  $groupby_id = "{$wpdb->posts}.ID";
  if(!is_search() || strpos($groupby, $groupby_id) !== false) return $groupby;

  // groupby was empty, use ours
  if(!strlen(trim($groupby))) return $groupby_id;

  // wasn't empty, append ours
  return $groupby.", ".$groupby_id;
}

add_filter('posts_where','ml_search_where');
add_filter('posts_join', 'ml_search_join');
add_filter('posts_groupby', 'ml_search_groupby');



/*
Plugin Name: FixImageMargins
Plugin URI: #
Description: removes the silly 10px margin from the new caption based images
Author: Justin Adie
Version: 0.1.0
Author URI: http://rathercurious.net
*/
class fixImageMargins{
    public $xs = 0; //change this to change the amount of extra spacing

    public function __construct(){
        add_filter('img_caption_shortcode', array(&$this, 'fixme'), 10, 3);
    }
    public function fixme($x=null, $attr, $content){

        extract(shortcode_atts(array(
                'id'    => '',
                'align'    => 'alignnone',
                'width'    => '',
                'caption' => ''
            ), $attr));

        if ( 1 > (int) $width || empty($caption) ) {
            return $content;
        }

        if ( $id ) $id = 'id="' . $id . '" ';

    return '<div ' . $id . 'class="wp-caption ' . $align . '" style="width: ' . ((int) $width + $this->xs) . 'px">'
    . $content . '<p class="wp-caption-text">' . $caption . '</p></div>';
    }
}
$fixImageMargins = new fixImageMargins();



/*
Plugin Name: Multi-column Tag Map 
Plugin URI: http://tugbucket.net/wordpress/wordpress-plugin-multi-column-tag-map/
Description: Multi-column Tag Map display a columnized, alphabetical, expandable and toggleable listing of all tags used in your site.
Version: 3.0
Author: Alan Jackson
Author URI: http://tugbucket.net
*/

/*  Copyright 2009  Alan Jackson (alan[at]tugbucket.net)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

function wp_mcTagMap($options='') {

	$ns_options = array(
                    "columns" => "2",
                    "more" => "View More",
					"hide" => "no",
					"num_show" => "5",
					"toggle" => "no",
					"show_empty" => "yes",
                   );
			
	if(strpos($options, '|')) {		   
	$options = explode("|",$options);
	} else {
	$options = explode("&",$options);
	}
	
	foreach ($options as $option) {
	
		$parts = explode("=",$option);
		$options[$parts[0]] = $parts[1];
	
	}

	if ($options['columns']) {
	$ns_options['columns'] = $options['columns'];
	} else {
	$options['columns'] = 2;
	}
	
    if ($options['more']) {
	$ns_options['more'] = htmlentities($options['more'], ENT_QUOTES);
	} else {
	$options['more'] = "View more";
	}
	
    if ($options['hide']) {
	$ns_options['hide'] = $options['hide'];
	} else {
	$options['hide'] = "no";
	}
	
    if ($options['num_show']) {
	$ns_options['num_show'] = $options['num_show'];
	} else {
	$options['num_show'] = 5;
	}
	
	if ($options['toggle']) {
	$ns_options['toggle'] = $options['toggle'];
	} else {
	$options['toggle'] = "no";
	}
	
	if ($options['show_empty']) {
	$ns_options['show_empty'] = $options['show_empty'];
	} else {
	$options['show_empty'] = "yes";
	}
	
	$show_empty = $options['show_empty'];
	if($show_empty == "yes"){
		$show_empty = "0";
	}
	if($show_empty == "no"){
		$show_empty = "1";
	}
    $list = '<!-- begin list --><div id="mcTagMap">';
	$tags = get_terms('post_tag', 'order=ASC&hide_empty='.$show_empty.''); // new code!
	$groups = array();
	
	
	
	if( $tags && is_array( $tags ) ) {
		foreach( $tags as $tag ) {
			$first_letter = strtoupper( $tag->name[0] );
			$groups[ $first_letter ][] = $tag;
		}
	if( !empty ( $groups ) ) {	
		$count = 0;
		$howmany = count($groups);
		
		// this makes 2 columns
		if ($options['columns'] == 2){
		$firstrow = ceil($howmany * 0.5);
	    $secondrow = ceil($howmany * 1);
	    $firstrown1 = ceil(($howmany * 0.5)-1);
	    $secondrown1 = ceil(($howmany * 1)-0);
		}
		
		
		//this makes 3 columns
		if ($options['columns'] == 3){
	    $firstrow = ceil($howmany * 0.33);
	    $secondrow = ceil($howmany * 0.66);
	    $firstrown1 = ceil(($howmany * 0.33)-1);
	    $secondrown1 = ceil(($howmany * 0.66)-1);
		}
		
		//this makes 4 columns
		if ($options['columns'] == 4){
	    $firstrow = ceil($howmany * 0.25);
	    $secondrow = ceil(($howmany * 0.5)+1);
	    $firstrown1 = ceil(($howmany * 0.25)-1);
	    $secondrown1 = ceil(($howmany * 0.5)-0);
		$thirdrow = ceil(($howmany * 0.75)-0);
	    $thirdrow1 = ceil(($howmany * 0.75)-1);
		}
		
		//this makes 5 columns
		if ($options['columns'] == 5){
	    $firstrow = ceil($howmany * 0.2);
	    $firstrown1 = ceil(($howmany * 0.2)-1);
	    $secondrow = ceil(($howmany * 0.4));
		$secondrown1 = ceil(($howmany * 0.4)-1);
		$thirdrow = ceil(($howmany * 0.6)-0);
	    $thirdrow1 = ceil(($howmany * 0.6)-1);
		$fourthrow = ceil(($howmany * 0.8)-0);
	    $fourthrow1 = ceil(($howmany * 0.8)-1);
		}
		
		foreach( $groups as $letter => $tags ) { 
			if ($options['columns'] == 2){
			if ($count == 0 || $count == $firstrow || $count ==  $secondrow) { 
			    if ($count == $firstrow){
				$list .= "\n<div class='ml-tag-index-grid ml-tag-index-no-margin'>\n";
				$list .="\n";
				} else {
				$list .= "\n<div class='ml-tag-index-grid'>\n";
				$list .="\n";
				}
				}
				}
			if ($options['columns'] == 3){
			if ($count == 0 || $count == $firstrow || $count ==  $secondrow) { 
			    if ($count == $secondrow){
				$list .= "\n<div class='ml-tag-index-grid ml-tag-index-grid'>\n";
				$list .="\n";
				} else {
				$list .= "\n<div class='ml-tag-index-grid'>\n";
				$list .="\n";
				}
				}
				}
			if ($options['columns'] == 4){				
			if ($count == 0 || $count == $firstrow || $count ==  $secondrow || $count == $thirdrow) { 
			    if ($count == $thirdrow){
				$list .= "\n<div class='ml-tag-index-grid ml-tag-index-no-margin'>\n";
				$list .="\n";
				} else {
				$list .= "\n<div class='ml-tag-index-grid'>\n";
				$list .="\n";
				}
				}
				}
			if ($options['columns'] == 5){
			if ($count == 0 || $count == $firstrow || $count ==  $secondrow || $count == $thirdrow || $count == $fourthrow ) { 
			    if ($count == $fourthrow){
				$list .= "\n<div class='ml-tag-index-grid ml-tag-index-no-margin'>\n";
				$list .="\n";
				} else {
				$list .= "\n<div class='ml-tag-index-grid'>\n";
				$list .="\n";
				}
				}
				}
		
    $list .= '<div class="ml-tag-index-block">';
	$list .="\n";
	$list .= '<h5 class="ml-tag-index-title">' . apply_filters( 'the_title', $letter ) . '</h5>';
	$list .="\n";
	$list .= '<ul class="ml-tag-index-links">';
	$list .="\n";			
	$i = 0;
	foreach( $tags as $tag ) {
		$url = esc_attr( get_tag_link( $tag->term_id ) );
		$name = apply_filters( 'the_title', $tag->name );
	//	$name = ucfirst($name);
		$i++;
		$counti = $i;
		if ($options['hide'] == "yes"){
		$num2show = $options['num_show'];
		$num2show1 = ($options['num_show'] +1);
		$toggle = ($options['toggle']);
		
		if ($i != 0 and $i <= $num2show) {
			$list .= '<li><a title="' . $name . '" href="' . $url . '">' . $name . '</a></li>';
			$list .="\n";
			}
		if ($i > $num2show && $i == $num2show1 && $toggle == "no") {
			$list .=  "<li class=\"morelink\">"."<a href=\"#x\" class=\"more\">".$options['more']."</a>"."</li>"."\n";
			}
		if ($i >= $num2show1){
               $list .= '<li class="hideli"><a title="' . $name . '" href="' . $url . '">' . $name . '</a></li>';
			   $list .="\n";
		}
		} else {
			$list .= '<li><a title="' . $name . '" href="' . $url . '">' . $name . '</a></li>';
			$list .="\n";
		}	
		
	} 
		if ($options['hide'] == "yes" && $toggle != "no" && $i == $counti && $i > $num2show) {
			$list .=  "<li class=\"morelink\">"."<a href=\"#x\" class=\"more\">".$options['more']."</a>"."<a href=\"#x\" class=\"less\">".$options['toggle']."</a>"."</li>"."\n";
		}	 
	$list .= '</ul>';
	$list .="\n";
	$list .= '</div>';
	$list .="\n\n";
		if ($options['columns'] == 3 || $options['columns'] == 2){
		if ( $count == $firstrown1 || $count == $secondrown1) { 
			$list .= "</div>"; 
			}	
			}
		if ($options['columns'] == 4){
		if ( $count == $firstrown1 || $count == $secondrown1 || $count == $thirdrow1) { 
			$list .= "</div>"; 
			}	
			}
		if ($options['columns'] == 5){		
		if ( $count == $firstrown1 || $count == $secondrown1 || $count == $thirdrow1 || $count == $fourthrow1) { 
			$list .= "</div>"; 
			}	
			}
				 
		$count++;
			} 
		} 
	$list .="</div>";
	$list .= "<div style='clear: both;'></div></div><!-- end list -->";
		}
	else $list .= '<p>Sorry, but no tags were found</p>';

print $list ;

}
// end long code


// short code begins
function sc_mcTagMap($atts, $content = null) {
        extract(shortcode_atts(array(
                    "columns" => "2",
                    "more" => "View More",
					"hide" => "no",
					"num_show" => "5",
					"toggle" => "no",
					"show_empty" => "yes",
        ), $atts));

				   

	if($show_empty == "yes"){
		$show_empty = "0";
	}
	if($show_empty == "no"){
		$show_empty = "1";
	}


    $list = '<!-- begin list --><div id="mcTagMap">';
	$tags = get_terms('post_tag', 'order=ASC&hide_empty='.$show_empty.''); // new code!
	$groups = array();
	if( $tags && is_array( $tags ) ) {
		foreach( $tags as $tag ) {
			$first_letter = strtoupper( $tag->name[0] );
			$groups[ $first_letter ][] = $tag;
		}
	if( !empty ( $groups ) ) {	
		$count = 0;
		$howmany = count($groups);
		
		// this makes 2 columns
		if ($columns == 2){
		$firstrow = ceil($howmany * 0.5);
	    $secondrow = ceil($howmany * 1);
	    $firstrown1 = ceil(($howmany * 0.5)-1);
	    $secondrown1 = ceil(($howmany * 1)-0);
		}
		
		
		//this makes 3 columns
		if ($columns == 3){
	    $firstrow = ceil($howmany * 0.33);
	    $secondrow = ceil($howmany * 0.66);
	    $firstrown1 = ceil(($howmany * 0.33)-1);
	    $secondrown1 = ceil(($howmany * 0.66)-1);
		}
		
		//this makes 4 columns
		if ($columns == 4){
	    $firstrow = ceil($howmany * 0.25);
	    $secondrow = ceil(($howmany * 0.5)+1);
	    $firstrown1 = ceil(($howmany * 0.25)-1);
	    $secondrown1 = ceil(($howmany * 0.5)-0);
		$thirdrow = ceil(($howmany * 0.75)-0);
	    $thirdrow1 = ceil(($howmany * 0.75)-1);
		}
		
		//this makes 5 columns
		if ($columns == 5){
	    $firstrow = ceil($howmany * 0.2);
	    $firstrown1 = ceil(($howmany * 0.2)-1);
	    $secondrow = ceil(($howmany * 0.4));
		$secondrown1 = ceil(($howmany * 0.4)-1);
		$thirdrow = ceil(($howmany * 0.6)-0);
	    $thirdrow1 = ceil(($howmany * 0.6)-1);
		$fourthrow = ceil(($howmany * 0.8)-0);
	    $fourthrow1 = ceil(($howmany * 0.8)-1);
		}
		
		foreach( $groups as $letter => $tags ) { 
			if ($columns == 2){
			if ($count == 0 || $count == $firstrow || $count ==  $secondrow) { 
			    if ($count == $firstrow){
				$list .= "\n<div class='holdleft noMargin'>\n";
				$list .="\n";
				} else {
				$list .= "\n<div class='holdleft'>\n";
				$list .="\n";
				}
				}
				}
			if ($columns == 3){
			if ($count == 0 || $count == $firstrow || $count ==  $secondrow) { 
			    if ($count == $secondrow){
				$list .= "\n<div class='holdleft noMargin'>\n";
				$list .="\n";
				} else {
				$list .= "\n<div class='holdleft'>\n";
				$list .="\n";
				}
				}
				}
			if ($columns == 4){				
			if ($count == 0 || $count == $firstrow || $count ==  $secondrow || $count == $thirdrow) { 
			    if ($count == $thirdrow){
				$list .= "\n<div class='holdleft noMargin'>\n";
				$list .="\n";
				} else {
				$list .= "\n<div class='holdleft'>\n";
				$list .="\n";
				}
				}
				}
			if ($columns == 5){
			if ($count == 0 || $count == $firstrow || $count ==  $secondrow || $count == $thirdrow || $count == $fourthrow ) { 
			    if ($count == $fourthrow){
				$list .= "\n<div class='holdleft noMargin'>\n";
				$list .="\n";
				} else {
				$list .= "\n<div class='holdleft'>\n";
				$list .="\n";
				}
				}
				}
		
    $list .= '<div class="ml-tag-index">';
	$list .="\n";
	$list .='<h4>' . apply_filters( 'the_title', $letter ) . '</h4>';
	$list .="\n";
	$list .= '<ul class="links">';
	$list .="\n";			
	$i = 0;
	foreach( $tags as $tag ) {
		$url = esc_attr( get_tag_link( $tag->term_id ) );
		$name = apply_filters( 'the_title', $tag->name );
	//	$name = ucfirst($name);

		$i++;
		$counti = $i;
		if ($hide == "yes"){
		$num2show = $num_show;
		$num2show1 = ($num_show +1);
		//$toggle = ($options['toggle']);
		if ($i != 0 and $i <= $num2show) {
			$list .= '<li><a title="' . $name . '" href="' . $url . '">' . $name . '</a></li>';
			$list .="\n";
			}
		if ($i > $num2show && $i == $num2show1 && $toggle == "no") {
			$list .=  "<li class=\"morelink\">"."<a href=\"#x\" class=\"more\">".$more."</a>"."</li>"."\n";
			}
		if ($i >= $num2show1){
               $list .= '<li class="hideli"><a title="' . $name . '" href="' . $url . '">' . $name . '</a></li>';
			   $list .="\n";
		}
		} else {
			$list .= '<li><a title="' . $name . '" href="' . $url . '">' . $name . '</a></li>';
			$list .="\n";
		}		
		
	}
		if ($hide == "yes" && $toggle != "no" && $i == $counti && $i > $num2show) {
			$list .=  "<li class=\"morelink\">"."<a href=\"#x\" class=\"more\">".$more."</a>"."<a href=\"#x\" class=\"less\">".$toggle."</a>"."</li>"."\n";
		}	 
		 
	$list .= '</ul>';
	$list .="\n";
	$list .= '</div>';
	$list .="\n\n";
		if ($columns == 3 || $columns == 2){
		if ( $count == $firstrown1 || $count == $secondrown1) { 
			$list .= "</div>"; 
			}	
			}
		if ($columns == 4){
		if ( $count == $firstrown1 || $count == $secondrown1 || $count == $thirdrow1) { 
			$list .= "</div>"; 
			}	
			}
		if ($columns == 5){		
		if ( $count == $firstrown1 || $count == $secondrown1 || $count == $thirdrow1 || $count == $fourthrow1) { 
			$list .= "</div>"; 
			}	
			}
				 
		$count++;
			} 
		} 
	$list .="</div>";
	$list .= "<div style='clear: both;'></div></div><!-- end list -->";
		}
	else $list .= '<p>Sorry, but no tags were found</p>';

return $list;

}

add_shortcode("mctagmap", "sc_mcTagMap");
// end shortcode


// the JS and CSS
add_action('wp_head', 'mcTagMapCSSandJS');
function mcTagMapCSSandJS()
{
$toggle = 'no';
if ($toggle == "no"){
// echo '<link rel="stylesheet" href="'.get_template_directory_uri().'/css/mctagmap.css" type="text/css" media="screen" />';
echo "\n\n";
echo "<script type=\"text/javascript\">
jQuery(document).ready(function() { 
  jQuery('ul.links li.hideli').hide();
  jQuery('ul.links li.morelink').show();
  jQuery('a.more').click(function() {
	jQuery(this).parent().siblings('li.hideli').slideToggle('fast');
	 jQuery(this).parent('li.morelink').remove();
  });
});
</script>\n\n";
}
if ($toggle != "no"){
echo '<link rel="stylesheet" href="'.WP_PLUGIN_URL.'/multi-column-tag-map/mctagmap.css" type="text/css" media="screen" />';
echo "\n\n";
echo "<script type=\"text/javascript\">
jQuery(document).ready(function() { 
  jQuery('a.less').hide();
  jQuery('ul.links li.hideli').hide();
  jQuery('ul.links li.morelink').show();
  jQuery('a.more').click(function() {
	jQuery(this).parent().siblings('li.hideli').slideToggle('fast');
	 jQuery(this).parent('li.morelink').children('a.less').show();
	 jQuery(this).hide();
  });
    jQuery('a.less').click(function() {
	jQuery(this).parent().siblings('li.hideli').slideToggle('fast');
	 jQuery(this).parent('li.morelink').children('a.more').show();
	 jQuery(this).hide();
  });
});
</script>\n\n";
}
}