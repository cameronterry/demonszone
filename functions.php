<?php

define( 'DZ_INC', get_template_directory() );
define( 'DZ_VERSION', '5.1.0' );
define( 'DZ_PLUGIN_ENABLE', true );

require_once( DZ_INC . '/inc/admin-enhancements.php' );
require_once( DZ_INC . '/inc/jetpack.php' );
require_once( DZ_INC . '/inc/shortcodes.php' );
require_once( DZ_INC . '/inc/template-tags.php' );

if ( false === isset( $content_width ) ) {
	$content_width = 520;
}

function dz_after_setup_theme() {
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-formats' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5' );
	add_theme_support( 'title-tag' );

	/** Jetpack Infinity Scroll */
	add_theme_support( 'infinite-scroll', array(
	    'container' => 'content',
	    'footer' => 'page',
	    'posts_per_page' => 20,
	    'render' => 'dz_infinity_scroll'
	) );

	add_image_size( 'album-small', 300, 300, true );
	add_image_size( 'album-medium', 520, 520, true );

	/** News Image Sizes */
	add_image_size( 'news-thumb-tiny', 150, 84, true );
	add_image_size( 'news-thumb', 300, 169, true );
	add_image_size( 'news-thumb-large', 840, 473, true );
	add_image_size( 'news-thumb-xlarge', 1200, 676, true );

	/** Homepage Image Sizes */
	add_image_size( 'homepage-feature', 620, 349, true );

	register_nav_menu( 'primary', __( 'Primary Menu', 'demonszone' ) );
}
add_action( 'after_setup_theme', 'dz_after_setup_theme' );

function dz_enqueue_scripts() {
	global $content_width;

	if ( is_singular( 'post' ) ) {
		$content_width = 840;
	}

	wp_enqueue_style( 'slidebars', get_stylesheet_directory_uri() . '/assets/css/slidebars.min.css', null, DZ_VERSION );
	wp_enqueue_style( 'dz-merriweather', '//fonts.googleapis.com/css?family=Merriweather:400,700,400italic,700italic,900italic,900' );
	wp_enqueue_style( 'dz-merriweather-sans', '//fonts.googleapis.com/css?family=Merriweather+Sans:400,300,700' );
	wp_enqueue_style( 'dz-style', get_stylesheet_uri(), array( 'dashicons', 'dz-merriweather', 'dz-merriweather-sans', 'slidebars' ), DZ_VERSION );

	wp_register_script( 'dfp', get_stylesheet_directory_uri() . '/assets/js/dfp.js', array( 'jquery' ), '1.3.0' );
	wp_register_script( 'slidebars', get_stylesheet_directory_uri() . '/assets/js/slidebars.min.js', array( 'jquery' ), DZ_VERSION );
	wp_register_script( 'markup-js', get_stylesheet_directory_uri() . '/assets/js/markup.js', array( 'jquery' ), DZ_VERSION );
	wp_register_script( 'dz', get_stylesheet_directory_uri() . '/assets/js/dz.js', array( 'dfp', 'jquery', 'markup-js', 'slidebars' ), DZ_VERSION );

	$demonszone_js_settings = array( 'version' => DZ_VERSION );

	/** If the JSON REST API is available, add the */
	if ( defined( 'REST_API_VERSION' ) ) {
		$demonszone_js_settings['rest_url'] = get_rest_url();
	}

	/** If a post, the put the Artists in an array so we can use them. */
	if ( is_singular( 'post' ) ) {
		$artists = wp_list_pluck( get_the_terms( get_the_ID(), 'artist' ), 'slug' );
		$demonszone_js_settings['artist'] = $artists;
	}

	wp_localize_script( 'dz', 'demonszone', $demonszone_js_settings );

	wp_enqueue_script( 'dz' );
}
add_action( 'wp_enqueue_scripts', 'dz_enqueue_scripts' );

function dz_excerpt_length() {
	return 20;
}
add_filter( 'excerpt_length', 'dz_excerpt_length', 999 );

function dz_oembed_wrapper( $html, $url, $attr, $post_ID ) {
	return sprintf( '<p class="oembed-wrapper">%1$s</p>', $html );
}
add_filter( 'embed_oembed_html', 'dz_oembed_wrapper', 10, 4 );

function dz_oembed_wrapper2( $return, $url, $attr ) {
	return sprintf( '<p class="oembed-wrapper">%1$s</p>', $return );
}
add_filter( 'embed_handler_html', 'dz_oembed_wrapper2', 10, 3 );

function dz_pre_get_posts( $query ) {
	if ( $query->is_home() && $query->is_main_query() ) {
		$query->set( 'posts_per_page', 18 );
	}

	if ( is_tax( 'genres' ) && $query->is_main_query() ) {
		$query->set( 'posts_per_page', 20 );	
	}
}
add_action( 'pre_get_posts', 'dz_pre_get_posts' );