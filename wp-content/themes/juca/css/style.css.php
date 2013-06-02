<?php 

/*--- Make it a CSS file ---*/
header("Content-type: text/css");

/*--- Load WordPress ---*/
if(file_exists('../../../../wp-load.php')) {
	include '../../../../wp-load.php';
} else {
	include '../../../../../wp-load.php';
}


/*-------------------------------------------------*/
/*	Options from Theme Customizer
/*-------------------------------------------------*/

// main palette
$ml_custom_primary_main_color = get_theme_mod( 'ml_custom_primary_main_color', '#0D121A');
$ml_custom_primary_text_color = get_theme_mod('ml_custom_primary_text_color', '#ECEFF5');
$ml_custom_primary_details_color = get_theme_mod('ml_custom_primary_details_color', '#616B7C');
// secondary palette
$ml_custom_secondary_main_color = get_theme_mod('ml_custom_secondary_main_color', '#0ab58a');
$ml_custom_secondary_text_color = get_theme_mod('ml_custom_secondary_text_color', '#fff');
$ml_custom_secondary_details_color = get_theme_mod('ml_custom_secondary_details_color', '#08906E');
// tertiary palette
$ml_custom_tertiary_main_color = get_theme_mod('ml_custom_tertiary_main_color', '#000000');
$ml_custom_tertiary_text_color = get_theme_mod('ml_custom_tertiary_text_color', '#fff');

?>

/*-------------------------------------------------*/
/* 1. General
/* 2. Header
/* 3. Footer
/* 4. Content
/* 5. Portfolio Items
/* 6. Blog
/* 7. Sidebar & Widgets
/*-------------------------------------------------*/



/*-------------------------------------------------*/
/*  1. GENERAL
/*-------------------------------------------------*/


body {
	background: #000 url(../images/ajax-loader.gif) no-repeat center 45px;
	color: <?php echo $ml_custom_primary_text_color ?>;
	font-family: 'Droid Sans', sans-serif;
	min-height: 100%;
	position: relative;
}

p,
.ml-entry-text {
	color: <?php echo $ml_custom_primary_text_color ?>;
}

strong {
	font-weight: 700;
}

a {
	color: <?php echo $ml_custom_secondary_main_color ?>;
}

a {
	text-decoration: none;
}

a:hover {
	text-decoration: underline;
}

blockquote {
	font-size: 1.35em;
	font-style: italic;
	margin: 1em 0;
	position: relative;
	text-align: left;
}

blockquote p {
	margin: 0;
}

blockquote:before {
	content: "\201C";
	left: -.6em;
	position: absolute;
	top: 0;
}

.ml-wrapper {
	margin: 0 auto;
	max-width: 1160px;
	padding: 0 3.96825396%;
}


/*--- Grid ---*/

.ml-grid {
	float: left;
	margin-left:5%;
}

.ml-grid.ml-first {
	margin-left:0;
}

.ml-grid.ml-one_full {
	margin-left:0;
	width:100%;
}
.ml-grid.ml-one_half {
	width:47.5%;
}
.ml-grid.ml-one_third {
	width:30%;
}
.ml-grid.ml-two_third {
	width:65%;
}
.ml-grid.ml-one_fourth {
	width:21.25%;
}
.ml-grid.ml-three_fourth {
	width:73.75%;
}


/*--- Forms ---*/

.wpcf7-quiz,
.wpcf7-captchar,
.wpcf7-text,
.wpcf7-textarea,
.input-text,
.input-textarea {
	background-color: <?php echo $ml_custom_primary_main_color ?>;
	border: 2px solid <?php echo $ml_custom_primary_details_color ?>;
	border-radius: 25px;
		-webkit-border-radius: 25px;
		-moz-border-radius: 25px;
		-ms-border-radius: 25px;
		-o-border-radius: 25px;
	color: <?php echo $ml_custom_primary_text_color ?>;
	font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
	padding: .75em 1em;
}

.input-text:invalid,
.input-textarea:invalid {
	background-color: inherit;
	border-color: red;
}


	.wpcf7-quiz:focus,
	.wpcf7-captchar:focus,
	.wpcf7-text:focus,
	.wpcf7-textarea:focus,
	.input-text:focus,
	.input-textarea:focus {
		outline: 0 none;
	}

	.wpcf7-quiz:hover,
	.wpcf7-quiz:focus,
	.wpcf7-captchar:hover,
	.wpcf7-captchar:focus,
	.wpcf7-text:hover,
	.wpcf7-text:focus,
	.wpcf7-textarea:hover,
	.wpcf7-textarea:focus,
	.input-text:hover,
	.input-text:focus,
	.input-textarea:hover,
	.input-textarea:focus {
		border-color: <?php echo $ml_custom_secondary_main_color ?>;
	}

	.wpcf7-quiz,
	.wpcf7-quiz:hover,
	.wpcf7-captchar,
	.wpcf7-captchar:hover,
	.wpcf7-text,
	.wpcf7-text:hover,
	.wpcf7-textarea,
	.wpcf7-textarea:hover,
	.input-text,
	.input-text:hover,
	.input-textarea,
	.input-textarea:hover {
		transition: border-color 0.15s ease-in-out;
			-webkit-transition: border-color 0.15s ease-in-out;
			-moz-transition: border-color 0.15s ease-in-out;
			-ms-transition: border-color 0.15s ease-in-out;
			-o-transition: border-color 0.15s ease-in-out;
	}

	.wpcf7-file {
		color: <?php echo $ml_custom_primary_details_color ?>;
	}

	.wpcf7-captchac {
		margin: .5em 0 1em;
	}

	.wpcf7-title {
		font-size: .83em;
		font-weight:bold;
		font-weight:700;
	}

	.wpcf7-title-with-input {
		margin: 0 0 0 1.25em;
	}

	.wpcf7-form-control .wpcf7-list-item:first-child {
		margin-left:0
	}

	.wpcf7-captchac {
		float: left;
		margin: 1.85em 1em 0 0;
	}

	.wpcf7-captchar {
		float: left;
		width: 50%;
	}



/*--- Video Background ---*/

.ml-video-bg-wrapper {
	left: 0;
	position: fixed;
	top: 0;
	z-index: -1;
}

.ml-video-bg,
.ml-video-bg img,
.ml-video-bg video,
.ml-video-bg object {
	height: 100% !important;
	width: 100% !important;
}


/*--- Images Background ---*/

.ml-sldbg {
	position: absolute;
	z-index: -1;
}

.ml-sldbg-item {
	opacity: 0;
		filter: alpha(opacity = 0);
}

