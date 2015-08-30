<?php

function dz_infinity_scroll() {
	while( have_posts() ) {
		the_post();
		get_template_part( 'content', get_post_format() );
	}
}