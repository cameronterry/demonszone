<?php

/**
 * Takes the Artists associated with the Post and then
 * finds Albums.
 */
function dz_get_related_albums() {
	$artists = get_the_terms( get_the_ID(), 'artist' );
	$query = null;

	if ( false === empty( $artists ) && false === is_wp_error( $artists ) ) {
		$term_ids = wp_list_pluck( $artists, 'term_id' );

		$query = new WP_Query( array(
			'tax_query' => array(
				'taxonomy' => 'artist',
				'terms' => $term_ids
			)
		) );
	}

	return $query;
}

function dz_title() {
	printf( '<%1$s class="site-title"><a href="%2$s">%3$s</a></%1$s>',
		( is_front_page() && is_home() ? 'h1' : 'p' ),
		esc_url( home_url( '/' ) ),
		get_bloginfo( 'name' ) );
}