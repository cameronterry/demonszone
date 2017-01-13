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
require_once( DZ_INC . '/inc/lazy-load.php' );
require_once( DZ_INC . '/inc/pre-get-posts.php' );
require_once( DZ_INC . '/inc/queries.php' );
require_once( DZ_INC . '/inc/shortcodes.php' );
require_once( DZ_INC . '/inc/template-tags.php' );

require_once( DZ_INC . '/admin/columns.php' );
require_once( DZ_INC . '/admin/fields.php' );

function dz_enqueue_scripts() {
	$is_min = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min' );

	wp_register_style( 'roboto', 'https://fonts.googleapis.com/css?family=Roboto:400,700,900&subset=latin,cyrillic,latin-ext,cyrillic-ext', null, null );
	wp_enqueue_style( 'demonszone', get_template_directory_uri() . '/style.css', array( 'roboto' ), DZ_VERSION );

	$deps = array( 'jquery' );

	if ( false === is_admin_bar_showing() ) {
		$deps = null;
		wp_deregister_script( 'jquery' );
	}

	wp_enqueue_script( 'demonszone', get_stylesheet_directory_uri() . "/dz{$is_min}.js", $deps, DZ_VERSION );
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
	add_image_size( 'dz-rectangle-small', 240, 135, true );

	/**
	 * Remove emoji which is not required for DemonsZone. It will also reduce
	 * the page weight (in MBs).
	 */
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
}
add_action( 'after_setup_theme', 'dz_setup' );
