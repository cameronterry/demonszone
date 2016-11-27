<?php
defined( 'ABSPATH' ) or die();

define( 'DZ_VERSION', '6.0.0-rev1' );
define( 'DZ_DB_VERSION', '28af254' );
define( 'DZ_REWRITE_VERSION', '1.0.1' );

define( 'DZ_INC', get_stylesheet_directory() . '/inc' );

/** Include the custom content types as well as custom fields. */
require_once( DZ_INC . '/fields.php' );
require_once( DZ_INC . '/post-types.php' );
require_once( DZ_INC . '/taxonomies.php' );

require_once( DZ_INC . '/development.php' );
require_once( DZ_INC . '/embeds.php' );
require_once( DZ_INC . '/shortcodes.php' );
require_once( DZ_INC . '/template-tags.php' );

function dz_enqueue_scripts() {
	$is_min = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min' );

	wp_register_style( 'roboto', 'https://fonts.googleapis.com/css?family=Roboto:400,700,900&subset=latin,cyrillic,latin-ext,cyrillic-ext', null, null );
	wp_enqueue_style( 'demonszone', get_template_directory_uri() . '/style.css', array( 'roboto' ), DZ_VERSION );
}
add_action( 'wp_enqueue_scripts', 'dz_enqueue_scripts' );

function dz_maybe_upgrade() {
	/** Handle Post Types. */
	dz_register_post_types();
	dz_register_taxonomies();

	if ( update_option( 'dz_rewrite_version', DZ_REWRITE_VERSION ) ) {
		flush_rewrite_rules( false );
	}
}
add_action( 'init', 'dz_maybe_upgrade' );

function dz_setup() {
	/** Set the various image sizes. */
	add_image_size( 'dz-square-medium', 400, 400, true );
}
add_action( 'after_setup_theme', 'dz_setup' );
