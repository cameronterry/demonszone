<?php
defined( 'ABSPATH' ) or die();

function dz_pre_get_posts( $query ) {
	if ( is_admin() ) {
		return;
	}

	if ( is_post_type_archive( 'albums' ) ) {
		$query->set( 'posts_per_page', 15 );
	}
}
add_action( 'pre_get_posts', 'dz_pre_get_posts' );
