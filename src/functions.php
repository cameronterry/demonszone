<?php

define( 'DZ_VERSION', '6.0.0-rev1' );
define( 'DZ_DB_VERSION', '28af254' );

define( 'DZ_INC', get_stylesheet_directory() . '/inc' );

require_once( DZ_INC . '/post-types.php' );
require_once( DZ_INC . '/shortcodes.php' );
require_once( DZ_INC . '/template-tags.php' );

function dz_enqueue_styles() {
	wp_enqueue_style( 'demonszone', get_stylesheet_uri(), array(), DZ_VERSION );
}
add_action( 'wp_enqueue_styles', 'dz_enqueue_styles' );

function dz_maybe_upgrade() {
	$current_version = get_option( 'demonszone_version', null );

	if ( DZ_DB_VERSION !== $current_version ) {
		global $wpdb;
		update_option( 'demonszone_db_version', DZ_DB_VERSION );
	}
}
add_action( 'init', 'dz_maybe_upgrade' );
