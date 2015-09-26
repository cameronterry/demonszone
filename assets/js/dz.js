( function ( $ ) {
	
	/** Responsive Embeds for the website. */
	var response_embed = function () {
		$( '.oembed-wrapper' ).each( function () {
			var container_width = $( this ).outerWidth();

			var $iframe = $( 'iframe', this );

			var iframe_width = $iframe.outerWidth();
			var iframe_height = $iframe.outerHeight();
			var ratio = ( iframe_width / iframe_height );

			$iframe.width( container_width );
			$iframe.height( container_width / ratio );
		} );
	};

	$( document ).ready( function() {
		$.slidebars();
		response_embed();

		/** Jetpack Infinity Scroll logic. */
		$( document.body ).on( 'post-load', function () {
			console.log( jQuery( 'div[rel="advert"]' ) );
	        dfp.cycle();
	    } );
	} );

	/** Connect the responsive embed code to the resize event. */
	$( window ).resize( response_embed );

} )( jQuery );