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
 * Loads comment template
 *
 * @param object $comment The comment object
 * @param array $args Comment arguments
 * @param int $depth The depth of the current comment
 */
function mg_comment_list( $comment, $args, $depth ) {
	$args = array(
		 'comment' => $comment,
		 'args' => $args,
		 'depth' => $depth
	);

	mg_get_template_part('partials', 'comment', true, $args );
}

/**
 * Creates a compressed zip archive from an array of files
 *
 * @param (array) $files Array of file locations ( on disk not HTTP )
 * @param (string) $destination Location and file name for the zip to be created
 * @param (bool) $overwrite Whether or not to overwrite the destination if it already exists
 * @param (bool) $preserve_folder_structure Whether or not to preserve the folder structure or grab only the files
 * @return (bool) Whether or not the destination file exists
 */
function mg_create_zip( $files = array(), $destination = '', $overwrite = false, $preserve_folder_structure = false ) {
	// if the zip file already exists and overwrite is false, return false
	if( file_exists( $destination ) && !$overwrite ) { return false; }

	// vars
	$valid_files = array();

	// if files were passed in...
	if( is_array( $files ) ) {
		// cycle through each file
		foreach( $files as $file ) {
			// make sure the file exists
			if( file_exists( $file ) ) {
				$valid_files[] = $file;
			}
		}
	}
	// if we have good files...
	if( count( $valid_files ) ) {
		// create the archive
		$zip = new ZipArchive();
		if( $zip->open( $destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE ) !== true ) {
			return false;
		}

		// add the files
		foreach( $valid_files as $file ) {
			$localname = ( $preserve_folder_structure ) ? $file : basename( $file );
			$zip->addFile( $file, $localname );
		}

		// close the zip -- done!
		$zip->close();

		// check to make sure the file exists
		return file_exists( $destination );
	} else {
		return false;
	}
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