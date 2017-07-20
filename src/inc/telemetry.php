<?php

function dz_telemetry_dashboard_setup() {
    wp_add_dashboard_widget(
        'telemetry_widget',         // Widget slug.
        'Telemetry',         // Title.
        'dz_telemetry_widget_display' // Display function.
    );
}
add_action( 'wp_dashboard_setup', 'dz_telemetry_dashboard_setup' );

function dz_telemetry_widget_display() { ?>
    <iframe src="https://telemetry.projectdarkmatter.com/ui/dashboard-solo/db/default?refresh=10s&orgId=1&panelId=4" width="390" height="300" frameborder="0"></iframe>
<?php }
