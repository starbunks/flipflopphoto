jQuery(document).ready(function($) {


	/*-------------------------------------------------*/
	/*	Plugins
	/*-------------------------------------------------*/

	$('.ml-fit').fitVids();



	/*-------------------------------------------------*/
	/*	Google Fonts
	/*-------------------------------------------------*/

	var fonts_num = 10;

	/*--- Show only the selected number of fonts ---*/
	var selected_fonts_num = parseInt($('#ml-fonts_num').val());

	for (var number = selected_fonts_num + 1; number <= fonts_num; number++) {
		
		$('#section-ml-font-'+number+', #section-ml-google_fonts-'+number+', #section-ml-standard_fonts-'+number+', #section-ml-apply_font_to-'+number).addClass('ml-hide-font-config');

	};


	/*--- Show selected number on change ---*/
	$('#ml-fonts_num').change(function(){

		var selected_fonts_num = parseInt($(this).val());

		//hide
		for (var number = selected_fonts_num + 1; number <= fonts_num; number++) {
			
			$('#section-ml-font-'+number+', #section-ml-google_fonts-'+number+', #section-ml-standard_fonts-'+number+', #section-ml-apply_font_to-'+number).addClass('ml-hide-font-config');

		};

		//show
		for (var number = 1; number <= selected_fonts_num; number++) {
			
			$('#section-ml-font-'+number+', #section-ml-google_fonts-'+number+', #section-ml-standard_fonts-'+number+', #section-ml-apply_font_to-'+number).removeClass('ml-hide-font-config');

		};


	});




	/*--- Hide the unchecked options ---*/
	for (var number = 1; number <= fonts_num; number++) {
		
		if($('#juca-ml-font-'+number+'-google').is(':checked')) {

			$('#section-ml-standard_fonts-'+number).hide().addClass('ml_hidden');

		} else if($('#juca-ml-font-'+number+'-standard').is(':checked')) {

			$('#section-ml-google_fonts-'+number).hide().addClass('ml_hidden');

		}

	};


	/*--- Show/hide when radio is changed ---*/
	var radio_google		= $('.ml-fonts input[value="google"]');
	var radio_standard	= $('.ml-fonts input[value="standard"]');

	radio_google.click(function(){

		var id = $(this).attr('data-rel');

		var section_standard = $('#section-ml-standard_fonts-'+id);
		var section_google 	= $('#section-ml-google_fonts-'+id);

		if(section_google.hasClass('ml_hidden')) {

			section_standard.addClass('ml_hidden').hide();

			section_google.removeClass('ml_hidden').fadeIn(300);

		}

	});

	radio_standard.click(function(){

		var id = $(this).attr('data-rel');

		var section_standard = $('#section-ml-standard_fonts-'+id);
		var section_google 	= $('#section-ml-google_fonts-'+id);

		if(section_standard.hasClass('ml_hidden')) {

			section_google.addClass('ml_hidden').hide();

			section_standard.removeClass('ml_hidden').fadeIn(300);

		}

	});



	/*-------------------------------------------------*/
	/*	Show and Hide fields
	/*-------------------------------------------------*/

	function ml_show_n_hide(to_show, to_hide) {

		if(to_show.hasClass('ml_hidden')) {

			to_hide.hide().addClass('ml_hidden');

			to_show.fadeIn(300).removeClass('ml_hidden');

		}

	}



	/*--- Portfolio Post Type ---*/

	if($('#_ml_port_type[value=images]').is(':checked')) {

		$('.field-_ml_port_embedded').hide().addClass('ml_hidden');

	} else {

		$('.field-_ml_port_images').hide().addClass('ml_hidden');

	}

	$('#_ml_port_type[value=images]').click(function(){

		if($('.field-_ml_port_images').hasClass('ml_hidden')) {

			$('.field-_ml_port_embedded').hide().addClass('ml_hidden');

			$('.field-_ml_port_images').fadeIn(300).removeClass('ml_hidden');

		}

	});

	$('#_ml_port_type[value=embedded]').click(function(){

		if($('.field-_ml_port_embedded').hasClass('ml_hidden')) {

			$('.field-_ml_port_images').hide().addClass('ml_hidden');

			$('.field-_ml_port_embedded').fadeIn(300).removeClass('ml_hidden');

		}

	});



	/*-------------------------------------------------*/
	/*	Post Formats meta-box
	/*-------------------------------------------------*/

	$('#post-format-0, #post-format-aside, #post-format-audio, #post-format-chat, #post-format-gallery, #post-format-image, #post-format-link, #post-format-quote, #post-format-status, #post-format-video').click(function(){
		var format = $(this).val();
		$('#_ml_post_m_status, #_ml_post_m_chat, #_ml_post_m_quote, #_ml_post_m_link, #_ml_post_m_video, #_ml_post_m_audio, #_ml_post_m_gallery, #_ml_post_m_image').hide();
		$('#_ml_post_m_'+format).fadeIn(300, 'easeInOutQuad');
	});

	var format = $('#post-formats-select input:checked').val();
	$('#_ml_post_m_'+format).show();



	/*-------------------------------------------------*/
	/* Background Meta-box
	/*-------------------------------------------------*/

	var bg_radio_default = $('._ml_bg_type-radio .rwmb-radio[value=default]');
	var bg_radio_video   = $('._ml_bg_type-radio .rwmb-radio[value=video]');
	var bg_radio_images  = $('._ml_bg_type-radio .rwmb-radio[value=images]');

	if (bg_radio_video.is(':checked')) {
		$('.rwmb-field.field-_ml_bg_video').show();

	}

	if ( (bg_radio_video.is(':checked')) || (bg_radio_images.is(':checked')) ) {
		$('.rwmb-field.field-_ml_bg_images').show();

	}

	bg_radio_default.click(function(){
		$('.rwmb-field.field-_ml_bg_video, .rwmb-field.field-_ml_bg_images').fadeOut(300);
	});

	bg_radio_video.click(function(){
		$('.rwmb-field.field-_ml_bg_video, .rwmb-field.field-_ml_bg_images').fadeIn(300);
	});

	bg_radio_images.click(function(){
		$('.rwmb-field.field-_ml_bg_video').fadeOut(300);
		$('.rwmb-field.field-_ml_bg_images').fadeIn(300);
	});


});