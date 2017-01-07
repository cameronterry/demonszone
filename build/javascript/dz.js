( function ( $, undefined ) {

	dz = window.dz || {};

	dz.posts = {
		standardise_height : function () {
			var $posts = $( 'article.type-post' );
			var total = 0;
			var element_heights = $( 'article.type-post' ).map( function () {
				total += $( this ).height();
				return $( this ).height();
			} );

			var max_height = Math.max.apply( null, element_heights );
			$posts.height( total / element_heights.length );
		}
	};

	$( function () {
		dz.posts.standardise_height();
		$( document ).on( 'resize', 'dz.posts.standardise_height' );
	} );

} )( window.jQuery || window.Zepto );