.ml-sldbg-item img {
	max-width: none;
	position: fixed;
}


/*--- General Divs ---*/

.ml-main-content {
	float: left;
	width: 65%;
}

.ml-sidebar-content {
	float: right;
	width: 30%;
}


/*--- Other ---*/

.ml-center-text {
	text-align: center;
}

.ml-right-text {
	text-align: right;
}



/*-------------------------------------------------*/
/*	2. HEADER
/*-------------------------------------------------*/

.ml-header {
	background-color: <?php echo $ml_custom_primary_main_color ?> ;
	box-shadow: rgba(0, 0, 0, .2) 0 4px 0;
	display: inline-block;
	width: 100%;
}
	.ml-animated-header .ml-header {
		position: absolute;
		left: 0px;
		top: 0px;
	}

.ml-header-clear {
	display: none;
}

.ml-head-menu {
	list-style: none;
	margin: 0;
	padding: 0;
}

.ml-head-menu li {
	float: left;
}

.ml-select-menu {
	display: none;
}

.ml-h-bar {
	background-color: <?php echo $ml_custom_primary_main_color ?>;
	box-shadow: rgba(0, 0, 0, .2) 0 4px 0;
	display: inline-block;
	height: 12px;
	margin-bottom: .5em;
	width: 100%;
}


.ml-h-arrow {
	color: <?php echo $ml_custom_primary_main_color ?>;
	cursor: default;
	display: none;
	font-family: 'MLThemeIcons';
	font-size:18px;
	line-height: 1em;
	margin-bottom: 2em;
	text-align: center;
	width: 100%;
}
	.ml-animated-header .ml-h-arrow {
		display: inline-block;
	}


/*--- Menu ---*/

.ml-head-menu li {
	text-align: left;
	position: relative;
}

.ml-head-menu li a {
	color: <?php echo $ml_custom_primary_text_color ?>;
	float: left;
	font-family: 'Droid Sans', sans-serif;
	font-size: .875em; /* 14/16px */
	font-weight: 700;
	letter-spacing: .1em;
	padding: 1.42857142857143em 1.42857142857143em 1.14285714285714em;
	text-decoration: none;
	text-transform: uppercase;
}

.ml-head-menu > li > a {
	border-bottom: 4px solid <?php echo $ml_custom_primary_main_color ?>;
}

.ml-head-menu > li.current-menu-item > a,
.ml-head-menu > li > a:hover,
.ml-head-menu > li.ml-active > a {
	border-bottom-color: <?php echo $ml_custom_secondary_main_color ?>;
}

.ml-head-menu ul {
	background-color: <?php echo $ml_custom_primary_main_color ?>;
	display: none;
	left: 0;
	list-style: none;
	margin:0;
	padding: 0;
	position: absolute;
	top: 59px;
	width: 200px;
	z-index: 90;
}

.ml-head-menu ul ul {
	left: 196px;
	top:0;
}

.ml-head-menu ul li {
	border-left: 4px solid <?php echo $ml_custom_secondary_main_color ?>;
	width: 100%;
}

.ml-head-menu ul > li.sfHover,
.ml-head-menu ul > li:hover {
	border-left-color: <?php echo $ml_custom_primary_text_color ?>;
}

.ml-head-menu ul li a {
	text-transform: none;
	padding-left: 15px;
	padding-right: 15px;
	width: 170px;
}

.ml-head-menu .sfHover ul {
	display: block;
	visibility: visible;
}

.ml-head-menu li a,
.ml-head-menu li a:hover,
.ml-head-menu ul li,
.ml-head-menu ul li:hover {
	transition: border-color 0.1s ease-in-out;
		-webkit-transition: border-color 0.1s ease-in-out;
		-moz-transition: border-color 0.1s ease-in-out;
		-ms-transition: border-color 0.1s ease-in-out;
		-o-transition: border-color 0.1s ease-in-out;
}


/*--- Social ---*/

.ml-social {
	float: right;
	list-style: none;
	margin: 0;
	padding: 0;
}

.ml-social li {
	float: left;
}

.ml-social li a {
	color: <?php echo $ml_custom_primary_text_color ?>;
	float: left;
	font-family: 'MLSocialIcons';
	font-size: 18px;
	padding: .95em;
	text-decoration: none;
}

.ml-social li a:hover {
	color: <?php echo $ml_custom_secondary_main_color ?>;
}

.ml-social li a,
.ml-social li a:hover {
	transition: color 0.1s ease-in-out;
		-webkit-transition: color 0.1s ease-in-out;
		-moz-transition: color 0.1s ease-in-out;
		-ms-transition: color 0.1s ease-in-out;
		-o-transition: color 0.1s ease-in-out;
}


/*--- Logo ---*/

.ml-logo {
	margin: 2.5em 0;
	text-align: center
}
	.ml-animated-header .ml-logo {
		margin-top: 0;
	}



/*-------------------------------------------------*/
/*	3. FOOTER
/*-------------------------------------------------*/

.ml-footer {
	margin: 4em 0;
}

.ml-copy {
	color: <?php echo $ml_custom_tertiary_text_color ?>;
	font-family: 'Droid Serif', serif;
	font-size: .75em; /* 12/16px */
	text-align: center;
}

.ml-copy a {
	color: <?php echo $ml_custom_tertiary_text_color ?>;
	text-decoration: underline;
}
	.ml-copy a:hover {
		text-decoration: none;
	}

.ml-footer-widget {
	color: white;
	list-style: none;
	margin: 0;
	padding: 0;
}

.ml-footer-widget .widgettitle {
	font-size: 1.25em;
	letter-spacing: .08em;
	text-transform: uppercase;
	width: 100%;
	word-spacing: .1em;
}




/*-------------------------------------------------*/
/*	4. CONTENT
/*-------------------------------------------------*/


/*--- Welcome ---*/

.ml-wlcm {
	background-color: <?php echo $ml_custom_primary_main_color ?>;
	color: <?php echo $ml_custom_primary_text_color ?>;
	font-family: 'Droid Serif', serif;
	font-size: 1.5em; /* 24/16px */
	font-style: italic;
	line-height: 1.5em;
	margin-bottom: 1.5em;
	padding: 1em 0;
	position: relative;
	text-align: center;
	text-shadow: rgba(0, 0, 0, .3) -3px 3px 0;
}

.ml-wlcm-top {
	border-bottom: 1px solid <?php echo $ml_custom_primary_main_color ?>;
	border-top: 1px solid rgba(0,0,0,.1);
	content:"";
	display: block;
	height: 2px;
	left: 0;
	position: absolute;
	top:-5px;
	width: 100%;
}

