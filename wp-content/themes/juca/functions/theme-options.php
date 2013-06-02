<?php

/**
 * Bind JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function ml_customize_preview_js() {
	wp_enqueue_script( 'ml-theme-customizer', get_template_directory_uri() . '/functions/theme-customizer.js',  array( 'customize-preview' ), '1.0', true );
}
add_action( 'customize_preview_init', 'ml_customize_preview_js' );



/*-------------------------------------------------*/
/*	Customize Header
/*-------------------------------------------------*/

$ml_custom_header_support = array(
	'default-image' => get_template_directory_uri() . '/images/juca-logo.png',
	'uploads'       => true,
	'header-text'   => false
);

add_theme_support( 'custom-header', $ml_custom_header_support );

// Default custom headers packaged with the theme.
register_default_headers( array(
	'juca' => array(
		'url' => get_template_directory_uri() .'/images/juca-logo.png',
		'thumbnail_url' => get_template_directory_uri() .'/images/juca-logo.png'
	)
) );



/*-------------------------------------------------*/
/*	Customize Color Scheme
/*-------------------------------------------------*/

function ml_customize_register($wp_customize) {

	// custom component. Subtitle label
	class ML_Subtitle_Control extends WP_Customize_Control {
		public $type = 'subtitle';

		public function render_content() {
			?>
			<span class="customize-control-title" style='font-size:1.4em'>
				<?php echo esc_html( $this->label ); ?>
			</span>
			<?php
		}
	}


	$wp_customize->add_section( 'ml_juca_color_scheme', 
		array(
		    'title'    => __( 'Color Scheme', 'meydjer' ),
		    'priority' => 100
		) 
	);

	ml_add_custom_primary_palette($wp_customize);
	ml_add_custom_secondary_palette($wp_customize);
	ml_add_custom_tertiary_palette($wp_customize);
		
}
add_action( 'customize_register', 'ml_customize_register' );


/**
* Add the components for Primary Palette customization.
*/
function ml_add_custom_primary_palette($wp_customize) {

	// subtitle
	$wp_customize->add_setting( 'ml_custom_primary_color_subtitle', 
		array(
		    'default'    => '#0d121a',
		    'capability' => 'edit_theme_options'
		) 
	);
	$wp_customize->add_control( 
		new ML_Subtitle_Control( $wp_customize, 'ml_custom_primary_color_subtitle', 
			array(
			    'label'    => __( 'Primary Palette', 'meydjer' ),
			    'section'  => 'ml_juca_color_scheme',
			    'settings' => 'ml_custom_primary_color_subtitle',
			    'priority' => '2' // ordering
			) 
		) 
	);		

	// background color
	$wp_customize->add_setting( 'ml_custom_primary_main_color', 
		array(
		    'default'    => '#0D121A',
		    'capability' => 'edit_theme_options',
		    'transport'  => 'postMessage' // allow dynamic change
		) 
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control( $wp_customize, 'ml_custom_primary_main_color', 
			array(
			    'label'    => __( 'Main Color', 'meydjer' ),
			    'section'  => 'ml_juca_color_scheme',
			    'settings' => 'ml_custom_primary_main_color',
			    'priority' => '4' // ordering
			) 
		) 
	);

	// text color
	$wp_customize->add_setting( 'ml_custom_primary_text_color', 
		array(
		    'default'    => '#d3dbe8',
		    'capability' => 'edit_theme_options',
		    'transport'  => 'postMessage' // allow dynamic change
		) 
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control( $wp_customize, 'ml_custom_primary_text_color', 
			array(
			    'label'    => __( 'Text Color', 'meydjer' ),
			    'section'  => 'ml_juca_color_scheme',
			    'settings' => 'ml_custom_primary_text_color',
			    'priority' => '6' // ordering
			) 
		) 
	);	

	// details color
	$wp_customize->add_setting( 'ml_custom_primary_details_color', 
		array(
		    'default'    => '#616B7C',
		    'capability' => 'edit_theme_options',
		    'transport'  => 'postMessage' // allow dynamic change
		) 
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control( $wp_customize, 'ml_custom_primary_details_color', 
			array(
			    'label'    => __( 'Details Color', 'meydjer' ),
			    'section'  => 'ml_juca_color_scheme',
			    'settings' => 'ml_custom_primary_details_color',
			    'priority' => '8' // ordering
			) 
		) 
	);	
}


