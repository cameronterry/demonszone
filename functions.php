<?php

define( 'DZ_INC', get_template_directory() );
define( 'DZ_VERSION', '5.0.0' );

require_once( DZ_INC . '/template-tags.php' );

if ( false === isset( $content_width ) ) {
	$content_width = 520;
}

function dz_after_setup_theme() {
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5' );

	add_image_size( 'album-small', 300, 300, true );
	add_image_size( 'album-medium', 520, 520, true );

	/** News Image Sizes */
	add_image_size( 'news-thumb-tiny', 150, 84, true );
	add_image_size( 'news-thumb', 300, 169, true );
	add_image_size( 'news-thumb-large', 840, 473, true );

	/** Homepage Image Sizes */
	add_image_size( 'homepage-feature', 620, 349, true );
}
add_action( 'after_setup_theme', 'dz_after_setup_theme' );

function dz_enqueue_scripts() {
	global $content_width;

	if ( is_singular( 'post' ) ) {
		$content_width = 840;
	}

	wp_enqueue_style( 'dz-fonts', '//fonts.googleapis.com/css?family=Merriweather%3A300%2C400%2C700' );
	wp_enqueue_style( 'dz-style', get_stylesheet_uri(), array( 'dz-fonts' ), DZ_VERSION );

	wp_enqueue_script( 'dz', get_stylesheet_directory_uri() . '/assets/js/dz.js', array( 'jquery' ), DZ_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'dz_enqueue_scripts' );

function dz_pre_get_posts( $query ) {
	if ( $query->is_home() && $query->is_main_query() ) {
		$query->set( 'posts_per_page', 18 );
	}

	if ( is_tax( 'genres' ) && $query->is_main_query() ) {
		$query->set( 'posts_per_page', 20 );	
	}
}
add_action( 'pre_get_posts', 'dz_pre_get_posts' );