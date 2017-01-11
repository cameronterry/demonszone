<?php
defined( 'ABSPATH' ) or die();

function dz_get_gigs( $count ) {
	return new WP_Query( array(
		'post_type' => 'gigs',
		'posts_per_page' => $count
	) );
}

function dz_get_posts( $slug, $count ) {
	return new WP_Query( array(
		'category_name' => $slug,
		'posts_per_page' => $count
	) );
}
