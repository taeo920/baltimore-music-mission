<?php

/**
 * Front End CSS
 */
function mg_load_styles() {
	wp_enqueue_style('main-style', get_bloginfo('template_url') . '/dist/styles/app-styles.min.css', array(), true, 'screen');
}
add_action('wp_enqueue_scripts', 'mg_load_styles');

/**
 * Front End JS
 */
function mg_load_scripts() {
	// Bootstrap 4 requires jQuery 2.x.x so we must override the jQuery version packaged with WordPress ( 1.x.x )
	wp_deregister_script('jquery');
	wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js', array(), null, false );

	// Theme Script
	wp_enqueue_script('main', get_bloginfo('template_url').'/dist/scripts/app-scripts.min.js', array(), false, true );

	// WordPress Scripts
	if( is_singular() && get_option('thread_comments') ) wp_enqueue_script('comment-reply');

	// Dynamic URLs for use in scripts
	wp_localize_script( 'main', 'urls', array(
		'base' => get_bloginfo('url'),
		'theme' => get_bloginfo('template_url'),
		'ajax' => admin_url('admin-ajax.php')
	));

	// Initialize vars for JS
	wp_localize_script( 'main', 'info', array( /* IDs, etc. */ ));
}
add_action('wp_enqueue_scripts', 'mg_load_scripts');

/**
 * Admin CSS
 */
function mg_load_admin_styles() {
	wp_enqueue_style( 'admin', get_bloginfo('template_url') . '/dist/styles/admin-styles.min.css' );
}
add_action('admin_enqueue_scripts', 'mg_load_admin_styles');

/**
 * Admin JS
 */
function mg_load_admin_scripts() {
	wp_enqueue_script( 'admin', get_bloginfo('template_url') . '/dist/scripts/admin-scripts.min.js' );
}
//add_action('admin_enqueue_scripts', 'mg_load_admin_scripts');

/**
 * Appends a version number to each JS and CSS asset containing the time the file was last updated to automatically bust caching
 */
function mg_bust_asset_cache( $target_url ) {
    $url = parse_url( $target_url );

    if ( isset( $url['query'] ) && strpos( $url['query'], 'ver=' ) !== false && substr( $url['path'], 0, 19 ) === '/wp-content/themes/' ) {
        // Wrap in a try/catch block in case for stat failure
        try {
            // Replace the "ver" variable with the modification time of the file
            $target_url = add_query_arg('ver', filemtime( ABSPATH . $url['path'] ), $target_url );
        } catch ( \Exception $e ) {
            // Remove the "ver" variable in case of failure
            $target_url = remove_query_arg('ver', $target_url );
        }
    }
    return $target_url;
}
add_filter('style_loader_src', 'mg_bust_asset_cache', 9999 );
add_filter('script_loader_src', 'mg_bust_asset_cache', 9999 );

/**
 * Add asyc attribute to selected scripts
 * http://matthewhorne.me/defer-async-wordpress-scripts/
 */
function mg_add_async_attribute( $tag, $handle ) {
	// add asset handles to the array below
	$assets = array('main', 'jquery');
	
	foreach( $assets as $asset) {
		 if ( $asset === $handle ) {
			 $tag = str_replace(' src', ' async="async" src', $tag );
		 }
	}
	return $tag;
 }
add_filter('script_loader_tag', 'mg_add_async_attribute', 10, 2);