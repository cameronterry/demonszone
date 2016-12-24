<?php
defined( 'ABSPATH' ) or die();

function dz_register_post_types() {
	$labels = array(
		'name'                => _x( 'Albums', 'Album General Name', 'demonszone' ),
		'singular_name'       => _x( 'Album', 'Album Singular Name', 'demonszone' ),
		'menu_name'           => __( 'Albums', 'demonszone' ),
		'parent_item_colon'   => __( 'Parent Album:', 'demonszone' ),
		'all_items'           => __( 'All Albums', 'demonszone' ),
		'view_item'           => __( 'View Album', 'demonszone' ),
		'add_new_item'        => __( 'Add New Album', 'demonszone' ),
		'add_new'             => __( 'Add New', 'demonszone' ),
		'edit_item'           => __( 'Edit Album', 'demonszone' ),
		'update_item'         => __( 'Update Album', 'demonszone' ),
		'search_items'        => __( 'Search Albums', 'demonszone' ),
		'not_found'           => __( 'Not found', 'demonszone' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'demonszone' ),
		'view_item'           => __( 'View Album', 'demonszone' ),
		'view_items'          => __( 'View Albums', 'demonszone' ),
	);

	$args = array(
		'label'               => __( 'albums', 'demonszone' ),
		'description'         => __( 'Album Reviews', 'demonszone' ),
		'labels'              => $labels,
		'supports'            => array( 'thumbnail', 'title', 'editor', 'excerpt', 'publicize', 'author', 'comments', 'revisions' ),
		'taxonomies'          => array( 'genres' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => '',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
		'show_in_rest'        => true,
		'rest_base'           => 'albums',
	);

	register_post_type( 'albums', $args );

	$labels = array(
		'name'                => _x( 'Gigs', 'Gig General Name', 'demonszone' ),
		'singular_name'       => _x( 'Gig', 'Gig Singular Name', 'demonszone' ),
		'menu_name'           => __( 'Gigs', 'demonszone' ),
		'parent_item_colon'   => __( 'Parent Gig:', 'demonszone' ),
		'all_items'           => __( 'All Gigs', 'demonszone' ),
		'view_item'           => __( 'View Gig', 'demonszone' ),
		'add_new_item'        => __( 'Add New Gig', 'demonszone' ),
		'add_new'             => __( 'Add New', 'demonszone' ),
		'edit_item'           => __( 'Edit Gig', 'demonszone' ),
		'update_item'         => __( 'Update Gig', 'demonszone' ),
		'search_items'        => __( 'Search Gigs', 'demonszone' ),
		'not_found'           => __( 'Not found', 'demonszone' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'demonszone' ),
	);

	$args = array(
		'label'               => __( 'gigs', 'demonszone' ),
		'description'         => __( 'Gig Reviews', 'demonszone' ),
		'labels'              => $labels,
		'supports'            => array( 'thumbnail', 'title', 'editor', 'excerpt', 'publicize', 'author', 'comments', 'revisions' ),
		'taxonomies'          => array( 'genres' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => '',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
	);

	register_post_type( 'gigs', $args );
}
