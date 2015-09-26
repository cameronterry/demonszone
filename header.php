<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>

	<script type="text/javascript">

        ( function ( $ ) {
            $( document ).ready( function () {
                dfp.collapsable = true;
                dfp.network = '/419138208/dz';
                dfp.zone = '';

                dfp.enable();
            } );
        } )( jQuery );

    </script>

    <!-- Begin Cookie Consent plugin by Silktide - http://silktide.com/cookieconsent -->
	<script type="text/javascript">
	    window.cookieconsent_options = {
	    	'message' : 'This website uses cookies to ensure you get the best experience on our website',
	    	'dismiss' : 'Understood',
	    	'learnMore' : 'More information',
	    	'link' : '//demonszone.com/cookie-policy/',
	    	'theme' : 'dark-floating'
	    };
	</script>
	<script type="text/javascript" src="//s3.amazonaws.com/cc.silktide.com/cookieconsent.latest.min.js"></script>
	<!-- End Cookie Consent plugin -->
</head>
<body <?php body_class(); ?>>
	<?php do_action( 'body_open' ); ?>
	<div id="sb-site">
		<div class="demonszone">
			<header>
				<nav class="navigation">
		            <div class="sb-toggle-left navbar-left">
						<a class="dashicons dashicons-menu" href="#"></a>
						<a class="logo" href="<?php echo( home_url( '/' ) ); ?>">
							<img src="<?php echo( get_template_directory_uri() ); ?>/assets/img/dz-logo-495x295.png" />
							<?php if ( is_home() ) : ?>
								<h1 class="site-name">DemonsZone</h1>
							<?php else : ?>
								<div class="site-name">DemonsZone</div>
							<?php endif; ?>
						</a>
					</div>
		        </nav>
			</header>

			<div class="leaderboard">
				<div class="desktop" rel="advert" data-sizes="728x90"></div>
				<div class="mobile" rel="advert" data-sizes="320x100"></div>
			</div>