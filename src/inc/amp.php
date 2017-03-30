<?php

/**
 * Google Analytics for AMP version of the websites.
 */
 function dz_amp_add_analytics() { ?>
    <amp-analytics type="googleanalytics" id="analytics1">
        <script type="application/json">
            {
                "vars": {
                    "account": "UA-46014298-2"
                },
                "triggers": {
                    "trackPageviewWithAmpdocUrl": {
                        "on": "visible",
                        "request": "pageview"
                    }
                }
            }
        </script>
    </amp-analytics>
 <?php }
 add_action( 'amp_post_template_footer', 'dz_amp_add_analytics' );

function dz_amp_google_analytics_head() { ?>
        <script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>
<?php }
add_action('amp_post_template_head', 'dz_amp_google_analytics_head');
