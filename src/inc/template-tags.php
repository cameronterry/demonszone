<?php

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
