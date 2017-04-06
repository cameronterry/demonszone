<?php

function dz_amp_head() { ?>
    <script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>
	<script async custom-element="amp-ad" src="https://cdn.ampproject.org/v0/amp-ad-0.1.js"></script>
<?php }
add_action( 'amp_post_template_head', 'dz_amp_head' );

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

function dz_amp_add_adsense() {
	add_filter( 'the_content', 'dz_amp_add_adsense_slot' );
}
add_action( 'pre_amp_render_post', 'dz_amp_add_adsense' );

function dz_amp_add_adsense_slot( $content ) {
	$ad = '<amp-ad layout="fixed-height" height="250" type="adsense" data-ad-client="ca-pub-1085868034675667" data-ad-slot="2288749177"></amp-ad>';

	$paragraphs = explode( '</p>', $content );

	if ( 3 > count( $paragraphs ) ) {
		return $content;
	}

	foreach ( $paragraphs as $index => $paragraph ) {
		if ( trim( $paragraph ) ) {
			$paragraphs[$index] .= $closing_p;
		}

		if ( 0 === $index ) {
			$paragraphs[$index] .= $ad;
		}
	}

	return implode( '', $paragraphs );
}
