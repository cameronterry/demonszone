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

function dz_post_class( $class = '', $post_id = null ) {
	$post = get_post( $post_id );
	$classes = array( $class, 'hentry' );

	$classes[] = 'post-' . $post->ID;
	$classes[] = 'type-' . $post->post_type;

	if ( current_theme_supports( 'post-thumbnails' ) && has_post_thumbnail( $post->ID ) ) {
		$classes[] = 'has-post-thumbnail';
	}

	printf( 'class="%1$s"', join( ' ', $classes ) );
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

function dz_the_cat_name( $slug ) {
	$cat = get_category_by_slug( $slug );

	if ( false === empty( $cat ) ) {
		printf( '<a href="%2$s">%1$s</a>', $cat->name, get_category_link( $cat->term_id ) );
	}
}

function dz_the_entry_meta() {
	printf( '<span class="byline"><span class="author vcard"><span class="screen-reader-text">%1$s </span> <a class="url fn n" href="%2$s">%3$s</a></span></span>',
		_x( 'Author', 'Used before post author name.', 'twentysixteen' ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		get_the_author()
	);
}

function dz_the_rating() {
	$rating = intval( get_field( 'rating' ) );
	printf( '%1$s / 10', $rating );
}