.ml-wlcm-bottom {
	border-bottom: 1px solid rgba(0,0,0,.1);
	border-top: 1px solid <?php echo $ml_custom_primary_main_color ?>;
	display: block;
	height: 2px;
	left: 0;
	position: absolute;
	bottom:-5px;
	width: 100%;
}

.ml-welc-cont {
	display: none;
}
	.ml-welc-cont:first-child {
		display: block;
	}


/*--- Filter ---*/

.ml-filter {
	background-image: url(../images/black70.png);
		background: <?php echo ml_hexToRGBA($ml_custom_tertiary_main_color, .7) ?>;
	box-shadow: rgba(0, 0, 0, .3) 0 -2px 3px inset, rgba(0, 0, 0, .3) 0 2px 3px inset;
		-webkit-box-shadow: rgba(0, 0, 0, .3) 0 -2px 3px inset, rgba(0, 0, 0, .3) 0 2px 3px inset;
		-moz-box-shadow: rgba(0, 0, 0, .3) 0 -2px 3px inset, rgba(0, 0, 0, .3) 0 2px 3px inset;
	margin-bottom: 2.5em;
	text-align: center;
	padding: 1.25em 0;
}

.ml-filters {
	list-style: none;
	margin: 0;
	padding: 0;
}

.ml-filters li {
	display: inline;
	line-height: 400%;
}

.ml-filters li a {
	background-color: <?php echo $ml_custom_primary_main_color ?>;
	border-radius: 99px;
	box-shadow: rgba(0, 0, 0, .2) 0 2px 2px;
		-webkit-box-shadow: rgba(0, 0, 0, .2) 0 2px 2px;
		-moz-box-shadow: rgba(0, 0, 0, .2) 0 2px 2px;
	color: <?php echo $ml_custom_primary_text_color ?>;
	font-family: 'Droid Sans', sans-serif;
	font-size: .875em; /* 14/16px */
	font-weight: 700;
	margin: 0 .5em;
	padding: 1em 1.5em;
	position: relative;
	text-decoration: none;
}

.ml-filters li a:hover,
.ml-filters li a.ml-selected {
	background-color: <?php echo $ml_custom_secondary_main_color ?>;
	color: <?php echo $ml_custom_secondary_text_color ?>;
}

.ml-filters li a,
.ml-filters li a:hover {
	transition: background-color 0.15s ease-in-out;
		-webkit-transition: background-color 0.15s ease-in-out;
		-moz-transition: background-color 0.15s ease-in-out;
		-ms-transition: background-color 0.15s ease-in-out;
		-o-transition: background-color 0.15s ease-in-out;
}

.ml-flt-arr {
	bottom: -1.44em;
	color: <?php echo $ml_custom_secondary_main_color ?>;
	display: none;
	font-family: 'MLThemeIcons';
	font-size: 1.75em;
	left: 50%;
	margin-left: -.5em;
	text-shadow: rgba(0, 0, 0, .2) 0 2px 2px;
	position: absolute;
}
	.lt-ie9 .ml-flt-arr {
		bottom:-1.4em;
	}

.ml-selected .ml-flt-arr {
	display: block;
}
	.opera .ml-selected .ml-flt-arr {
		display: none;
	}


/*--- Portfolio Grid ---*/

.ml-port-block {
	margin-bottom: 2.5em;
	margin-left: -1.515151515%;
	padding-bottom: .5em;
	width: 103.448275%;
}

.ml-4cols .ml-glare,
.ml-4cols .ml-pthumb {
	height: 260px;
	width: 260px;
}

.ml-glare,
.ml-pthumb,
.ml-pthumb-img {
	-webkit-border-radius: 12px;
	-moz-border-radius: 12px;
	-ms-border-radius: 12px;
	border-radius: 12px;
}

.ml-pthumb {
	background: #000 url(../images/ajax-loader.gif) no-repeat center center;
	box-shadow:
		#000 0 4px 30px;
		-webkit-box-shadow:
			#000 0 4px 30px;
		-moz-box-shadow:
			#000 0 4px 30px;
	float: left;
	margin: 1.25em;
	overflow: hidden;
	position: relative;
}
	.ml-pthumb:hover {
		box-shadow:
			#000 0 4px 20px;
			-webkit-box-shadow:
				#000 0 4px 20px;
			-moz-box-shadow:
				#000 0 4px 20px;
	}

.ml-glare {
	background: url(../images/glare.png) no-repeat right top;
	box-shadow: rgba(255,255,255,.6) 0 1px 0 inset;
		-webkit-box-shadow: rgba(255,255,255,.6) 0 1px 0 inset;
		-moz-box-shadow: rgba(255,255,255,.6) 0 1px 0 inset;
	left: 0px;
	position: absolute;
	opacity: 0.5;
		filter: alpha(opacity = 50);
	top:0px;
}
	.ml-glare:hover {
		opacity: 1;
			filter: alpha(opacity = 100);
	}
	.ml-glare,
	.ml-glare:hover {
		transition: opacity 0.15s ease-in-out;
			-webkit-transition: opacity 0.15s ease-in-out;
			-moz-transition: opacity 0.15s ease-in-out;
			-ms-transition: opacity 0.15s ease-in-out;
			-o-transition: opacity 0.15s ease-in-out;
	}
	.lt-ie9 .ml-glare {
		display: none;
	}

.ml-pthumb-img {
	left: 0px;
	position: absolute;
	top: 0px;
}

