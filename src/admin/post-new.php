<?php

function dz_auto_schedule_script() {
    global $wpdb;

    $date = $wpdb->get_var("SELECT post_date_gmt FROM $wpdb->posts WHERE post_status = 'future' AND post_type IN ('post') ORDER BY post_date_gmt DESC LIMIT 1");
    
    $post_date = strtotime( $date );
?>
    <script>
        ( function ( $ ) {
            $( document ).ready( function () {
                /**
                aa = $('#aa').val(),
				mm = $('#mm').val(), jj = $('#jj').val(), hh = $('#hh').val(), mn = $('#mn').val();

			attemptedDate = new Date( aa, mm - 1, jj, hh, mn );
                            new Date(year, month, day, hours, minutes);
                 */

                var last_post_date = new Date( <?php echo( ( $post_date * 1000 ) ); ?> );
                last_post_date.setTime( last_post_date.getTime() + (2 * 60 * 60 * 1000 ) );
                alert( last_post_date );

                $( '#aa' ).val( last_post_date.getFullYear() );
                $( '#mm' ).val( ( '0' + last_post_date.getMonth() ).slice( -2 ) );
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