/**
* Add the components for Secondary Palette customization.
*/
function ml_add_custom_secondary_palette($wp_customize) {

	// subtitle
	$wp_customize->add_setting( 'ml_custom_secondary_color_subtitle', 
		array(
		    'default'    => '#0d121a',
		    'capability' => 'edit_theme_options'
		) 
	);
	$wp_customize->add_control( 
		new ML_Subtitle_Control( $wp_customize, 'ml_custom_secondary_color_subtitle', 
			array(
			    'label'    => __( 'Secondary Palette', 'meydjer' ),
			    'section'  => 'ml_juca_color_scheme',
			    'settings' => 'ml_custom_secondary_color_subtitle',
			    'priority' => '10' // ordering
			) 
		) 
	);

	// background color
	$wp_customize->add_setting( 'ml_custom_secondary_main_color', 
		array(
		    'default'    => '#0ab58a',
		    'capability' => 'edit_theme_options',
		    'transport'  => 'postMessage' // allow dynamic change
		) 
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control( $wp_customize, 'ml_custom_secondary_main_color', 
			array(
			    'label'    => __( 'Main Color', 'meydjer' ),
			    'section'  => 'ml_juca_color_scheme',
			    'settings' => 'ml_custom_secondary_main_color',
			    'priority' => '12' // ordering
			) 
		) 
	);	

	// text color
	$wp_customize->add_setting( 'ml_custom_secondary_text_color', 
		array(
		    'default'    => '#fff',
		    'capability' => 'edit_theme_options',
		    'transport'  => 'postMessage' // allow dynamic change
		) 
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control( $wp_customize, 'ml_custom_secondary_text_color', 
			array(
			    'label'    => __( 'Text Color', 'meydjer' ),
			    'section'  => 'ml_juca_color_scheme',
			    'settings' => 'ml_custom_secondary_text_color',
			    'priority' => '14' // ordering
			) 
		) 
	);	

	// details color
	$wp_customize->add_setting( 'ml_custom_secondary_details_color', 
		array(
		    'default'    => '#08906E',
		    'capability' => 'edit_theme_options',
		    'transport'  => 'postMessage' // allow dynamic change
		) 
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control( $wp_customize, 'ml_custom_secondary_details_color', 
			array(
			    'label'    => __( 'Details Color', 'meydjer' ),
			    'section'  => 'ml_juca_color_scheme',
			    'settings' => 'ml_custom_secondary_details_color',
			    'priority' => '16' // ordering
			) 
		) 
	);	

}


/**
* Add the components for Tertiary Palette customization.
*/
function ml_add_custom_tertiary_palette($wp_customize) {

	// subtitle
	$wp_customize->add_setting( 'ml_custom_tertiary_color_subtitle', 
		array(
		    'default'    => '#0d121a',
		    'capability' => 'edit_theme_options'
		) 
	);
	$wp_customize->add_control( 
		new ML_Subtitle_Control( $wp_customize, 'ml_custom_tertiary_color_subtitle', 
			array(
			    'label'    => __( 'Tertiary Palette', 'meydjer' ),
			    'section'  => 'ml_juca_color_scheme',
			    'settings' => 'ml_custom_tertiary_color_subtitle',
			    'priority' => '18' // ordering
			) 
		) 
	);

	// background color
	$wp_customize->add_setting( 'ml_custom_tertiary_main_color', 
		array(
		    'default'    => '#000000',
		    'capability' => 'edit_theme_options',
		    'transport'  => 'postMessage' // allow dynamic change
		) 
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control( $wp_customize, 'ml_custom_tertiary_main_color', 
			array(
			    'label'    => __( 'Background Color', 'meydjer' ),
			    'section'  => 'ml_juca_color_scheme',
			    'settings' => 'ml_custom_tertiary_main_color',
			    'priority' => '20' // ordering
			) 
		) 
	);	

	// text color
	$wp_customize->add_setting( 'ml_custom_tertiary_text_color', 
		array(
		    'default'    => '#fff',
		    'capability' => 'edit_theme_options',
		    'transport'  => 'postMessage' // allow dynamic change
		) 
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control( $wp_customize, 'ml_custom_tertiary_text_color', 
			array(
			    'label'    => __( 'Text Color', 'meydjer' ),
			    'section'  => 'ml_juca_color_scheme',
			    'settings' => 'ml_custom_tertiary_text_color',
			    'priority' => '22' // ordering
			) 
		) 
	);	


}

?>