<?php
defined( 'ABSPATH' ) or die();

function demonszone_social_menu() {
    add_submenu_page(
        'index.php',
        __( 'Social', 'demonszone' ),
        __( 'Social', 'demonszone' ),
        'activate_plugins',
        'demonszone-social',
        'demonszone_social_page'
    );
}
add_action( 'admin_menu', 'demonszone_social_menu' );

function demonszone_social_page() {
    $scheduled_posts = new WP_Query( [
        'post_status' => 'future',
        'posts_per_page' => -1
    ] );

    $previous_weekday = '';
?>
    <div class="wrap">
        <h2><?php _e( 'Social Posts', 'demonszone' ); ?></h2>
        <?php if ( $scheduled_posts->have_posts() ) : ?>
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <th>Facebook</th>
                    <th>Twitter</th>
                </tr>
                <?php while ( $scheduled_posts->have_posts() ) : $scheduled_posts->the_post(); $weekday = get_the_date( 'l' ); ?>
                    <tr>
                        <td colspan="2">
                            <?php if ( $previous_weekday !== $weekday ) : $previous_weekday = $weekday; ?>
                                <h3><?php esc_html_e( sprintf( 'Day : %2$s (%1$s)', $weekday, get_the_date() ) ); ?></h3>
                            <?php endif; ?>
                            <p><strong><?php the_title(); ?></strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php esc_html_e( demonszone_social_page_generate_facebook( get_the_title(), get_the_ID() ) ); ?>
                        </td>
                        <td>
                            <?php esc_html_e( demonszone_social_page_generate_tweet( get_the_title(), get_the_ID() ) ); ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php endif; ?>
    </div>
<?php }

function demonszone_social_page_generate_facebook( $post_title, $post_id ) {
    return demonszone_social_page_generate_social_post( $post_title, $post_id, 'facebook_url', 'https://www.facebook.com/' );
}

function demonszone_social_page_generate_tweet( $post_title, $post_id ) {
    return demonszone_social_page_generate_social_post( $post_title, $post_id, 'twitter_url', 'https://twitter.com/' );
}

function demonszone_social_page_generate_social_post( $post_title, $post_id, $meta_key, $replace = '' ) {
    $social_post = $post_title;
    $artists = get_the_terms( $post_id, 'artist' );

    foreach ( $artists as $artist ) {
        $artist_handle = get_term_meta( $artist->term_id, $meta_key, true );

        if ( false === empty( $artist_handle ) && false === stripos( $artist_handle, '/pages/' ) ) {
            $artist_handle = '@' . str_ireplace( $replace, '', $artist_handle );
        }
        else {
            $artist_handle = '#' . str_ireplace( ' ', '', $artist->name );
        }

        if ( false === stripos( $social_post, $artist->name ) ) {
            $social_post .= ' ' . $artist_handle;
        }
        else {
            $social_post = str_ireplace( $artist->name, $artist_handle, $social_post );
        }
    }

    if ( '@' === substr( $social_post, 0, 1 ) && 'twitter_url' === $meta_key ) {
        $social_post = '.' . $social_post;
    }

    return $social_post . ' ' . wp_get_shortlink( $post_id );
}