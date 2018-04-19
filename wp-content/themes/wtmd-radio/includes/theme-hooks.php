<?php

/**
 * Handle sorting options
 */
function mg_sort_artists( $query ) {
    if( $query->is_main_query() && ( is_post_type_archive('artist') || is_tax('genre') ) ) {
        if( $_GET['sort'] == 'date' ) {
            $query->set('orderby', 'date');
        } else {
            $query->set('orderby', 'title');
            $query->set('order', 'ASC');
        }
    }

    return $query;
}
add_filter('pre_get_posts','mg_sort_artists');