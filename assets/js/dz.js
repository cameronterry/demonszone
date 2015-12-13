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

	/**
	 * Method for hooking up Social Interaction tracking with Jetpack's Sharedaddy
	 * icons.
	 *
	 * Credit : https://developers.google.com/analytics/devguides/collection/analyticsjs/social-interactions
	 * Credit : http://www.statstory.com/social-tracking-with-wordpress-jetpack-google-analytics/
	 */
	var dz_jetpack_ga_social = function () {
		$( '.sharedaddy ul li a' ).each( function () {
			/**
			 * Hook up the hyperlink click button so we can track Social Interactions in
			 * Google Analytics.
			 */
			var $sharedaddy_button = $( this );

			$sharedaddy_button.click( function ( e ) {
				var $this = $( this );
				var classes = $this.attr( 'class' ).split( ' ' );
				var social_network = '';

				/**
				 * Get the name of the Social Network from the list of classes. Jetpack's Sharedaddy
				 * has a class which is prefixed with "share-" and it is always the first (for the
				 * mode "Icon Only")
				 */
				if ( 0 < classes.length ) {
					social_network = classes[0].replace( 'share-', '' ).replace( '-plus-1', '' );
				}

				if ( 'email' === social_network ) {
					return;
				}

				/** Amend Press-This to be WordPress.com */
				if ( 'press-this' === social_network ) {
					social_network = 'wordpressdotcom';
				}

				/**
				 * Handle the URL and get rid of any hash or querystring non-sense so we get a
				 * clean URL for Google Analytics.
				 *
				 * Credit: http://stackoverflow.com/a/2541083
				 */
				var url = $sharedaddy_button.attr( 'href' )

				if ( url ) {
					url = url.split( /[?#]/ )[0];
				}

				/** Deep breath! Now(!!!) send the Social Integration to Google Analytics. */
				if ( ga ) {
					ga( 'send', 'social', social_network, 'share', url );
				}
			} );
		} );
	};

	var dz_related_articles = function () {
		if ( $( document.body ).hasClass( 'single' ) && $( document.body ).hasClass( 'single-post' ) ) {
			var $paragraphs = $( '.copy p' );
			var paragraph_count = $paragraphs.length;
			var artist = ( 0 < demonszone.artist.length ? demonszone.artist[0] : false );

			/**
			 * Attempt to retrieve the related articles if the story is big enough
			 * and there is an Artist (the current mechanism for determining how
			 * related a story that is).
			 */
			if ( 8 <= paragraph_count && false !== artist ) {
				$.getJSON( demonszone.rest_url + 'wp/v2/posts?per_page=5&filter[artist]=' + artist, function ( data ) {
					var related_articles = '';
					var template = '<ul>{{.}}<li><a href="{{link}}">{{title.rendered}}</a></li>{{/.}}</ul>';

					/** We attempt to position the posts in the middle of the article. */
					var position = Math.ceil( paragraph_count / 2 );

					/**
					 * Check to see if the paragraph contains a colon or semi-colon. This would
					 * suggest that it is the paragraph before a list of tour dates or a track
					 * listing.
					 */
					if ( 0 < $paragraphs[position].innerText.indexOf( ':' ) || 0 < $paragraphs[position].innerText.indexOf( ';' ) ) {
						position--;
					}

					/** Finally, insert the related content into the article. */
					$( $paragraphs[position] ).after( '<div class="related"><h2>Related</h2>' + Mark.up( template, data ) + '</div>' );
				} );
			}
		}
	};

	$( document ).ready( function() {
		$.slidebars();

		dz_jetpack_ga_social();
		dz_related_articles();
		response_embed();

		/** Jetpack Infinity Scroll logic. */
		$( document.body ).on( 'post-load', function () {
			dz_jetpack_ga_social();
	        dfp.cycle();
	    } );
	} );

	/** Connect the responsive embed code to the resize event. */
	$( window ).resize( response_embed );

} )( jQuery );