.ml-pthumb-title {
	background-image: url(../images/black70.png);
		background-image: -webkit-gradient(linear, 0% 0%, 100% 100%, color-stop(0%, rgba(0,0,0,.5)), color-stop(100%, rgba(0,0,0,.9)));
		background-image: -webkit-linear-gradient(rgba(0,0,0,.5), rgba(0,0,0,.9));
		background-image: -moz-linear-gradient(rgba(0,0,0,.5), rgba(0,0,0,.9));
		background-image: -ms-linear-gradient(rgba(0,0,0,.5), rgba(0,0,0,.9));
		background-image: -o-linear-gradient(rgba(0,0,0,.5), rgba(0,0,0,.9));
		background-image: linear-gradient(rgba(0,0,0,.5), rgba(0,0,0,.9));
	border-bottom-left-radius: 10px;
		-webkit-border-radius-bottom-left: 10px;
		-moz-border-radius-bottomleft: 10px;
	border-bottom-right-radius: 10px;
		-webkit-border-radius-bottom-right: 10px;
		-moz-border-radius-bottomright: 10px;
	bottom:0px;
	box-shadow: rgba(255,255,255,.11) 0 1px 0 inset, rgba(0,0,0,.47) 0 -1px 1px;
		-webkit-box-shadow: rgba(255,255,255,.11) 0 1px 0 inset, rgba(0,0,0,.47) 0 -1px 1px;
		-moz-box-shadow: rgba(255,255,255,.11) 0 1px 0 inset, rgba(0,0,0,.47) 0 -1px 1px;
	color: white;
	font-family: 'Droid Serif', serif;
	font-style: italic;
	font-size: 24px;
	left: 0px;
	text-align: center;
	text-shadow:#000 0 2px 4px;
	padding: .5em 0;
	position: absolute;
	width: 100%;
}
	.ml-pthumb:hover .ml-pthumb-title {
		bottom:-50%;
	}
	.ml-pthumb .ml-pthumb-title,
	.ml-pthumb:hover .ml-pthumb-title {
		transition: bottom 0.15s ease-in-out;
			-webkit-transition: bottom 0.15s ease-in-out;
			-moz-transition: bottom 0.15s ease-in-out;
			-ms-transition: bottom 0.15s ease-in-out;
			-o-transition: bottom 0.15s ease-in-out;
	}


/*--- Isotope Animation ---*/

.isotope-item {
  z-index: 2;
}

.isotope-hidden.isotope-item {
  pointer-events: none;
  z-index: 1;
}

.isotope,
.isotope .isotope-item {
  -webkit-transition-duration: 0.8s;
     -moz-transition-duration: 0.8s;
      -ms-transition-duration: 0.8s;
       -o-transition-duration: 0.8s;
          transition-duration: 0.8s;
}

.isotope {
  -webkit-transition-property: height, width;
     -moz-transition-property: height, width;
      -ms-transition-property: height, width;
       -o-transition-property: height, width;
          transition-property: height, width;
}

.isotope .isotope-item {
  -webkit-transition-property: -webkit-transform, opacity;
     -moz-transition-property:    -moz-transform, opacity;
      -ms-transition-property:     -ms-transform, opacity;
       -o-transition-property:         top, left, opacity;
          transition-property:         transform, opacity;
}

.isotope.no-transition,
.isotope.no-transition .isotope-item,
.isotope .isotope-item.no-transition {
  -webkit-transition-duration: 0s;
     -moz-transition-duration: 0s;
      -ms-transition-duration: 0s;
       -o-transition-duration: 0s;
          transition-duration: 0s;
}



/*-------------------------------------------------*/
/*	5. PORTFOLIO ITEMS
/*-------------------------------------------------*/

/*--- Container ---*/
.ml-portal {
	background: #000 url(../images/ajax-loader.gif) no-repeat center center;
	bottom: 0px;
	display: none;
	height: 100%;
	left: 0px;
	position: fixed;
	width: 100%;
	z-index: 5000;
}
	.ml-portal.ml-visible {
		display: block;
	}


/*--- Controls ---*/
.flex-direction-nav a,
.flex-direction-nav a:visited,
.ml-pbutton,
.ml-pbutton:visited {
	background-color: <?php echo $ml_custom_primary_main_color ?>;
	border-radius: 99px;
		-webkit-border-radius: 99px;
		-moz-border-radius: 99px;
		-ms-border-radius: 99px;
		-o-border-radius: 99px;
	color: <?php echo $ml_custom_secondary_main_color ?>;
	display: block;
	height: 44px;
	font-family: 'MLThemeIcons';
	font-size: 24px;
	line-height: 44px;
	position: absolute;
	text-align: center;
	text-decoration: none;
	width: 44px;
}
	.flex-direction-nav a:hover,
	.ml-pbutton:hover {
		color: <?php echo $ml_custom_primary_text_color ?>;
		text-decoration:none;
	}
	.flex-direction-nav a,
	.flex-direction-nav a:hover,
	.ml-pbutton,
	.ml-pbutton:hover {
		transition: color 0.15s ease-in-out;
			-webkit-transition: color 0.15s ease-in-out;
			-moz-transition: color 0.15s ease-in-out;
			-ms-transition: color 0.15s ease-in-out;
			-o-transition: color 0.15s ease-in-out;
	}

.ml-pprev {
	left: 20px;
	margin-top: -22px;
	top: 50%;
}
	.ml-pprev span {
		margin-right: 10%;
	}

.ml-pnext {
	right: 20px;
	margin-top: -22px;
	top: 50%;
}
	.ml-pnext span {
		margin-left: 10%;
	}

.ml-pclose {
	font-size: 20px;
	right: 20px;
	top: 20px;
}
	.ml-pclose span {
	}

.ml-pplaypause {
	bottom: 20px;
	left: 50%;
	margin-left: -22px;
}
	.ml-ppause .ml-splay {
		display: none;
	}
	.ml-pplay .ml-spause {
		display: none;
		font-size: 26px;
	}
	.ml-splay {
		font-size: 27px;
		margin-left: 10%;
	}

.ml-pgridbox {
	display: none;
}

.ml-pgrid {
	top: 20px;
	left: 50%;
	line-height:44px;
	margin-left: -22px;
	z-index: 100;
}
	.ml-pgrid {
		font-size: 16px;
	}

.ml-pgridneck {
	background: <?php echo $ml_custom_primary_main_color ?>;
	display: block;
	height: 44px;
	left: 50%;
	margin-left: -22px;
	position: absolute;
	top: 42px;
	width: 44px;
}

.ml-pthumbs {
	background: <?php echo $ml_custom_primary_main_color ?>;
	height: 220px;
	left: 50%;
	margin-left: -124px;
	padding: 14px;
	position: absolute;
	top: 62px;
	width: 220px;
}

.ml-pthumblink {
	border: 4px solid <?php echo $ml_custom_primary_main_color ?>;
	display: block;
	float: left;
	height: 47px;
	position: relative;
	width: 47px;
}

	.ml-pthumblink.ml-active,
	.ml-pthumblink:hover {
		border-color: <?php echo $ml_custom_secondary_main_color ?>;
		text-decoration: none;
	}
		.ml-pthumblink,
		.ml-pthumblink:hover {
			transition: border-color 0.15s ease-in-out;
				-webkit-transition: border-color 0.15s ease-in-out;
				-moz-transition: border-color 0.15s ease-in-out;
				-ms-transition: border-color 0.15s ease-in-out;
				-o-transition: border-color 0.15s ease-in-out;
		}

