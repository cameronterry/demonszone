<?php
defined( 'ABSPATH' ) or die();

function dz_get_gigs( $count, $page = 1 ) {
	return new WP_Query( array(
		'paged' => $page,
		'post_type' => 'gigs',
		'posts_per_page' => $count
	) );
}

function dz_get_posts_by_cat( $slug, $count, $page = 1 ) {
	return new WP_Query( array(
		'paged' => $page,
		'category_name' => $slug,
		'posts_per_page' => $count
	) );
}
