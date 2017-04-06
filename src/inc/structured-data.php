<?php

function dz_structured_data() {
	if ( is_singular( 'albums' ) ) {
		dz_albums_sd();
	}
}
add_action( 'wp_head', 'dz_structured_data' );

function dz_albums_sd() { ?>
	<script type="application/ld+json">
		{
			"@context": "http://schema.org/",
			"@type": "Review",
			"datePublished": "<?php the_time( 'c' ); ?>",
			"description": "<?php dz_the_first_par(); ?>",
			"itemReviewed": {
				"@type": "MusicAlbum",
				"name": "<?php the_title(); ?>",
				"datePublished": "<?php dz_album_release_date( 'Y-m-d' ); ?>",
				"sameAs": "<?php the_permalink(); ?>",
				"byArtist": {
					"name": "<?php dz_the_artist(); ?>"
				}
			},
			"author": {
				"@type": "Person",
				"name": "<?php echo( get_the_author() ); ?>"
			},
			"reviewRating": {
				"@type": "Rating",
				"ratingValue": "<?php the_field( 'rating' ); ?>",
				"bestRating": "10",
				"worstRating": "1"
			},
			"publisher": {
				"@type": "Organization",
				"name": "DemonsZone.com",
				"url": "https://demonszone.com/"
			}
		}
	</script>
<?php }

function dz_news_sd() { ?>
	<script type="application/ld+json">
		{
		"@context": "http://schema.org",
		"@type": "NewsArticle",
		"mainEntityOfPage": {
			"@type": "WebPage",
			"@id": "https://google.com/article"
		},
		"headline": "Article headline",
		"image": {
			"@type": "ImageObject",
			"url": "https://google.com/thumbnail1.jpg",
			"height": 800,
			"width": 800
		},
		"datePublished": "2015-02-05T08:00:00+08:00",
		"dateModified": "2015-02-05T09:20:00+08:00",
		"author": {
			"@type": "Person",
			"name": "John Doe"
		},
		"publisher": {
			"@type": "Organization",
			"name": "DemonsZone.com",
			"logo": {
				"@type": "ImageObject",
				"url": "https://google.com/logo.jpg",
				"width": 600,
				"height": 60
			}
		},
		"description": "A most wonderful article"
		}
	</script>
<?php }
