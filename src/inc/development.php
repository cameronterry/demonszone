<?php
defined( 'ABSPATH' ) or die();

function dz_image_wp_get_attachment_url( $url, $post_id ) {
	$url_parts = parse_url( $url );

	if ( empty( $url_parts ) ) {
		return $url;
	}

	$protocol = ( is_ssl() ? 'https' : 'http' );

	/** Handle local development environments. */
	if ( false !== strpos( $url_parts['host'], '.test' ) ) {
		$sub_domain = str_replace( 'wordpress.test', '', $url_parts['host'] );
		return sprintf( 'https://demonszone.com%2$s', $protocol, str_replace( 'demonszone/', '', $url_parts['path'] ), $sub_domain );
	}

	return $url;
}

function dz_image_wp_prepare_attachment_for_js( $response, $attachment, $meta ) {
	$response['url'] = dz_image_wp_get_attachment_url( $response['url'], 0 );

	if ( array_key_exists( 'sizes', $response ) && is_array( $response['sizes'] ) ) {
		foreach ( $response['sizes'] as $key => $value ) {
			$response['sizes'][$key]['url'] = dz_image_wp_get_attachment_url( $value['url'], 0 );
		}
	}

	return $response;
}

function dz_image_wp_calculate_image_srcset( $sources ) {
	foreach ( $sources as $key => $source ) {
		$sources[$key]['url'] = dz_image_wp_get_attachment_url( $source['url'], 0 );
	}
	return $sources;
}

 if ( defined( 'USE_PRODUCTION_IMAGES' ) && USE_PRODUCTION_IMAGES ) {
 	add_filter( 'wp_calculate_image_srcset', 'dz_image_wp_calculate_image_srcset', 10, 1 );
 	add_filter( 'wp_prepare_attachment_for_js', 'dz_image_wp_prepare_attachment_for_js', 10, 3 );
 }
