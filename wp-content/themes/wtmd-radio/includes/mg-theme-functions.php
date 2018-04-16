<?php

/**
 * Generate a sorting link given a type of sorting
 */
function mg_the_sort_link( $type ) {
	global $paged;

	// Get URL of current page and parse it into components
	$url = html_entity_decode( get_pagenum_link( $paged ) );
	$parsed_url = parse_url( $url );

	// If a query string is present parse it into an array
	if( isset( $parsed_url['query'] ) ) {
		parse_str( $parsed_url['query'], $query );
	} else {
		$query = array();
	}

	// If the sorting type is 'date' add it to the query otherwise unset it
	if( 'date' == $type ) {
		$query['sort'] = 'date';
	} else {
		if( isset( $query['sort'] ) ) {
			unset( $query['sort'] );
		}
	}

	// Reconstruct the url from it's components
	$url = $parsed_url['scheme'] . '://' . $parsed_url['host'] . $parsed_url['path'];

	// If a query is set append it to the url
	if( $query ) {
		$url .= '?' . http_build_query( $query );
	}

	echo $url;
}

/**
 * Generate pagination links
 */
function mg_pagination() {
	global $wp_query;

	$big = 999999999; // need an unlikely integer

	return paginate_links( array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '?paged=%#%',
		'current' => max( 1, get_query_var('paged') ),
		'total' => $wp_query->max_num_pages,
		'mid_size' => 1,
		'prev_text' => 'Prev',
		'next_text' => 'Next',
	) );
}