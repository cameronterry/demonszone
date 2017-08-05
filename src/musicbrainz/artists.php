<?php
defined( 'ABSPATH' ) or die();

function dz_mbz_get_artist_data( $mbid, $term_id ) {
    $url = sprintf( 'https://musicbrainz.org/ws/2/artist/%1$s?inc=url-rels&fmt=json', $mbid );

    $response = wp_remote_get( $url, [
        'user-agent' => 'DemonsZone/2017.01.01 (https://demonszone.com)'
    ] );

    $httpcode = wp_remote_retrieve_response_code( $response );

    if ( 200 === $httpcode ) {
        $response = json_decode( wp_remote_retrieve_body( $response ) );

        if ( isset( $response->error ) ) {
            $complete = 'no';
        }
        else {
            $urls = wp_list_pluck( $response->relations, 'url' );

            foreach ( $urls as $url ) {
                $meta_key = '';

                if ( false !== stripos( $url->resource, 'facebook.com' ) ) {
                    $meta_key = 'facebook_url';
                }
                else if ( false !== stripos( $url->resource, 'metal-archives.com' ) ) {
                    $meta_key = 'metalarchives_url';
                }
                else if ( false !== stripos( $url->resource, 'twitter.com' ) ) {
                    $meta_key = 'twitter_url';
                }
                else if ( false !== stripos( $url->resource, 'wikipedia.org' ) ) {
                    $meta_key = 'wikipedia_url';
                }
                else if ( false !== stripos( $url->resource, 'spotify.com' ) ) {
                    $meta_key = 'spotify_url';
                }
                else if ( false !== stripos( $url->resource, 'itunes.apple.com' ) ) {
                    $meta_key = 'itunes_url';
                }

                if ( false === empty( $meta_key ) ) {
                    update_term_meta( $term_id, $meta_key, $url->resource );
                }
            }

            update_term_meta( $term_id, 'country', $response->country );

            $complete = 'yes';
        }

        update_term_meta( $term_id, 'musicbrainz_complete', $complete );
    }
}

function dz_mbz_find_artist_mbid( $artist_name ) {
    $url = 'https://musicbrainz.org/ws/2/artist/';

    $args = [
        'query' => sprintf( 'artist:"%1$s"', urlencode( $artist_name ) ),
        'fmt' => 'json',
        'limit' => 5
    ];

    $url = add_query_arg( $args, $url );

    $response = wp_remote_get( $url, [
        'user-agent' => 'DemonsZone/2017.01.01 (https://demonszone.com)'
    ] );

    $httpcode = wp_remote_retrieve_response_code( $response );
    $artists = [];

    error_log( sprintf( 'MBZ HTTP: %1$s response was "%2$s"', $url, $httpcode ), 0 );

    if ( 200 === $httpcode ) {
        $response = json_decode( wp_remote_retrieve_body( $response ) );

        if ( isset( $response->artists ) ) {
            foreach ( $response->artists as $artist ) {
                if ( 90 < intval( $artist->score ) ) {
                    $record = [
                        'mbid' => $artist->id,
                        'name' => $artist->name,
                        'country' => $artist->country
                    ];

                    if ( $artist->tags ) {
                        $record['tags'] = wp_list_pluck( $artist->tags, 'name' );
                    }

                    $artists[] = $record;
                }
            }
        }
        else {
            error_log( sprintf( 'MBZ HTTP: unexpected response; %1$s', print_r( $response, true ) ), 0 );
        }
    }

    return $artists;
}

function dz_mbz_process_artists_data() {
    $query = new WP_Term_Query( [
        'fields' => 'id=>name',
        'hide_empty' => false,
        'number' => 20,
        'taxonomy' => 'artist',
        'meta_query' => [
            [
                'key' => 'musicbrainz_complete',
                'compare' => 'NOT EXISTS'
            ],
            [
                'key' => 'musicbrainz_processed',
                'value' => 'yes'
            ]
        ]
    ] );

    foreach ( $query->terms as $id => $name ) {
        $mbid = get_term_meta( $id, 'mbid', true );

        if ( false === empty( $mbid ) ) {
            dz_mbz_get_artist_data( $id, $mbid );
        }
    }
}
// add_action( 'dz_musicbrainz_cron', 'dz_mbz_process_artists_data' );

function dz_mbz_process_artists_mbids() {
    $query = new WP_Term_Query( [
        'fields' => 'id=>name',
        'hide_empty' => false,
        'number' => 5,
        'taxonomy' => 'artist',
        'meta_query' => [
            [
                'key' => 'mbid',
                'compare' => 'NOT EXISTS'
            ],
            [
                'key' => 'musicbrainz_processed',
                'compare' => 'NOT EXISTS'
            ]
        ]
    ] );

    if ( false === empty( $query->terms ) ) {
        foreach ( $query->terms as $id => $name ) {
            $records = dz_mbz_find_artist_mbid( $name );
            update_term_meta( $id, 'musicbrainz_processed', $processed_val );

            if ( false === empty( $records ) ) {
                if ( 1 === count( $records ) ) {
                    update_term_meta( $id, 'mbid', $records[0]['mbid'] );
                }

                update_term_meta( $id, 'musicbrainz_artists', $records );
            }
        }
    }
}
if ( false === defined( 'DISABLE_MUSICBRAINZ' ) || false === DISABLE_MUSICBRAINZ ) {
    add_action( 'dz_musicbrainz_cron', 'dz_mbz_process_artists_mbids' );
}
