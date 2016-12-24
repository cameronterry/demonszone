<?php

function dz_columns_headers( $defaults ) {
	return array_merge( $defaults, array(
		'release_date' => 'Release Date',
		'rating' => 'Rating',
		'feature_image' => 'Feature Image',
	) );
}
add_filter( 'manage_albums_posts_columns', 'dz_columns_headers' );

function dz_columns_contents( $column_name, $post_id ) {
	if ( 'release_date' === $column_name ) {
		$release_date = get_field( 'release_date' );

		if ( false === empty( $release_date ) ) {
			$date = DateTime::createFromFormat( 'Ymd', $release_date );
			echo( $date->format( get_option( 'date_format' ) ) );
		}
		else {
			dz_columns_contents_none( 'This album has no release date set.' );
		}
	}
	else if ( 'rating' === $column_name ) {
		$rating = get_field( 'rating' );

		if ( false === empty( $rating ) ) {
			printf( '%1$s / 10', $rating );
		}
		else {
			dz_columns_contents_none( 'This album review does not have a rating.' );
		}
	}
	else if ( 'feature_image' === $column_name ) {
		if ( has_post_thumbnail() ) {
			echo( 'Yes' );
		}
		else {
			dz_columns_contents_none( 'No feature image has been set.', 'NO' );
		}
	}
}
add_action( 'manage_albums_posts_custom_column', 'dz_columns_contents', 10, 2 );

function dz_columns_sortable( $columns ) {
	$columns['rating'] = 'dz_rating';
	$columns['release_date'] = 'dz_release_date';
	return $columns;
}
add_filter( 'manage_edit-albums_sortable_columns', 'dz_columns_sortable', 10, 1 );

function dz_columns_contents_none( $title = '', $text = 'NONE' ) {
	printf( '<strong style="color:#CC0000;" title="%2$s">%1$s</strong>', esc_html( $text ), esc_attr( $title ) );
}

function dz_admin_pre_get_posts( $query ) {
	if ( is_admin() && $query->is_main_query() && ( $orderby = $query->get( 'orderby' ) ) ) {
		if ( 'dz_rating' === $orderby ) {
			$query->set( 'meta_key', 'rating' );
			$query->set( 'meta_type', 'numeric' );
		}
		else if ( 'dz_release_date' === $orderby ) {
			$query->set( 'meta_key', 'release_date' );
			$query->set( 'meta_type', 'datetime' );
		}

		$query->set( 'orderby', 'meta_value' );
	}
}
add_action( 'pre_get_posts', 'dz_admin_pre_get_posts' );
