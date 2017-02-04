<?php
defined( 'ABSPATH' ) or die();

wp_oembed_add_provider( '#https?://www\.facebook\.com/video.php.*#', 'https://www.facebook.com/plugins/video/oembed.json/', true );
wp_oembed_add_provider( '#https?://www\.facebook\.com/.*/videos/.*#i', 'https://www.facebook.com/plugins/video/oembed.json/', true );
wp_oembed_add_provider( '#https?://www\.facebook\.com/.*/posts/.*#i', 'https://www.facebook.com/plugins/post/oembed.json/', true );
wp_oembed_add_provider( '#https?://www\.facebook\.com/.*/photos/.*#i', 'https://www.facebook.com/plugins/post/oembed.json/', true );
wp_oembed_add_provider( '#https?://www\.facebook\.com/.*/activity/.*#i', 'https://www.facebook.com/plugins/post/oembed.json/', true );
wp_oembed_add_provider( '#https?://www\.facebook\.com/photo(s/|.php).*#i', 'https://www.facebook.com/plugins/post/oembed.json/', true );
wp_oembed_add_provider( '#https?://www\.facebook\.com/permalink.php.*#i', 'https://www.facebook.com/plugins/post/oembed.json/', true );
wp_oembed_add_provider( '#https?://www\.facebook\.com/media/.*#i', 'https://www.facebook.com/plugins/post/oembed.json/', true );
wp_oembed_add_provider( '#https?://www\.facebook\.com/questions/.*#i', 'https://www.facebook.com/plugins/post/oembed.json/', true );
wp_oembed_add_provider( '#https?://www\.facebook\.com/notes/.*#i', 'https://www.facebook.com/plugins/post/oembed.json/', true );

if ( false === function_exists( 'dz_jetpack_embed_remove' ) ) :
	function dz_jetpack_embed_remove( $shortcode ) {
		if ( array_key_exists( 'facebook', $shortcode ) ) {
			unset( $shortcode['facebook'] );
		}

		return $shortcode;
	}
	add_filter( 'jetpack_shortcodes_to_include', 'dz_jetpack_embed_remove', 10, 1 );
endif;
