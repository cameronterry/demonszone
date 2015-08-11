<?php

function dz_album_artist() {
    dz_the_term( 'artist' );
}

function dz_album_artist_permalink() {
	dz_the_term( 'artist', '<a href="%2$s">%1$s</a>' );
}

function dz_album_rating( $prefix = 'Rating : ', $sep = ' / ' ) {
	printf( '%3$s<span itemprop="ratingValue">%1$s</span>%2$s<span itemprop="bestRating">10</span>', get_field( 'rating' ), $sep, $prefix );
}

function dz_album_release_date( $format = null ) {
	$release = DateTime::createFromFormat( 'Ymd', get_field( 'release_date' ) );
	echo( $release->format( null === $format ? get_option( 'date_format' ) : $format ) );
}

function dz_get_pings() {
    $comment_query = new WP_Comment_Query();
    $comments = $comment_query->query( array(
        'number' => 20,
        'post_id' => get_the_ID(),
        'type' => 'pings'
    ) );

    if ( empty( $comments ) ) {
        return array();
    }

    return $comments;
}

function dz_the_slug_line() {
    dz_the_term();
}

function dz_the_term( $taxonomy = 'category', $pattern = null ) {
    $terms = get_the_terms( get_the_ID(), $taxonomy );
    
    if ( false === empty( $terms ) ) {
        $term = current( $terms );

        if ( empty( $pattern ) === false ) {
            printf( '<a href="%2$s">%1$s</a>', $term->name, get_term_link( $term, $pattern ) );
        }
        else {
            echo( $term->name );
        }
    }
}

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
			'post__not_in' => array( get_the_ID() ),
			'post_type' => 'albums',
			'posts_per_page' => 5,
			'tax_query' => array(
				array( 'taxonomy' => 'artist', 'terms' => $term_ids )
			)
		) );
	}

	return $query;
}

function dz_get_albums_by_genres() {
	$artists = get_the_terms( get_the_ID(), 'artist' );
	$genres = get_the_terms( get_the_ID(), 'genres' );
	$query = null;

	if ( false === empty( $genres ) && false === is_wp_error( $genres ) ) {
		$term_ids = wp_list_pluck( $genres, 'term_id' );
		$term_artist_ids = wp_list_pluck( $artists, 'term_id' );

		$query = new WP_Query( array(
			'post_type' => 'albums',
			'posts_per_page' => 5,
			'tax_query' => array(
				'relation' => 'AND',
				array( 'taxonomy' => 'genres', 'terms' => $term_ids ),
				array( 'taxonomy' => 'artist', 'terms' => $term_artist_ids, 'operator' => 'NOT IN' )
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