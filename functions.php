<?php

define( 'DZ_INC', get_template_directory() );
define( 'DZ_VERSION', '5.0.0' );

require_once( DZ_INC . '/template-tags.php' );

function dz_enqueue_scripts() {
	wp_enqueue_style( 'dz-fonts', '//fonts.googleapis.com/css?family=Merriweather%3A300%2C400%2C700' );
	wp_enqueue_style( 'dz-style', get_stylesheet_uri(), array( 'dz-fonts' ), DZ_VERSION );
}
add_action( 'wp_enqueue_scripts', 'dz_enqueue_scripts' );