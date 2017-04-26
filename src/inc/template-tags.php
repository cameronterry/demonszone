<?php
defined( 'ABSPATH' ) or die();

function dz_album_release_date( $format = null ) {
    $release = DateTime::createFromFormat( 'Ymd', get_field( 'release_date' ) );
    echo( $release->format( null === $format ? get_option( 'date_format' ) : $format ) );
}

function dz_get_first_par() {
    $str = wpautop( get_the_content() );
    $str = substr( $str, 0, strpos( $str, '</p>' ) + 4 );
    $str = strip_tags( $str, '<a><strong><em>' );

    return $str;
}

function dz_the_first_par() {
	echo( dz_get_first_par() );
}

function dz_the_related_posts() { ?>
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<ins class="adsbygoogle"
		     style="display:block"
		     data-ad-format="autorelaxed"
		     data-ad-client="ca-pub-1085868034675667"
		     data-ad-slot="8611802378"></ins>
	<script>
		(adsbygoogle = window.adsbygoogle || []).push({});
	</script>
<?php }

function dz_post_class( $class = '', $post_id = null ) {
	$post = get_post( $post_id );
	$classes = array( $class, 'hentry' );

	$classes[] = 'post-' . $post->ID;
	$classes[] = 'type-' . $post->post_type;

	if ( current_theme_supports( 'post-thumbnails' ) && has_post_thumbnail( $post->ID ) ) {
		$classes[] = 'has-post-thumbnail';
	}

	printf( 'class="%1$s"', join( ' ', $classes ) );
}

function dz_purchase_get_format() {
	$formats = get_sub_field_object( 'format' );
	$formats = $formats['choices'];
	return $formats[get_sub_field( 'format' )];
}

function dz_purchase_the_format() {
	echo( dz_purchase_get_format() );
}

function dz_purchase_get_store() {
	$stores = get_sub_field_object( 'store' );
	$stores = $stores['choices'];
	return $stores[get_sub_field( 'store' )];
}

function dz_purchase_the_store() {

}

function dz_purchase_the_links() {
	echo( '<p style="font-weight:bold;">Buy Now : ' );

	while ( have_rows( 'purchasing' ) ) {
		the_row();

		printf( '<a href="%1$s" rel="nofollow" title="%3$s">%2$s</a>&nbsp;', get_sub_field( 'url' ), dz_purchase_get_format(), get_sub_field( 'description' ) );
	}

	echo( '</p>' );
}

function dz_the_artist() {
    dz_the_term( 'artist' );
}

function dz_the_cat_name( $slug ) {
	$cat = get_category_by_slug( $slug );

	if ( false === empty( $cat ) ) {
		printf( '<a href="%2$s">%1$s</a>', $cat->name, get_category_link( $cat->term_id ) );
	}
}

function dz_the_embed_site_title() {
    $site_title = sprintf(
        '<a href="%s?utm_source=embed" target="_top"><img src="%s" srcset="%s 2x" width="32" height="32" alt="" class="wp-embed-site-icon"/><span>%s</span></a>',
        esc_url( home_url() ),
        esc_url( get_site_icon_url( 32, admin_url( 'images/w-logo-blue.png' ) ) ),
        esc_url( get_site_icon_url( 64, admin_url( 'images/w-logo-blue.png' ) ) ),
        esc_html( get_bloginfo( 'name' ) )
    );

    $site_title = '<div class="wp-embed-site-title">' . $site_title . '</div>';

    echo apply_filters( 'embed_site_title_html', $site_title );
}

function dz_the_entry_meta() {
	printf( '<span class="byline"><span class="author vcard"><span class="screen-reader-text">%1$s </span> <a class="url fn n" href="%2$s">%3$s</a></span></span>',
		_x( 'Author', 'Used before post author name.', 'twentysixteen' ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		get_the_author()
	);
}

function dz_the_rating() {
	$rating = intval( get_field( 'rating' ) );
	printf( '%1$s / 10', $rating );
}

function dz_the_section_category( $taxonomy, $size, $prefix = 'News - ' ) {
	$section_posts = dz_get_posts_by_cat( $taxonomy, $size );

?>
	<section class="site-main clear">
		<header class="page-header">
			<h2 class="page-title"><?php echo( $prefix ); dz_the_cat_name( $taxonomy ); ?> :</h2>
		</header><!-- .page-header -->

		<?php while ( $section_posts->have_posts() ) : $section_posts->the_post(); ?>
			<?php get_template_part( 'template-parts/cell', 'post' ); ?>
		<?php endwhile; ?>
	</section>
<?php }

function dz_the_term( $taxonomy = 'category', $pattern = null ) {
    $terms = get_the_terms( get_the_ID(), $taxonomy );

    if ( false === empty( $terms ) ) {
        $term = current( $terms );

        if ( empty( $pattern ) === false ) {
            printf( '<a href="%2$s">%1$s</a>', $term->name, get_term_link( $term, $pattern ) );
        }
        else {
            echo( $term->name );
        }
    }
}
