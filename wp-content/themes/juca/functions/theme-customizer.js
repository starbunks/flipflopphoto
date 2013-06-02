( function( $ ){
	

	/*-------------------------------------------------*/
	/* 1. PRIMARY PALETTE
	/*-------------------------------------------------*/

	wp.customize( 'ml_custom_primary_main_color', function( value ) {
		value.bind( function( to ) {   

			$('.wpcf7-quiz, .wpcf7-captchar, .wpcf7-text, .wpcf7-textarea, .input-text, .input-textarea, .ml-header, .ml-h-bar, .ml-head-menu ul, .ml-wlcm, .ml-filters li a.ml-unselected, .flex-direction-nav a, .flex-direction-nav a:visited, .ml-pbutton, .ml-pbutton:visited, .ml-pgridneck, .ml-pthumbs, .ml-thumbsnav a, .ml-thumbsnav a:visited, .ml-page-wrapper, .ml-post-entry, .ml-sidebar .widgettitle, .ml-search, .ml-search-submit, .ml-divider, .ml-ui-tabs-contents, .ml-ui-tabs > ul > li > a, .ml-toggle-a, .ml-toggle > div')
				.css('background-color', to);

			$('.ml-h-arrow, .ml-entry-title a:hover h2, .ml-nav-prev a, .ml-nav-next a, .wpcf7-submit, .ml-button, .ml-readm-link span, .ml-post-icon, .ml-ext-ico, .ml-search-submit:hover, .ml-back-to-top')
				.css('color', to);

			$('.ml-head-menu > li > a, .ml-wlcm-top, .ml-sidebar > li')
				.css('border-bottom-color', to);

			$('.ml-wlcm-bottom')
				.css('border-top-color', to);

			$('.ml-pgridneck, .ml-pthumbs')
				.css('background', to);

			$('.ml-pthumblink, .ml-readm-link, .ml-post-icon')
				.css('border-color', to);

		} );
	} );



	wp.customize( 'ml_custom_primary_text_color', function( value ) {
		value.bind( function( to ) {   

			$('body, p, .ml-entry-text, .wpcf7-quiz, .wpcf7-captchar, .wpcf7-text, .wpcf7-textarea, .input-text, .input-textarea, .ml-head-menu li a, .ml-social li a, .ml-wlcm, .ml-filters li a.ml-unselected, .flex-direction-nav a:hover, .ml-pbutton:hover, .ml-link-text a:hover, .ml-sidebar .widgettitle, .ml-search, .ml-search-submit')
				.css('color', to);

			$('.ml-head-menu ul > li.sfHover, .ml-head-menu ul > li:hover')
				.css('border-left-color', to);

			$('.ml-nav-prev a:hover, .ml-nav-next a:hover, .wpcf7-submit:hover,	.ml-button:hover, .ml-readm-link:hover span, .ml-search-submit:hover')
				.css('background-color', to);

		} );
	} );



	wp.customize( 'ml_custom_primary_details_color', function( value ) {
		value.bind( function( to ) {   

			$('.wpcf7-quiz, .wpcf7-captchar, .wpcf7-text, .wpcf7-textarea, .input-text, .input-textarea')
				.css('border-color', to);

			$('.wpcf7-file, .ml-entry-info, .ml-search::-webkit-input-placeholder, .ml-search:-moz-placeholder, .ml-toggle-a, .ml-toggle-a span, .ml-ui-tabs > ul > li > a')
				.css('color', to);

			$('.ml-ui-tabs > ul > li > a, .ml-toggle-a')
				.css('border-top-color', to);

		} );
	} );	




	/*-------------------------------------------------*/
	/* 2. SECONDARY PALETTE
	/*-------------------------------------------------*/

	wp.customize( 'ml_custom_secondary_main_color', function( value ) {
		value.bind( function( to ) {   

			$('a, .ml-flt-arr, .flex-direction-nav a, .ml-pbutton, .ml-thumbsnav a, .ml-link-text a, .ml-ui-tabs > ul > li.ui-state-active > a, .ml-toggle-active .ml-toggle-a')
				.css('color', to);

			$('.ml-head-menu > li.current-menu-item > a, .ml-head-menu > li > a:hover, .ml-head-menu > li.ml-active > a, .ml-page-wrapper, .ml-post-entry')
				.css('border-bottom-color', to);

			$('.ml-head-menu ul li')
				.css('border-left-color', to);

			$('.ml-filters li a.ml-selected, .ml-entry-title, .ml-extra-border, .ml-nav-prev a, .ml-nav-next a, .wpcf7-submit, .ml-button, .ml-readm-link span, .ml-post-icon, .ml-thin-divd, .ml-thin-divd-2, .ml-ext-ico')
				.css('background-color', to);

			$('.ml-pthumblink.ml-active')
				.css('border-color', to);

			$('.ml-divider-2, .ml-ui-tabs > ul > li.ui-state-active > a, .ml-toggle-active .ml-toggle-a')
				.css('border-top-color', to);

		} );
	} );



	wp.customize( 'ml_custom_secondary_text_color', function( value ) {
		value.bind( function( to ) {

			$('.ml-filters li a.ml-selected, .ml-entry-title a, .ml-entry-title h2')
				.css('color', to);

		} );
	} );



	wp.customize( 'ml_custom_secondary_details_color', function( value ) {
		value.bind( function( to ) {
			$('.ml-tshad-3').css('text-shadow', to + ' -2px 2px 0'); // there is no text-shadow-color	
		} );
	} );




	/*-------------------------------------------------*/
	/* 3. TERTIARY PALETTE
	/*-------------------------------------------------*/

	wp.customize( 'ml_custom_tertiary_main_color', function( value ) {
		value.bind( function( to ) {   

			var rgb = hexToRgb(to);

			$('.ml-filter, .ml-sidebar > li, .ml-caption, .ml-cta, .ml-cs-title-v')
				.css('background', 'rgba(' + rgb.r + ',' + rgb.g + ',' + rgb.b + ',.7)');

		} );
	} );


	wp.customize( 'ml_custom_tertiary_text_color', function( value ) {
		value.bind( function( to ) {

			$('.ml-sidebar, .ml-sidebar p, .ml-caption, .ml-cta, .ml-cs-title-v, .ml-cs-title-v p')
				.css('color', to);	

			$('.ml-caption-divider')
				.css('border-top-color', to);	

		} );
	} );

} )( jQuery );


function hexToRgb(hex) {
    var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
    return result ? {
        r: parseInt(result[1], 16),
        g: parseInt(result[2], 16),
        b: parseInt(result[3], 16)
    } : null;
}
