<?php

function dz_lazy_load_attr( $attr, $attachment, $size ) {
	if ( false === array_key_exists( 'data-src', $attr ) ) {
		$attr['data-src'] = $attr['src'];
		$attr['src'] = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAADhCAQAAACjWBeAAAAAEUlEQVR42mNk+M84ikbRIEYARr3hAWYOVV8AAAAASUVORK5CYII=';
		
		unset( $attr['srcset'] );
	}

	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'dz_lazy_load_attr', 10, 3 );
