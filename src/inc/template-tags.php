<?php

function dz_the_entry_meta() {
	printf( '<span class="byline"><span class="author vcard"><span class="screen-reader-text">%1$s </span> <a class="url fn n" href="%2$s">%3$s</a></span></span>',
		_x( 'Author', 'Used before post author name.', 'twentysixteen' ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		get_the_author()
	);
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
