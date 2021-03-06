<?php
defined( 'ABSPATH' ) or die();

define( 'DZ_VERSION', '2017.1.1' );
define( 'DZ_DB_VERSION', '28af254' );
define( 'DZ_REWRITE_VERSION', '1.0.1' );

define( 'DZ_INC', get_stylesheet_directory() );

/** Include the custom content types as well as custom fields. */
require_once( DZ_INC . '/inc/content/post-types.php' );
require_once( DZ_INC . '/inc/content/taxonomies.php' );
require_once( DZ_INC . '/inc/content/embeds.php' );

require_once( DZ_INC . '/admin/index.php' );
require_once( DZ_INC . '/musicbrainz/index.php' );

require_once( DZ_INC . '/inc/development.php' );
require_once( DZ_INC . '/inc/jetpack.php' );
require_once( DZ_INC . '/inc/pre-get-posts.php' );
require_once( DZ_INC . '/inc/queries.php' );
require_once( DZ_INC . '/inc/shortcodes.php' );
require_once( DZ_INC . '/inc/structured-data.php' );
require_once( DZ_INC . '/inc/template-tags.php' );

function dz_enqueue_scripts() {
	$is_min = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min' );

	wp_register_style( 'roboto', 'https://fonts.googleapis.com/css?family=Roboto:400,700,900&subset=latin,cyrillic,latin-ext,cyrillic-ext', null, null );
	wp_register_style( 'twentysixteen', get_template_directory_uri() . '/style.css', null, DZ_VERSION );
	wp_register_style( 'demonszone', get_stylesheet_directory_uri() . '/style.css', array( 'roboto', 'twentysixteen' ), DZ_VERSION );
	wp_enqueue_style( 'demonszone' );
}
add_action( 'wp_enqueue_scripts', 'dz_enqueue_scripts' );

function dz_enqueue_embed_scripts() {
	wp_enqueue_style( 'demonszone-embed', get_stylesheet_directory_uri() . "/embeds.css", null, DZ_VERSION );
}
add_action( 'enqueue_embed_scripts', 'dz_enqueue_embed_scripts' );

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
