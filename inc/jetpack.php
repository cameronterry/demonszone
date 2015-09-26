<?php

function dz_infinity_scroll() {
	echo( '<div class="leaderboard"><div class="desktop" rel="advert" data-sizes="728x90"></div><div class="mobile" rel="advert" data-sizes="320x100"></div></div>' );

	while( have_posts() ) {
		the_post();

		if ( is_tax( 'genres' ) || is_post_type_archive( 'albums' ) ) {
			get_template_part( 'content', get_post_format() );
		}
		else {
			get_template_part( 'listing', get_post_type() );
		}
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

function dz_share_buttons() {
	if ( function_exists( 'sharing_display' ) ) {
	    sharing_display( '', true );
	}
}

function dz_share_remove() {
    remove_filter( 'the_content', 'sharing_display',19 );
    remove_filter( 'the_excerpt', 'sharing_display',19 );

    if ( class_exists( 'Jetpack_Likes' ) ) {
        remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
    }
}
 
add_action( 'loop_start', 'dz_share_remove' );