.ml-pthumblink span {
	background-image: url(../images/black70.png);
		background: rgba(0,0,0,.7);
	color: white;
	font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
	font-size: 24px;
	font-weight: bold;
	left: 0px;
	line-height: 47px;
	opacity: 0;
		filter: alpha(opacity = 0);
	position:absolute;
	text-align: center;
	text-decoration: none;
	top: 0px;
	width: 47px;
}
	.ml-pthumblink.ml-active span,
	.ml-pthumblink:hover span {
		opacity: 1;
			filter: alpha(opacity = 100);
	}
	.ml-pthumblink span,
	.ml-pthumblink:hover span {
		transition: opacity 0.15s ease-in-out;
			-webkit-transition: opacity 0.15s ease-in-out;
			-moz-transition: opacity 0.15s ease-in-out;
			-ms-transition: opacity 0.15s ease-in-out;
			-o-transition: opacity 0.15s ease-in-out;
	}

.ml-pthumbsport {
	height: 220px;
	overflow: hidden;
	position: absolute;
	width: 220px;
}

.ml-pthumbswrap {
	left: 0;
	position: absolute;
	top: 0;
}

.ml-pthumbblock {
	float: left;
	height: 220px;
	width: 220px;
}

.ml-thumbsnav a,
.ml-thumbsnav a:visited {
	background-color: <?php echo $ml_custom_primary_main_color ?>;
	border-radius: 99px;
		-webkit-border-radius: 99px;
		-moz-border-radius: 99px;
		-ms-border-radius: 99px;
		-o-border-radius: 99px;
	color: <?php echo $ml_custom_secondary_main_color ?>;
	display: block;
	height: 32px;
	font-family: 'MLThemeIcons';
	font-size: 17px;
	line-height: 32px;
	margin-top: -16px;
	position: absolute;
	text-align: center;
	text-decoration: none;
	top: 50%;
	width: 32px;
}
	.ml-thumbsnav a:hover {
		color: <?php echo $ml_custom_secondary_text_color ?>;
	}
	.ml-thumbsnav a,
	.ml-thumbsnav a:hover {
		transition: color 0.15s ease-in-out;
			-webkit-transition: color 0.15s ease-in-out;
			-moz-transition: color 0.15s ease-in-out;
			-ms-transition: color 0.15s ease-in-out;
			-o-transition: color 0.15s ease-in-out;
	}

.ml-thumbsprev {
	left: -36px;
}
	.ml-thumbsprev span {
		margin-right: 10%;
	}

.ml-thumbsnext {
	right: -36px;
}
	.ml-thumbsnext span {
		margin-left: 10%;
	}




/*--- Content ---*/
.ml-pitem {
	display: none;
}

.ml-pimage img {
	position: absolute;
}

.ml-try-middle {
	background-color: #000;
	display: table-cell;
	vertical-align: middle;
}




/*-------------------------------------------------*/
/*	6. PAGE & BLOG
/*-------------------------------------------------*/


/*--- Page ---*/

.ml-page-wrapper {
	background-color: <?php echo $ml_custom_primary_main_color ?>;
	border-bottom: 3px solid <?php echo $ml_custom_secondary_main_color ?>;
	margin-bottom: 4em;
	overflow: hidden;
	padding: .5em 0 2.5em;
	text-align: center;
}
	.ml-page-wrapper .ml-read-wrapper {
		text-align: left;
	}


/*--- Blog ---*/

.ml-post-entry {
	background-color: <?php echo $ml_custom_primary_main_color ?>;
	border-bottom: 3px solid <?php echo $ml_custom_secondary_main_color ?>;
	margin-bottom: 4em;
	overflow: hidden;
	text-align: center;
}

.ml-post-entry p {
	font-family: 'Droid Serif', serif;
}

.ml-post-entry p:first-child {
	margin:0 !important;
}

.ml-read-wrapper {
	display: inline-block;
	min-width: 500px;
	width: 64%;
}

.ml-post-ftrd {
	background-color: white;
	display: inline-block;
	width: 100%;
}
	.ml-ftrd-img {
		width: 100%;
	}
	.ml-post-ftrd:hover img {
		opacity: 0.25;
			filter: alpha(opacity = 25);
	}
	.ml-post-ftrd img,
	.ml-post-ftrd:hover img {
		transition: opacity 0.15s ease-in-out;
			-webkit-transition: opacity 0.15s ease-in-out;
			-moz-transition: opacity 0.15s ease-in-out;
			-ms-transition: opacity 0.15s ease-in-out;
			-o-transition: opacity 0.15s ease-in-out;
	}

.ml-entry-title {
	background-color: <?php echo $ml_custom_secondary_main_color ?>;
	font-family: 'Droid Sans', sans-serif;
	margin: 2em 0 .75em;
	position: relative;
}

.ml-entry-title a,
.ml-entry-title h2 {
	color: <?php echo $ml_custom_secondary_text_color ?>;
	text-decoration: none;
}

.ml-entry-title a:hover h2 {
	color: <?php echo $ml_custom_primary_main_color ?>;
}

.ml-entry-title a h2,
.ml-entry-title a:hover h2 {
	transition: color 0.15s ease-in-out;
		-webkit-transition: color 0.15s ease-in-out;
		-moz-transition: color 0.15s ease-in-out;
		-ms-transition: color 0.15s ease-in-out;
		-o-transition: color 0.15s ease-in-out;
}

.ml-entry-title h2 {
	letter-spacing: .05em;
	margin: 0;
	padding: .3em 0;
	text-align: center;
	text-transform: uppercase;
	word-spacing: 0.1em;
}

.ml-extra-border {
	background-color: <?php echo $ml_custom_secondary_main_color ?>;
	height: 2px;
	left: 0;
	position: absolute;
	width: 100%;
}
	.ml-entry-title .ml-extra-border {
		bottom: -4px;
	}
	.ml-entry-title .ml-extra-border:first-child {
		top: -4px;
	}

.ml-tshad-3 {
	text-shadow: <?php echo $ml_custom_secondary_details_color ?> -2px 2px 0;
}

.ml-entry-info {
	color: <?php echo $ml_custom_primary_details_color ?>;
	font-size: .875em; /* 14/16px */
	text-align: center;
}


/*--- Buttons ---*/

.ml-nav-prev a,
.ml-nav-next a,
.wpcf7-submit,
.ml-button {
	border: 0 none;
	box-shadow: rgba(0, 0, 0, .2) 0 2px 2px;
		-webkit-box-shadow: rgba(0, 0, 0, .2) 0 2px 2px;
		-moz-box-shadow: rgba(0, 0, 0, .2) 0 2px 2px;
}

