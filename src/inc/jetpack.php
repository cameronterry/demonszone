<?php

function dz_the_related_posts() {
	if ( class_exists( 'Jetpack_RelatedPosts' ) ) {
	    echo do_shortcode( '[jetpack-related-posts]' );
	}
}

/**
 * Remove the default implementation of Related Posts from the bottom of the
 * content. It uses the_content and lacks the control of the layout we are
 * after.
 *
 * https://jetpack.com/support/related-posts/customize-related-posts/#delete
 */
function dz_jetpack_remove_relatedposts() {
    if ( class_exists( 'Jetpack_RelatedPosts' ) ) {
        $jprp = Jetpack_RelatedPosts::init();
        $callback = array( $jprp, 'filter_add_target_to_dom' );
        remove_filter( 'the_content', $callback, 40 );
    }
}
add_filter( 'wp', 'dz_jetpack_remove_relatedposts', 20 );
