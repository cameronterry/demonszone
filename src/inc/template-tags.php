<?php

function dz_the_rating() {
	$rating = intval( get_field( 'rating' ) );
	printf( '%1$s / 10', $rating );
}
