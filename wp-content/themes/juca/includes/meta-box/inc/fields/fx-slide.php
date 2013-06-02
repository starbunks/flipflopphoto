<?php
// Prevent loading this file directly - Busted!
if( ! class_exists('WP') ) 
{
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

if ( ! class_exists( 'RWMB_FX_Slide_Field' ) ) 
{
	class RWMB_FX_Slide_Field 
	{
		/**
		 * Get field HTML
		 *
		 * @param string $html
		 * @param mixed  $meta
		 * @param array  $field
		 *
		 * @return string
		 */
		static function html( $html, $meta, $field ) 
		{
			$html = '<a href="#" class="ml-launch-fx-slide-button ml-admin-button ml-primary">'. __('Launch FX Slide Editor', 'meydjer') . '&nbsp; &rarr;</a>';

			return $html;
		}
	}
}