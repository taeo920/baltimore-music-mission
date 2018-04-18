<?php

/**
 * Post Type Declaration
 */
$labels = array(
	'name' => 'Artists',
	'singular_name' => 'Artist',
	'add_new' => 'Add New',
	'add_new_item' => 'Add New Artist',
	'edit_item' => 'Edit Artist',
	'new_item' => 'New Artist',
	'view_item' => 'View Artist',
	'search_items' => 'Search Artists',
	'not_found' => 'No Artists Found',
	'not_found_in_trash' => 'No Artists Found in Trash',
	'menu_name' => 'Artists'
);

$args = array(
	'labels' => $labels,
	'description' => '',
	'public' => true,
	'exclude_from_search' => false,
	'publicly_queryable' => true,
	'show_ui' => true,
	'show_in_nav_menus' => true,
	'show_in_menu' => true,
	'show_in_admin_bar' => true,
	'menu_position' => 10,
	'menu_icon' => 'dashicons-format-audio', // https://developer.wordpress.org/resource/dashicons/
	'capability_type' => 'post',
	'hierarchical' => true,
	'supports' => array( 'title', 'editor', 'thumbnail' ),
	'taxonomies' => array(),
	'has_archive' => true,
	'rewrite' => array('slug' => 'artists')
);

register_post_type('artist', $args );

/**
 * Custom Title Placeholder
 */
function mg_artist_change_title_placeholder( $title ){
     $screen = get_current_screen();
     if ( $screen->post_type == 'artist' ) {
          $title = 'Enter arist name here';
     }
     return $title;
}
add_filter('enter_title_here', 'mg_artist_change_title_placeholder');