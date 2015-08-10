<?php

define( 'DZ_INC', get_template_directory() );
define( 'DZ_VERSION', '5.0.0' );

require_once( DZ_INC . '/template-tags.php' );

function dz_after_setup_theme() {
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5' );

	add_image_size( 'album-small', 300, 300, true );
	add_image_size( 'album-medium', 520, 520, true );
}
add_action( 'after_setup_theme', 'dz_after_setup_theme' );

function dz_enqueue_scripts() {
	wp_enqueue_style( 'dz-fonts', '//fonts.googleapis.com/css?family=Merriweather%3A300%2C400%2C700' );
	wp_enqueue_style( 'dz-style', get_stylesheet_uri(), array( 'dz-fonts' ), DZ_VERSION );
}
add_action( 'wp_enqueue_scripts', 'dz_enqueue_scripts' );