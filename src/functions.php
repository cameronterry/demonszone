<?php

define( 'DZ_VERSION', '6.0.0-rev1' );
define( 'DZ_DB_VERSION', '28af254' );

define( 'DZ_INC', get_stylesheet_directory() . '/inc' );

require_once( DZ_INC . '/development.php' );
require_once( DZ_INC . '/embeds.php' );
require_once( DZ_INC . '/post-types.php' );
require_once( DZ_INC . '/shortcodes.php' );
require_once( DZ_INC . '/template-tags.php' );

function dz_enqueue_scripts() {
	$is_min = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min' );

	wp_register_style( 'twentysixteen', get_template_directory_uri() . '/style.css', null, DZ_VERSION );
	wp_register_style( 'roboto', 'https://fonts.googleapis.com/css?family=Roboto:400,700,900&subset=latin,cyrillic,latin-ext,cyrillic-ext', null, null );

	wp_enqueue_style( 'demonszone', get_stylesheet_uri(), array( 'twentysixteen', 'roboto' ), DZ_VERSION );
}
add_action( 'wp_enqueue_scripts', 'dz_enqueue_scripts' );

function dz_maybe_upgrade() {
	$current_version = get_option( 'demonszone_version', null );

	if ( DZ_DB_VERSION !== $current_version ) {
		global $wpdb;
		update_option( 'demonszone_db_version', DZ_DB_VERSION );
	}
}
add_action( 'init', 'dz_maybe_upgrade' );

function dz_setup() {
	/** Set the various image sizes. */
	// add_image_size( 'dz-news-feature', 592, 333 );
}
add_action( 'after_setup_theme', 'dz_setup' );
