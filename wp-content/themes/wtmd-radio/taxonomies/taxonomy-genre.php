<?php

/**
 * Taxonomy Declaration
 */
$labels = array(
	'name' => 'Genres',
	'singular_name' => 'Genre',
	'search_terms' => 'Search Genres',
	'popular_terms' => 'Popular Genres',
	'all_items' => 'All Genres',
	'parent_item' => 'Parent Genre',
	'parent_item_colon' => 'Parent Genre:',
	'edit_item' => 'Edit Genre',
	'update_item' => 'Update Genre',
	'add_new_item' => 'Add New Genre',
	'new_item_name' => 'New Genre Name',
	'separate_items_with_commas' => 'Separate genres with commas',
	'add_or_remove_items' => 'Add or remove genres',
	'choose_from_most_used' => 'Choose from the most used genres',
	'menu_name' => 'Genres'
);

$args = array(
	'labels' => $labels,
	'public' => true,
	'show_in_nav_menus' => true,
	'show_ui' => true,
	'hierarchical' => true
);

register_taxonomy('genre', 'artist', $args );