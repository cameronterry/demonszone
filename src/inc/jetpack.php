<?php

function dz_module_active( $module ) {
	return class_exists( 'Jetpack' ) && method_exists( 'Jetpack', 'get_active_modules' ) && in_array( $module, Jetpack::get_active_modules() );
}

/**
 * Remove the default implementation of Related Posts from the bottom of the
 * content. It uses the_content and lacks the control of the layout we are
 * after.
 *
 * https://jetpack.com/support/related-posts/customize-related-posts/#delete
 */
function dz_jetpack_remove_relatedposts() {
    if ( class_exists( 'Jetpack_RelatedPosts' ) && is_singular( 'albums' ) ) {
        $jprp = Jetpack_RelatedPosts::init();
        $callback = array( $jprp, 'filter_add_target_to_dom' );
        remove_filter( 'the_content', $callback, 40 );
    }
}
add_filter( 'wp', 'dz_jetpack_remove_relatedposts', 20 );

/**
 * Make sure Jetpack adheres to visitors who have setup "Do Not Track".
 */
add_filter( 'jetpack_honor_dnt_header_for_stats', '__return_true' );