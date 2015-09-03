<?php

global $list_counter; $list_counter = 0;

function dz_list_shortcode( $args, $content = null ) {
	global $list_counter; ++$list_counter;

	/** No content, give up and move on. */
	if ( empty( $content ) ) {
		return '';
	}

	/** Show the List Item Header */
	return sprintf( '<div class="list-item list-item-%1$s"><span class="number">%1$s</span><span class="text">%2$s</span><div class="clear"></div></div>', $list_counter, $content );
}

add_shortcode( 'list_item', 'dz_list_shortcode' );