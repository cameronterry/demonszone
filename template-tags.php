<?php

function dz_title() {
	printf( '<%1$s class="site-title"><a href="%2$s">%3$s</a></%1$s>',
		( is_front_page() && is_home() ? 'h1' : 'p' ),
		esc_url( home_url( '/' ) ),
		get_bloginfo( 'name' ) );
}