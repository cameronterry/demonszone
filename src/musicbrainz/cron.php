<?php
defined( 'ABSPATH' ) or die();

function dz_mbz_cron_schedules( $schedules ) {
	$schedules['musicbrainz_schedule'] = array(
		'interval' => ( 3 * MINUTE_IN_SECONDS ),
		'display' => 'DZ Musicbrainz schedule'
	);

    return $schedules;
}
add_filter( 'cron_schedules', 'dz_mbz_cron_schedules', 20, 1 );

function dz_mbz_cron_init() {
	if ( false === wp_next_scheduled( 'dz_musicbrainz_cron' ) ) {
		wp_schedule_event( time(), 'musicbrainz_schedule', 'dz_musicbrainz_cron' );
	}
}
add_action( 'init', 'dz_mbz_cron_init' );
