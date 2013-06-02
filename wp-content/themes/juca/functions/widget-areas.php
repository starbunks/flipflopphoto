<?php
$footer_columns = of_get_option('ml-footer_columns',0);

register_sidebar( array(
	'name'          => __('Social Icons Area', 'meydjer'),
	'id'            => 'ml-social',
	'before_widget' => '<li id="%1$s" class="widget %2$s">',
	'after_widget'  => '</li>',
	'before_title'  => '',
	'after_title'   => ''
) );

register_sidebar( array(
	'name'          => __('All', 'meydjer'),
	'id'            => 'ml-all',
	'before_widget' => '<li id="%1$s" class="widget %2$s">',
	'after_widget'  => '</li>',
	'before_title'  => '<h5 class="widgettitle">',
	'after_title'   => '</h5>'
) );

register_sidebar( array(
	'name'          => __('Portfolio', 'meydjer'),
	'id'            => 'ml-portfolio',
	'before_widget' => '<li id="%1$s" class="widget %2$s">',
	'after_widget'  => '</li>',
	'before_title'  => '<h5 class="widgettitle">',
	'after_title'   => '</h5>'
) );

register_sidebar( array(
	'name'          => __('Blog', 'meydjer'),
	'id'            => 'ml-blog',
	'before_widget' => '<li id="%1$s" class="widget %2$s">',
	'after_widget'  => '</li>',
	'before_title'  => '<h5 class="widgettitle">',
	'after_title'   => '</h5>'
) );

register_sidebar( array(
	'name'          => __('Pages', 'meydjer'),
	'id'            => 'ml-page',
	'before_widget' => '<li id="%1$s" class="widget %2$s">',
	'after_widget'  => '</li>',
	'before_title'  => '<h5 class="widgettitle">',
	'after_title'   => '</h5>'
) );

register_sidebar( array(
	'name'          => __('Middle Banner Area', 'meydjer'),
	'id'            => 'ml-middle-banner',
	'before_widget' => '<li id="%1$s" class="widget %2$s">',
	'after_widget'  => '</li>',
	'before_title'  => '<h5 class="widgettitle">',
	'after_title'   => '</h5>'
) );



/*--- Footer Widget Areas ---*/

for ($num = 1; $num <= $footer_columns; $num++) :

	register_sidebar( array(
		'name'          => __('Footer - #', 'meydjer') . $num,
		'id'            => 'ml-footer-' . $num,
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h5 class="widgettitle">',
		'after_title'   => '</h5>'
	) );

endfor;
