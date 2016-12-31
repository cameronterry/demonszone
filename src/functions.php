<?php
defined( 'ABSPATH' ) or die();

define( 'DZ_VERSION', '6.0.0-rev1' );
define( 'DZ_DB_VERSION', '28af254' );
define( 'DZ_REWRITE_VERSION', '1.0.1' );

define( 'DZ_INC', get_stylesheet_directory() );

/** Include the custom content types as well as custom fields. */
require_once( DZ_INC . '/inc/post-types.php' );
require_once( DZ_INC . '/inc/taxonomies.php' );

require_once( DZ_INC . '/inc/development.php' );
require_once( DZ_INC . '/inc/embeds.php' );
require_once( DZ_INC . '/inc/pre-get-posts.php' );
require_once( DZ_INC . '/inc/shortcodes.php' );
require_once( DZ_INC . '/inc/template-tags.php' );

require_once( DZ_INC . '/admin/columns.php' );
require_once( DZ_INC . '/admin/fields.php' );

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
	add_image_size( 'dz-rectangle-medium', 400, 225, true );
}
add_action( 'after_setup_theme', 'dz_setup' );