.ml-read-more {
	margin: 3em 0 4em;
	text-align: center;
}

.ml-readm-link {
	border: 3px solid <?php echo $ml_custom_primary_main_color ?>;
	text-decoration: none;
}

.ml-nav-prev a,
.ml-nav-next a,
.wpcf7-submit,
.ml-button,
.ml-readm-link span {
	background: <?php echo $ml_custom_secondary_main_color ?>;
	border-radius: 6px;
		-webkit-border-radius: 6px;
		-moz-border-radius: 6px;
		-ms-border-radius: 6px;
		-o-border-radius: 6px;
	color: <?php echo $ml_custom_primary_main_color ?>;
	font-family: 'Droid Sans', sans-serif;
	font-size: .9375em; /* 15/16px */
	font-weight: 700;
	padding: .5em 1.25em;
}
	.ml-nav-prev a:hover,
	.ml-nav-next a:hover,
	.ml-button:hover,
	.ml-readm-link:hover {
		text-decoration: none;
	}
	.ml-nav-prev a:hover,
	.ml-nav-next a:hover,
	.wpcf7-submit:hover,
	.ml-button:hover,
	.ml-readm-link:hover span {
		background-color: <?php echo $ml_custom_primary_text_color ?>;
	}
	.ml-nav-prev a,
	.ml-nav-next a,
	.ml-nav-prev a:hover,
	.ml-nav-next a:hover,
	.wpcf7-submit,
	.wpcf7-submit:hover,
	.ml-button,
	.ml-button:hover,
	.ml-readm-link span,
	.ml-readm-link:hover span {
		transition: background-color 0.15s ease-in-out;
			-webkit-transition: background-color 0.15s ease-in-out;
			-moz-transition: background-color 0.15s ease-in-out;
			-ms-transition: background-color 0.15s ease-in-out;
			-o-transition: background-color 0.15s ease-in-out;
	}

.ml-divider-2 {
	border-top: 6px double <?php echo $ml_custom_secondary_main_color ?>;
	display: block;
	margin-top: -.85em;
	width: 100%;
}

.ml-post-full .ml-entry-text {
	text-align: left;
}

.ml-post-entry .ml-tags {
	font-size: .875em; /* 14/16px */
	font-family: 'Droid Sans', sans-serif;
}

.ml-post-entry .ml-fit {
	margin-top: -1px;
}

.ml-post-entry .ml-tags strong {
	text-transform: uppercase;
}


/*--- Post Format ---*/

.ml-post-format {
	height: 42px;
	margin: 2.5em 0 1.5em;
	position: relative;
}

.ml-post-icon {
	background-color: <?php echo $ml_custom_secondary_main_color ?>;
	border-radius: 99px;
		-webkit-border-radius: 99px;
		-moz-border-radius: 99px;
		-ms-border-radius: 99px;
		-o-border-radius: 99px;
	border: 3px solid <?php echo $ml_custom_primary_main_color ?>;
	color: <?php echo $ml_custom_primary_main_color ?>;
	font-family: 'MLPostIcons';
	font-size: 24px;
	height: 42px;
	left: 50%;
	line-height: 42px;
	margin: -3px auto 0 -24px;
	position: absolute;
	text-align: center;
	top:0;
	width: 42px;
}

.ml-thin-divd {
	background-color: <?php echo $ml_custom_secondary_main_color ?>;
	height: 1px;
	width: 100%;
}
	.ml-post-format .ml-thin-divd {
		left: 0;
		margin-top: -1px;
		position: absolute;
		top: 50%;
	}

.ml-thin-divd-2 {
	background-color: <?php echo $ml_custom_secondary_main_color ?>;
	height: 3px;
	width: 100%;
}

.ml-post-i-standard span {
	font-size: 25px;
	line-height: 44px;
}

.ml-entry-aside .ml-post-format {
	margin: 1.5em 0;
}

.ml-post-i-aside {
	line-height: 40px;
}

.ml-post-i-aside span {
	font-size: 20px;
}

.ml-entry-link .ml-entry-info,
.ml-entry-quote .ml-entry-info {
	margin-top: .5em;
}

.ml-entry-quote .ml-post-format {
	margin: 2.5em 0;
}

blockquote.ml-with-author {
	margin-bottom: .5em;
}

.ml-quote-author {
	text-align: left;
	font-family: 'Droid Sans', sans-serif;
}

.ml-quote-author:before {
	content: "\2014\00A0\00A0\00A0";
}

.ml-status-text {
	font-family: 'Droid Sans', sans-serif;
	font-size: 1.35em;
	margin: 1.5em 0 1.85em;
}

.ml-status-text p:first-child:before {
	content: "\201C";
}

.ml-entry-status .ml-entry-info {
	margin-top: .5em;
}

.ml-post-i-status {
	font-size: 26px;
	line-height: 42px;
}

.ml-link-text {
	margin: 2em 0 2.5em;
}

.ml-link-text a {
	color: <?php echo $ml_custom_secondary_main_color ?>;
	font-family: 'Droid Sans', sans-serif;
	font-size: 1.5em;
	position: relative;
	text-decoration: none;
}
	.ml-link-text a:hover {
		color: <?php echo $ml_custom_primary_text_color ?>;
	}
	.ml-link-text a,
	.ml-link-text a:hover {
		transition: color 0.15s ease-in-out;
			-webkit-transition: color 0.15s ease-in-out;
			-moz-transition: color 0.15s ease-in-out;
			-ms-transition: color 0.15s ease-in-out;
			-o-transition: color 0.15s ease-in-out;
	}

.ml-ext-ico {
	background-color: <?php echo $ml_custom_secondary_main_color ?>;
	border-radius: 6px;
		-webkit-border-radius: 6px;
		-moz-border-radius: 6px;
		-ms-border-radius: 6px;
		-o-border-radius: 6px;
	color: <?php echo $ml_custom_primary_main_color ?>;
	font-family: 'MLPostIcons';
	font-size: 20px;
	margin-left: .15em;
	padding: .15em .15em .25em .25em;
}

.ml-post-i-chat {
	font-size: 20px;
	line-height: 44px;
}

.ml-chat-text {
	font-family: 'Droid Sans', sans-serif;
	margin: 1.5em 0 2em;
	text-align:left;
}
	.ml-chat-text p {
		margin: 0;
	}

.ml-entry-chat .ml-entry-info {
	margin-top: .5em;
}

.ml-post-i-audio {
	font-size: 20px;
}
	.ml-post-i-audio span {
		margin-right: 6%;
	}

