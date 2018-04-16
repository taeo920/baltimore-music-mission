<?php

/**
 * Loads template part file
 * Duplicates functionality of get_template_part() with the added benefit of optional output buffering and the ability to pass parameters
 * NOTE: Like the original function this uses extract() to move vars into scope - user data should be carefully escaped
 *
 * @param string $slug The slug name for the generic template or sub-directory
 * @param string $name The name of the specialised template
 * @param bool $echo Echo output immediately or buffered and returned
 * @param array $param Array of additional params to include in scope
 */
function mg_get_template_part( $slug, $name, $echo = true, $params = array() ) {
    global $posts, $post, $wp_did_header, $wp_query, $wp_rewrite, $wpdb, $wp_version, $wp, $id, $comment, $user_ID;

    do_action( "get_template_part_{$slug}", $slug, $name );

    $templates = array();
    if ( isset( $name ) ) {
    	$templates[] = "{$slug}/{$name}.php";
    	$templates[] = "{$slug}-{$name}.php";
    }
    $templates[] = "{$slug}.php";

    $template_file = locate_template( $templates, false, false );

    // Add query vars and params to scope
    if ( is_array( $wp_query->query_vars ) ) {
        extract( $wp_query->query_vars, EXTR_SKIP );
    }

    // Add passed parameters to scope
    if ( is_array( $params ) ) {
    	extract( $params, EXTR_SKIP );
    }

    // Buffer output and return if echo is false
	if( !$echo ) ob_start();
    include( $template_file );
	if( !$echo ) return ob_get_clean();
}

/**
 * Debug tool - displays contents of any variable wrapped in pre tags
 *
 * @param $variable Variable you want to debug
 */
function mg_debug( $variable ) {
	echo "<pre>";
	if( is_array( $variable ) || is_object( $variable ) ) {
		print_r( $variable );
	} else {
		var_dump( $variable );
	}
	echo "</pre>";
}