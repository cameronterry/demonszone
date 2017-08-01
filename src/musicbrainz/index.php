<?php
defined( 'ABSPATH' ) or die();

require_once( DZ_INC . '/musicbrainz/artists.php' );
require_once( DZ_INC . '/musicbrainz/cron.php' );

function dz_mbz_admin_sync_header( $columns ) {
    $columns['musicbrainz'] = 'MBID';

    return $columns;
}
add_filter( 'manage_edit-artist_columns' , 'dz_mbz_admin_sync_header' );

function dz_mbz_admin_sync_column( $content, $column_name, $term_id ) {
    if ( 'musicbrainz' === $column_name ) {
        $mbid = get_term_meta( $term_id, 'mbid', true );

        if ( false === empty( $mbid ) ) {
            $content = sprintf( '<a href="https://musicbrainz.org/artist/%1$s">%1$s</a>', $mbid );
        }
    }

    return $content;
}
add_filter( 'manage_artist_custom_column', 'dz_mbz_admin_sync_column', 10, 3 );
