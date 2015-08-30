<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<?php do_action( 'body_open' ); ?>
	<div id="sb-site">
		<div class="demonszone">
			<header>
				<nav class="navigation">
		            <div class="sb-toggle-left navbar-left">
						<a class="dashicons dashicons-menu" href="#"></a>
						<h1 class="site-name">
							<a href="<?php echo( home_url( '/' ) ); ?>"><?php echo( get_bloginfo( 'name' ) ); ?></a>
						</h1>
					</div>
		        </nav>
			</header>