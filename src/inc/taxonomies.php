<?php
defined( 'ABSPATH' ) or die();

function dz_register_taxonomies() {
	$labels = array(
	    'name'                       => _x( 'Artists', 'Taxonomy General Name', 'demonszone' ),
	    'singular_name'              => _x( 'Artist', 'Taxonomy Singular Name', 'demonszone' ),
	    'menu_name'                  => __( 'Artists', 'demonszone' ),
	    'all_items'                  => __( 'All Artists', 'demonszone' ),
	    'parent_item'                => __( 'Parent Artist', 'demonszone' ),
	    'parent_item_colon'          => __( 'Parent Artist:', 'demonszone' ),
	    'new_item_name'              => __( 'New Artist', 'demonszone' ),
	    'add_new_item'               => __( 'Add Artist', 'demonszone' ),
	    'edit_item'                  => __( 'Edit Artist', 'demonszone' ),
	    'update_item'                => __( 'Update Artist', 'demonszone' ),
	    'separate_items_with_commas' => __( 'Separate Artists with commas', 'demonszone' ),
	    'search_items'               => __( 'Search Artists', 'demonszone' ),
	    'add_or_remove_items'        => __( 'Add or remove Artists', 'demonszone' ),
	    'choose_from_most_used'      => __( 'Choose from the most used artists', 'demonszone' ),
	    'not_found'                  => __( 'Not Found', 'demonszone' ),
	);

	$args = array(
	    'labels'                     => $labels,
	    'hierarchical'               => false,
	    'public'                     => true,
	    'show_ui'                    => true,
	    'show_admin_column'          => true,
	    'show_in_nav_menus'          => true,
	    'show_tagcloud'              => true,
	);

	register_taxonomy( 'artist', array( 'post', 'albums', 'gigs' ), $args );

	$labels = array(
        'name'                       => _x( 'Genres', 'Taxonomy General Name', 'demonszone' ),
        'singular_name'              => _x( 'Genre', 'Taxonomy Singular Name', 'demonszone' ),
        'menu_name'                  => __( 'Genres', 'demonszone' ),
        'all_items'                  => __( 'All Genres', 'demonszone' ),
        'parent_item'                => __( 'Parent Genre', 'demonszone' ),
        'parent_item_colon'          => __( 'Parent Genre:', 'demonszone' ),
        'new_item_name'              => __( 'New Genre', 'demonszone' ),
        'add_new_item'               => __( 'Add Genre', 'demonszone' ),
        'edit_item'                  => __( 'Edit Genre', 'demonszone' ),
        'update_item'                => __( 'Update Genre', 'demonszone' ),
        'separate_items_with_commas' => __( 'Separate Genres with commas', 'demonszone' ),
        'search_items'               => __( 'Search Genres', 'demonszone' ),
        'add_or_remove_items'        => __( 'Add or remove Genres', 'demonszone' ),
        'choose_from_most_used'      => __( 'Choose from the most used genres', 'demonszone' ),
        'not_found'                  => __( 'Not Found', 'demonszone' ),
    );

    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => false,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );

    register_taxonomy( 'genres', array( 'post', 'albums' ), $args );

	$labels = array(
		'name'                       => _x( 'Record Labels', 'Taxonomy General Name', 'demonszone' ),
		'singular_name'              => _x( 'Record Label', 'Taxonomy Singular Name', 'demonszone' ),
		'menu_name'                  => __( 'Record Labels', 'demonszone' ),
		'all_items'                  => __( 'All Record Labels', 'demonszone' ),
		'parent_item'                => __( 'Record Label', 'demonszone' ),
		'parent_item_colon'          => __( 'Record Label:', 'demonszone' ),
		'new_item_name'              => __( 'New Record Label', 'demonszone' ),
		'add_new_item'               => __( 'Add Record Label', 'demonszone' ),
		'edit_item'                  => __( 'Edit Record Label', 'demonszone' ),
		'update_item'                => __( 'Update Record Label', 'demonszone' ),
		'view_item'                  => __( 'View Record Label', 'demonszone' ),
		'separate_items_with_commas' => __( 'Separate Record Labels with commas', 'demonszone' ),
		'add_or_remove_items'        => __( 'Add or remove Record Labels', 'demonszone' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'demonszone' ),
		'popular_items'              => __( 'Popular Record Label', 'demonszone' ),
		'search_items'               => __( 'Search Record Labels', 'demonszone' ),
		'not_found'                  => __( 'Not Found', 'demonszone' ),
		'no_terms'                   => __( 'No Record Labels', 'demonszone' ),
		'items_list'                 => __( 'Record Labels list', 'demonszone' ),
		'items_list_navigation'      => __( 'Record Labels list navigation', 'demonszone' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);

	register_taxonomy( 'record_labels', array( 'post', 'albums' ), $args );
}
