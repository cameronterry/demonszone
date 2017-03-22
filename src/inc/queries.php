<?php
defined( 'ABSPATH' ) or die();

function dz_get_albums( $count = 10 ) {
	$args = array(
		'meta_key' => 'rating',
		'meta_value' => $rating,
		'posts_per_page' => $count,
		'post_type' => 'albums'
	);

	return dz_return_wp_query( $args );
}

/**
 * Retrieves a collection of albums by a specific artist. Unlike other Albums
 * query functions, this will return all albums unless a count is specified.
 */
function dz_get_albums_by_artist( $artist, $count = null, $order_by_rating = false ) {
	$args = array(
		'meta_key' => 'rating',
		'meta_value' => $rating,
		'orderby'  => array(),
		'posts_per_page' => -1,
		'post_type' => 'albums',
		'tax_query' => array(
			array(
				'field' => 'term_id',
				'taxonomy' => 'artist',
				'terms' => array( $artist )
			)
		)
	);

	/** Override the number of posts if provided. */
	if ( false === empty( $count ) ) {
		$args['posts_per_page'] = $count;
	}

	/** If we are to Order by the album's rating as well as Post Date. */
	if ( $order_by_rating ) {
		$args['orderby']['meta_value_num'] = 'DESC';
	}

	$args['orderby']['post_date'] = 'DESC';

	return dz_return_wp_query( $args );
}

function dz_get_albums_by_rating( $rating, $count, $order_by_rating = false ) {
	$args = array(
		'orderby'  => array(),
		'post_type' => 'albums',
		'posts_per_page' => $count
	);

	if ( is_array( $rating ) ) {
		$args['meta_query'] = array(
			array(
				'compare' => 'BETWEEN',
				'key' => 'rating',
				'type' => 'NUMERIC',
				'value' => $rating,
			)
		);
	}
	else {
		$args['meta_key'] = 'rating';
		$args['meta_value'] = $rating;
	}

	if ( $order_by_rating ) {
		$args['orderby']['meta_value_num'] = 'DESC';
	}

	$args['orderby']['post_date'] = 'DESC';

	return dz_return_wp_query( $args );
}

function dz_get_gigs( $count, $page = 1 ) {
	return dz_return_wp_query( array(
		'paged' => $page,
		'post_type' => 'gigs',
		'posts_per_page' => $count
	) );
}

function dz_get_posts_by_cat( $slug, $count, $page = 1 ) {
	return dz_return_wp_query( array(
		'paged' => $page,
		'category_name' => $slug,
		'posts_per_page' => $count
	) );
}

/**
 * A helper function used by all the above. This is mainly to ensure that human
 * error doesn't forget to utilise the update_post_thumbnail_cache(). For these
 * functions and for DemonsZone, there will always be thumbnails in use.
 */
function dz_return_wp_query( $args ) {
	$query = new WP_Query( $args );
	update_post_thumbnail_cache( $query );

	return $query;
}
