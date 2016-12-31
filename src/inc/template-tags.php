<?php

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

function dz_purchase_get_format() {
	$formats = get_sub_field_object( 'format' );
	$formats = $formats['choices'];
	return $formats[get_sub_field( 'format' )];
}

function dz_purchase_the_format() {
	echo( dz_purchase_get_format() );
}

function dz_purchase_the_links() {
	echo( '<p style="font-weight:bold;">Buy Now : ' );

	while ( have_rows( 'purchasing' ) ) {
		the_row();

		printf( '<a href="%1$s" rel="nofollow" title="%3$s">%2$s</a>&nbsp;', get_sub_field( 'url' ), dz_purchase_get_format(), get_sub_field( 'description' ) );
	}

	echo( '</p>' );
}

function dz_the_rating() {
	$rating = intval( get_field( 'rating' ) );
	printf( '%1$s / 10', $rating );
}
