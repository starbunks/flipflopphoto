<?php

/*--- Make it a CSS file ---*/
header("Content-type: text/css");

/*--- Load WordPress ---*/
if(file_exists('../../../../../wp-load.php')) {
	include '../../../../../wp-load.php';
} else {
	include '../../../../../../wp-load.php';
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


/*--- General ---*/

.ml-cs-space {
	height: 3em;
}


/*--- Alert ---*/

.ml-alert {
	background-color:#FFF6F4;
	border: 1px solid #F73A24;
	box-shadow: inset 1px 1px 0px	white,
		inset -1px -1px 0px white,
		0 1px 1px rgba(0, 0, 0, 0.1);
		-webkit-box-shadow: inset 1px 1px 0px	white,
			inset -1px -1px 0px white,
			0 1px 1px rgba(0, 0, 0, 0.1);
		-moz-box-shadow: inset 1px 1px 0px	white,
			inset -1px -1px 0px white,
			0 1px 1px rgba(0, 0, 0, 0.1);
	color:#F73A24;
	line-height: 150%;
	padding: 1em;
	text-align: center;
}

.ml-alert.ml-alrt-blue {
	background-color:#f0f9fe;
	border-color: #108ECF;
	color:#108ECF;
}

.ml-alert.ml-alrt-green {
	background-color:#ECF8EA;
	border-color: #1A9C08;
	color:#1A9C08;
}

.ml-alert.ml-alrt-yellow {
	background-color:#FFFAE4;
	border-color: #BB8E00;
	color:#BB8E00;
}

.ml-alert.ml-alrt-black {
	background-color:#eee;
	border-color: #333;
	color:#333;
}


/*--- Back to Top ---*/
.ml-divider {
	background-color: <?php echo $ml_custom_primary_main_color ?>;
	height: 2px;
	position: relative;
	width: 100%;
}

.ml-back-to-top {
	color: <?php echo $ml_custom_primary_main_color ?>;
	text-decoration: none;
}

	.ml-divider .ml-back-to-top {
		font-size:.75em;
		position: absolute;
		right: 5px;
		top: -24px;
	}

.ml-back-to-top:hover {
	text-decoration: underline;
}


/*--- Call to Action ---*/
.ml-cta {
	background-image: url(../../../images/black70.png);
		background: rgba(0, 0, 0, .63);
	box-shadow: rgba(0, 0, 0, .3) 0 -2px 3px inset, rgba(0, 0, 0, .3) 0 2px 3px inset;
		-webkit-box-shadow: rgba(0, 0, 0, .3) 0 -2px 3px inset, rgba(0, 0, 0, .3) 0 2px 3px inset;
		-moz-box-shadow: rgba(0, 0, 0, .3) 0 -2px 3px inset, rgba(0, 0, 0, .3) 0 2px 3px inset;
	color: <?php echo $ml_custom_tertiary_text_color ?>;
	display: inline-block;
	padding: 2.5em 0;
	width:100%;
}
	.ml-cta.ml-cta-centered {
		text-align: center;
	}



.ml-cta-title {
	float:left;
	font-size: 2em;
	margin: .25em .5em 0 0;
}
	.ml-cta.ml-cta-centered .ml-cta-title {
		float: none;
	}

.ml-cta .ml-button {
	float:right;
	padding: .6em 1.25em .5em;
	font-size: 1.5em;
}
	.ml-cta.ml-cta-centered .ml-button {
		float:none;
	}


/*--- Tabs --- */
.ui-tabs-nav {
	list-style: none;
	margin: 0;
	padding: 0;
}

.ml-ui-tabs {
	float: left;
}

.ml-ui-tabs-contents {
	background-color: <?php echo $ml_custom_primary_main_color ?>;
	margin-top: -1px;
	clear: left;
	padding: 1em;
}

.ml-ui-tabs > ul {
	margin-left: 0;
	float: left;
}
.ml-ui-tabs > ul > li {
	float: left;
	margin-bottom:-1px;
	margin-right: .125em; /* 2/16px */
}
.ml-ui-tabs > ul > li > a {
	background-color: <?php echo $ml_custom_primary_main_color ?>;
	box-shadow: rgba(0,0,0,.2) 0 -1px 1px inset;
		-webkit-box-shadow: rgba(0,0,0,.2) 0 -1px 1px inset;
		-moz-box-shadow: rgba(0,0,0,.2) 0 -1px 1px inset;
	border-top: 2px solid <?php echo $ml_custom_primary_details_color ?>;
	color: <?php echo $ml_custom_primary_details_color ?>;
	float: left;
	font: 1em "Helvetica Neue", Helvetica, Arial, Clean, sans-serif;
	padding: .5em 1em;
	text-decoration: none;
}
.ml-ui-tabs > ul > li > a:hover {
	border-top-color: <?php echo $ml_custom_secondary_main_color ?>;
}
.ml-ui-tabs > ul > li.ui-state-active > a {
	border-top-color: <?php echo $ml_custom_secondary_main_color ?>;
	box-shadow: transparent 0 0 0 !important;
		-webkit-box-shadow: transparent 0 0 0 !important;
		-moz-box-shadow: transparent 0 0 0 !important;
	color: <?php echo $ml_custom_secondary_main_color ?>;
}

.ui-tabs-hide {
	position: absolute;
	left: -99999px;
}


/*--- Title ---*/
.ml-cs-title-v {
	background-image: url(../../../images/black70.png);
		background: <?php echo ml_hexToRGBA($ml_custom_tertiary_main_color, .7) ?>;
	box-shadow: rgba(0, 0, 0, .3) 0 -2px 3px inset, rgba(0, 0, 0, .3) 0 2px 3px inset;
		-webkit-box-shadow: rgba(0, 0, 0, .3) 0 -2px 3px inset, rgba(0, 0, 0, .3) 0 2px 3px inset;
		-moz-box-shadow: rgba(0, 0, 0, .3) 0 -2px 3px inset, rgba(0, 0, 0, .3) 0 2px 3px inset;
	color: <?php echo $ml_custom_tertiary_text_color ?>;
	padding: 1em ;
}

.ml-cs-title-v p {
	color: <?php echo $ml_custom_tertiary_text_color ?>;
}


/*--- Toggles --- */
.ml-toggle-a,
.ml-toggle-a:visited {
	background-color: <?php echo $ml_custom_primary_main_color ?>;
	border-top: 2px solid <?php echo $ml_custom_primary_details_color ?>;
	color: <?php echo $ml_custom_primary_details_color ?>;
	display: block;
	font: 16px "Helvetica Neue", Helvetica, Arial, Clean, sans-serif !important;
	padding: 9px 14px 8px;
	text-decoration: none;
}

	.ml-toggle-a:hover {
		border-top-color: <?php echo $ml_custom_secondary_main_color ?>;
		text-decoration: none;
	}

	.ml-toggle-a,
	.ml-toggle-a:hover {
		transition: border-top-color 0.1s ease-in-out;
			-o-transition: border-top-color 0.1s ease-in-out;
			-ms-transition: border-top-color 0.1s ease-in-out;
			-moz-transition: border-top-color 0.1s ease-in-out;
			-webkit-transition: border-top-color 0.1s ease-in-out;
	}

.ml-toggle-active .ml-toggle-a {
	border-top-color: <?php echo $ml_custom_secondary_main_color ?>;
	color: <?php echo $ml_custom_secondary_main_color ?>;
}

.ml-toggle-a span {
	color: <?php echo $ml_custom_primary_details_color ?>;
	font: 1.25em "Courier New", Courier, monospace; /* 20/16px */
	text-align: center;
	letter-spacing: .375em; /* 6/16px */
	padding: auto 14px;
}

.ml-toggle > div {
	background-color: <?php echo $ml_custom_primary_main_color ?>;
	padding: .5em 1em 1.5em;
	border-top:0;
	margin: 0 0 1em;
}
.ml-toggle > .ml-toggle-title {
	border-bottom:0 none;
	margin: -1px 0 0;
	padding-bottom:0;
	text-shadow: 0 0 0 transparent;
	text-transform: none;
	text-align:left;
}
.ml-toggle > .ml-toggle-title:first-child {
	margin-top: 0;
}



/*-------------------------------------------------*/
/* Responsive
/*-------------------------------------------------*/

@media screen and (max-width: 900px) {

	.ml-cta {
		text-align: center;
	}

	.ml-cta-title {
		display: block;
		float: none;
		margin-bottom: 1em;
		margin-right: 0;
	}

	.ml-cta .ml-button {
		float: none;
	}

}

@media screen and (max-width: 600px) {

	.ml-ui-tabs > ul > li {
		display: block;
		margin-right: 0;
		width: 100%;
	}

	.ml-ui-tabs > ul > li > a {
		display: block;
		float: none;
	}

}
