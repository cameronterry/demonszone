<?php

define( 'DZ_VERSION', '6.0.0-rev1' );
define( 'DZ_DB_VERSION', '28af254' );

function dz_maybe_upgrade() {
	$current_version = get_option( 'demonszone_version', null );

	if ( DZ_VERSION !== $current_version ) {
		update_option( 'demonszone_version', DZ_VERSION );
	}

	if ( DZ_DB_VERSION !== $current_version ) {
		global $wpdb;
		update_option( 'demonszone_db_version', DZ_DB_VERSION );
	}
}
add_action( 'init', 'dz_maybe_upgrade' );
