<?php

function dz_responsive_video_init() {
	add_filter( 'wp_video_shortcode', 'dz_responsive_video_embed_html' );
	add_filter( 'video_embed_html', 'dz_responsive_video_embed_html' );
}
add_action( 'after_setup_theme', 'dz_responsive_video_init', 99 );

function dz_responsive_video_embed_html( $html ) {
	return sprintf( '<div class="video">%s</div>', $html );
}