.ml-post-i-video {
	font-size: 26px;
}

.ml-entry-image img {
	width: 100%;
}

.ml-entry-image .ml-entry-info,
.ml-entry-audio .ml-entry-info,
.ml-entry-video .ml-entry-info,
.ml-entry-gallery .ml-entry-info {
	margin-top: .5em;
}

.ml-post-i-image {
	font-size: 26px;
}

.ml-post-i-gallery {
	font-size: 26px;
}

.ml-post-i-gallery span {
	margin-right: 8%;
}


/*--- Comments ---*/

.ml-all-comments {
	list-style:none;
	margin: 0;
	padding: 0;
}

.ml-all-comments .children {
	list-style: none;
	margin: 0 0 0 2em;
	padding: 0;
}

.ml-comment-content {
	font-size: .875em; /* 14/16px */
}

.ml-comment-ava {
	float: left;
}

.ml-comment-content {
	margin-left: 57px;
}

.ml-comment-content p {
	font-family: 'Droid Sans', sans-serif;
}

.ml-comment-box {
	margin-bottom: 2em;
}

.ml-etitle-in {
	margin-left: -25.4%;
	width: 150.8%;
}

.ml-comment-form label {
	display: inline-block;
	text-align: right;
	width: 20%;
}
.ml-comment-form input,
.ml-comment-form textarea {
	margin-left: 4%;
	width: 67%;
}

.ml-comment-submit {
	float: right;
	margin-right: 1%;
}


/*--- Nav ---*/

.ml-nav-prev {
	float: left;
}

.ml-nav-next {
	float: right;
}


/*--- Latest Posts ---*/

.ml-lsts-in .ml-read-wrapper {
	min-width: 0;
	width: 90%;
}



/*-------------------------------------------------*/
/*	7. SIDEBAR & WIDGETS
/*-------------------------------------------------*/

.ml-sidebar {
	list-style: none;
	margin: 0;
	padding: 0;
}

.ml-sidebar, 
.ml-sidebar p {
	color: <?php echo $ml_custom_tertiary_text_color ?>;
}

.ml-sidebar {
	font-size: .875em; /* 14/16px */
}

.ml-sidebar > li {
	background-image: url(../images/black70.png);
	background: <?php echo ml_hexToRGBA($ml_custom_tertiary_main_color, .7) ?>;
	border-bottom: 3px solid <?php echo $ml_custom_primary_main_color ?>;
	margin-bottom: 2.5em;
	padding: 1.25em 8%;
}

.ml-sidebar .widgettitle {
	background-color: <?php echo $ml_custom_primary_main_color ?>;
	color: <?php echo $ml_custom_primary_text_color ?>;
	display: inline-block;
	font-size: 1em;
	letter-spacing: .08em;
	margin: -1em auto .75em -9.18367346%; 
	padding: .75em 9.18367346%; 
	text-transform: uppercase;
	width: 100%;
	word-spacing: .1em;
}


/*--- Standard Widgets ---*/

.widget_nav_menu > div > ul,
.widget_recent_entries > ul,
.widget_recent_comments > ul,
.widget_pages > ul,
.widget_meta > ul,
.widget_links > ul,
.widget_categories > ul,
.widget_archive > ul {
	list-style: none;
	margin: 0;
	padding: 0;
}

#wp-calendar {
	width: 100%;
}

#wp-calendar caption {
	border-bottom: 1px solid white;
	border-top: 1px solid white;
	margin-bottom: 1em;
	padding: 1em;
}

#wp-calendar th {
	padding: 1em 0;
}

#wp-calendar th,
#wp-calendar tr {
	text-align: center;
}


/*--- Sidebar ---*/

.ml-sidebar .widget_search {
	background: none !important;
	border-bottom: 0 none;
	padding: 0;
}

.search-form {
	position: relative;
}

.ml-search {
	background-color: <?php echo $ml_custom_primary_main_color ?>;
	border: 0 none;
	border-radius: 99px;
		-webkit-border-radius: 99px;
		-moz-border-radius: 99px;
		-ms-border-radius: 99px;
		-o-border-radius: 99px;
	box-shadow: rgba(0, 0, 0, .3) 0 2px 2px;
		-webkit-box-shadow: rgba(0, 0, 0, .3) 0 2px 2px;
		-moz-box-shadow: rgba(0, 0, 0, .3) 0 2px 2px;
	color: <?php echo $ml_custom_primary_text_color ?>;
	font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
	padding: .75em 0 .75em 5%;
	width: 95.5%;
}
	.gecko .ml-search {
		padding-left: 1.25em;
	}
	.ml-search:focus {
		outline: 0 none;
	}
	.ml-search::-webkit-input-placeholder {
		color: <?php echo $ml_custom_primary_details_color ?>;
	}
	.ml-search:-moz-placeholder {
		color: <?php echo $ml_custom_primary_details_color ?>;
	}

.ml-search-submit {
	background-color: <?php echo $ml_custom_primary_main_color ?>;
	border: 0 none;
	border-top-right-radius: 99px;
		-webkit-border-radius-top-right: 99px;
		-moz-border-radius-topright: 99px;
	border-bottom-right-radius: 99px;
		-webkit-border-radius-bottom-right: 99px;
		-moz-border-radius-bottomright: 99px;
	color: <?php echo $ml_custom_primary_text_color ?>;
	font-family: 'MLThemeIcons';
	padding: .75em 1em .75em .85em;
	position: absolute;
	right: 0;
	top: 0;
}
	.ml-search-submit:hover {
		background-color: <?php echo $ml_custom_primary_text_color ?>;
		color: <?php echo $ml_custom_primary_main_color ?>;
	}
	.ml-search-submit,
	.ml-search-submit:hover {
		transition: all 0.15s ease-in-out;
			-webkit-transition: all 0.15s ease-in-out;
			-moz-transition: all 0.15s ease-in-out;
			-ms-transition: all 0.15s ease-in-out;
			-o-transition: all 0.15s ease-in-out;
	}
	.win.gecko .ml-search-submit {
		padding-bottom: .7em;
	}



/*-------------------------------------------------*/
/*	8. SLIDER
/*-------------------------------------------------*/

