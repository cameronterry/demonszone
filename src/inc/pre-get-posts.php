<?php
defined( 'ABSPATH' ) or die();

function dz_pre_get_posts( $query ) {
	if ( is_admin() ) {
		return;
	}

	if ( is_home() && $query->is_main_query() ) {
		$query->set( 'posts_per_page', 12 );
	}

	if ( is_post_type_archive( 'albums' ) || $query->is_tax( 'genres' ) ) {
		$query->set( 'posts_per_page', 16 );
	}

	if ( $query->is_tax( 'artist' ) && $query->is_main_query() ) {
		$query->set( 'post_type', 'post' );
		$query->set( 'posts_per_page', 8 );
	}
}
add_action( 'pre_get_posts', 'dz_pre_get_posts' );
