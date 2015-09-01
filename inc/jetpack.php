<?php

function dz_infinity_scroll() {
	while( have_posts() ) {
		the_post();
		get_template_part( 'content', get_post_format() );
	}

	echo( '<div class="clearfix"></div>' );
}

function dz_infinite_scroll_archive_supported() {
	if ( is_home() || is_single() ) {
		return false;
	}

	return true;
}
add_filter( 'infinite_scroll_archive_supported', 'dz_infinite_scroll_archive_supported' );