.flex-container a:active,
.ml-slider a:active,
.flex-container a:focus,
.ml-slider a:focus  {outline: none;}
.slides,
.flex-control-nav,
.flex-direction-nav {margin: 0; padding: 0; list-style: none;} 
.ml-slider {margin: 0; padding: 0;}
.ml-slider .slides > li {display: none; -webkit-backface-visibility: hidden;	position:relative;}
.ml-slider .ml-gallery img {width: 100%; display: block;}
.flex-pauseplay span {text-transform: capitalize;}
.slides:after {content: "."; display: block; clear: both; visibility: hidden; line-height: 0; height: 0;} 
html[xmlns] .slides {display: block;} 
* html .slides {height: 1%;}
.no-js .slides > li:first-child {display: block;}

.ml-gallery img {
	width: 100%;
}

.ml-fx-slide {
	overflow: hidden;
	width:100%;
	z-index:0;
}
.ml-fx-element {
	position: absolute;
	z-index:1; /* Webkit bug */
}

.ml-caption {
	background-image: url(../images/black70.png);
		background: <?php echo ml_hexToRGBA($ml_custom_tertiary_main_color, .7) ?>;
	bottom: 0;
	color: <?php echo $ml_custom_tertiary_text_color ?>;
	font-size: .88888888888889em;
	left: 0;
	line-height: 1.5em;
	max-width:570px;
	padding: 2em;
	position: absolute;
	text-decoration: none;
}

.ml-caption-title {
	display: block;
	font-size: 2em;
	margin: 0 0 .75em;
}

.ml-caption-divider {
	border-top: 1px solid <?php echo $ml_custom_tertiary_text_color ?>;
	margin: 1em 0;
	width: 1em;
}


.ml-slider {
	position: relative;
}

.flex-prev {
	right: 2.8em;
	top: .5em;
}
	.flex-prev span {
		margin-right: 10%;
	}

.flex-next {
	right: .5em;
	top: .5em;
}
	.flex-next span {
		margin-left: 10%;
	}



/*-------------------------------------------------*/
/*	9. FONTS
/*-------------------------------------------------*/

<?php

$fonts_num = of_get_option('ml-fonts_num', 3);

for ($count=1; $count <= $fonts_num; $count++) { 
	
	$apply_to 	= of_get_option('ml-apply_font_to-'.$count);
	$font_type 	= of_get_option('ml-font-'.$count);


	?>

<?php echo $apply_to; ?>{<?php

	if($font_type == 'standard') {

		$font = of_get_option('ml-standard_fonts-'.$count);

		echo 'font-family:' . $font . ';';

	} else if ($font_type == 'google') {

		$font = of_get_option('ml-google_fonts-'.$count);
		$font = explode(':', $font);
		$font_family = $font[0];
		$font_variant = $font[1];

		if($font_variant == 'regular') { //"regular" exception

			$font_style = 'normal';
			$font_weight = 'normal';
			
		} else if($font_variant == 'bolditalic') { //"bolditalic" exception
			
			$font_style = 'italic';
			$font_weight = 'bold ';

		} else if($font_variant == 'bold') { //"bold" exception
			
			$font_style = 'normal';
			$font_weight = 'bold';

		} else if($font_variant == 'italic') { //"italic" exception
			
			$font_style = 'italic';
			$font_weight = 'normal';

		} else {

			$font_style = (substr($font_variant,3)) ? 'italic' : NULL;
			$font_weight = substr($font_variant,0,3);

		}


		echo
			'font-family:' . $font_family .	', sans-serif;'.
			'font-style:' . $font_style .	';'.
			'font-weight:' . $font_weight .	';';


	}

	?>}<?php

} ?>



/*-------------------------------------------------*/
/*	9. OTHER
/*-------------------------------------------------*/

.ml-archive-header {
	margin-top:3.75em; /* 60/16px */
}

.ml-404-area {
	margin:5em 0;
	text-align:center;
}

.ml-port-header {
	margin-bottom: 2.25em;
	text-align:center;
}

.ml-port-title {
	font-size: 2.625em;  /* 42/16px */
	margin:0;
	text-shadow: rgba(0, 0, 0, .08) -.07em .07em 0;
}

.ml-post-content .ml-port-info {
	color: #a1a1a1;
	font-size:1em;
	margin: .7em 0 0;
}

.ml-port-info a {
	color: #6d6d6d;
	text-decoration:none;
}

.ml-port-info a:hover {
	color: #6d6d6d;
	text-decoration:underline;
}

.ml-port-info a:visited {
	color: #999;
}

.ml-post-content .ml-port-info {
	text-indent: 0;
}




/*-------------------------------------------------*/
/* 11. RESPONSIVE
/*-------------------------------------------------*/

@media screen and (max-width: 1024px) {

	.ml-header {
		position: static !important;
		text-align: center;
	}

	.ml-h-arrow {
		display: none !important;
	}

	.ml-logo {
		margin-top: 2.5em !important;
	}

	.ml-header-clear {
		display: block;
	}

	.ml-head-menu {
		display: table;
		margin: 0 auto;
	}

	.ml-social {
		display: inline;
		float: none;
		margin: 0 auto;
	}

	.ml-social li {
		float: none;
		display: inline;
	}

	.ml-social li a {
		float: none;
	}

}

@media screen and (max-width: 900px) {

	.ml-sidebar-content,
	.ml-main-content {
		float: none;
		width: 100%;
	}

	.ml-loop-nav {
		display: inline-block;
		margin-bottom: 4em;
	}

	.ml-grid {
		margin-bottom: 2.5em;
		margin-left: 0;
		width: 100% !important;
	}

}

@media screen and (max-width: 600px) {

	.ml-head-menu {
		display: none;
	}

	.ml-select-menu {
		display: inline-block;
		margin: .5em 0 1em;
	}

	.ml-post-entry {
		font-size: .875em; /* 14/16px */
	}

	.ml-read-wrapper {
		min-width: 0;
		width: 90%;
	}

	.ml-comment-form {
		text-align: center;
	}

	.ml-comment-form label {
		text-align: center;
		width:100%;
	}

	.ml-comment-form input,
	.ml-comment-form textarea,
	.wpcf7-text,
	.wpcf7-textarea,
	.wpcf7-quiz,
	.wpcf7-captchar {
		margin-left: 0;
		width: 86%;
	}

	.wpcf7-title-with-input {
		margin: 0 auto;
		text-align: center;
	}


	.wpcf7-captchac {
		float: none;
		margin: 0 auto;
	}

	.wpcf7-captchar {
		float: none;
		width: auto;
	}


	.ml-comment-submit {
		float: none;
		margin-right: 0;
	}

	.ml-pgrid,
	.ml-pplaypause {
		display: none;
	}

	.ml-pprev {
		left: 8px;
	}

	.ml-pnext {
		right: 8px;
	}

	.ml-pclose {
		right: 8px;
		top: 8px;
	}

}
