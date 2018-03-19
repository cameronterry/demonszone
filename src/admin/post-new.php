<?php

function dz_auto_schedule_script() {
    if ( 'post' !== get_post_type() ) {
        return;
    }

    global $wpdb;

    $date = $wpdb->get_var("SELECT post_date FROM $wpdb->posts WHERE post_status = 'future' AND post_type IN ('post') ORDER BY post_date_gmt DESC LIMIT 1");
    
    $post_date = strtotime( $date );
?>
    <script>
        ( function ( $ ) {
            $( document ).ready( function () {
                /** Set the time to milliseconds. */
                var last_post_date = new Date( <?php echo( ( $post_date * 1000 ) ); ?> );

                /** Correct for timezone, which for BST moves an hour. */
                last_post_date.setMinutes( last_post_date.getMinutes() + last_post_date.getTimezoneOffset() );

                /** Set the time to last post date + 2 hours. */
                last_post_date.setTime( last_post_date.getTime() + (2 * 60 * 60 * 1000 ) );

                $( '#aa' ).val( last_post_date.getFullYear() );
                $( '#mm' ).val( ( '0' + ( last_post_date.getMonth() + 1 ) ).slice( -2 ) );
                $( '#jj' ).val( last_post_date.getDate() );
                $( '#hh' ).val( last_post_date.getHours() );
                $( '#mn' ).val( last_post_date.getMinutes() );
            } );

            $( window ).load( function () {
                $( 'a.save-timestamp' ).click();
            } );
        } )( window.jQuery );
    </script>
<?php }
add_action( 'admin_head-post-new.php', 'dz_auto_schedule_script', 99 );

function dz_auto_schedule_loader() {
    
}
add_action( 'load-post-new.php', 'dz_auto_schedule_loader' );