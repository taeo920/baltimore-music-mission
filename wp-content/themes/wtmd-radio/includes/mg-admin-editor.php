<?php

/**
 * Enable more WYSIWYG editor buttons
 */
function try_add_mce_buttons( $buttons ) {
	// Remove 'toolbar toggle'
	unset( $buttons[ array_search('wp_adv', $buttons) ] );

	// Add custom buttons
	$buttons[] = 'btn';

	// Add 'toolbar toggle' back in at end of array
	$buttons[] = 'wp_adv';
	
	return $buttons;
}
add_filter('mce_buttons', 'try_add_mce_buttons', 99 );

/**
 * Declare WYSIWYG editor plugins
 */
function try_declare_mce_plugins( $plugins ) {
	$plugins['btn'] = get_bloginfo('template_url') . '/scripts/mce/mce-button.js';

	return $plugins;
}
add_filter('mce_external_plugins', 'try_declare_mce_plugins');