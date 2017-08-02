<?php
defined( 'ABSPATH' ) or die();

function dz_edit_form_artist_fields( $term, $taxonomy ) {
    $musicbrainz_artists = get_term_meta( $term->term_id, 'musicbrainz_artists', true );

    if ( false === empty( $musicbrainz_artists ) ) :
?>
    <tr class="form-field term-group-wrap">
        <th scope="row">
            MusicBrainz Records
        </th>
        <td>
            <?php

                foreach ( $musicbrainz_artists as $i => $artist ) {
                    printf( '<p>%4$s <a href="https://musicbrainz.org/artist/%1$s">%2$s (%3$s)</a></p>',
                        esc_attr( $artist['mbid'] ),
                        esc_html( $artist['name'] ),
                        esc_html( $artist['country'] ),
                        esc_html( $i )
                    );
                }

            ?>
        </td>
    </tr>
<?php
    endif;

    dz_edit_term_field_text( 'MBID', 'mbid', $term->term_id );
    dz_edit_term_field_text( 'Facebook URL', 'facebook_url', $term->term_id );
    dz_edit_term_field_text( 'Twitter URL', 'twitter_url', $term->term_id );
    dz_edit_term_field_text( 'Wikipedia URL', 'wikipedia_url', $term->term_id );
    dz_edit_term_field_text( 'Spotify URL', 'spotify_url', $term->term_id );
    dz_edit_term_field_text( 'Apple iTunes URL', 'itunes_url', $term->term_id );
}
add_action( 'artist_edit_form_fields', 'dz_edit_form_artist_fields', 10, 2 );

function dz_edited_artist_save( $term_id, $tag_id ) {
    if ( isset( $_POST['mbid'] ) ) {
        update_term_meta( $term_id, 'mbid', esc_attr( $_POST['mbid'] ) );
        update_term_meta( $term_id, 'musicbrainz_processed', 'yes' );

        delete_term_meta( $term_id, 'musicbrainz_artists' );
    }

    if ( isset( $_POST['facebook_url'] ) ) {
        update_term_meta( $term_id, 'facebook_url', esc_attr( $_POST['facebook_url'] ) );
    }

    if ( isset( $_POST['twitter_url'] ) ) {
        update_term_meta( $term_id, 'twitter_url', esc_attr( $_POST['twitter_url'] ) );
    }

    if ( isset( $_POST['wikipedia_url'] ) ) {
        update_term_meta( $term_id, 'wikipedia_url', esc_attr( $_POST['wikipedia_url'] ) );
    }

    if ( isset( $_POST['spotify_url'] ) ) {
        update_term_meta( $term_id, 'spotify_url', esc_attr( $_POST['spotify_url'] ) );
    }

    if ( isset( $_POST['itunes_url'] ) ) {
        update_term_meta( $term_id, 'itunes_url', esc_attr( $_POST['itunes_url'] ) );
    }
}
add_action( 'edited_artist', 'dz_edited_artist_save', 10, 2 );
