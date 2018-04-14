<?php

/**
 * Determines if url is a valid YouTube URL
 *
 * @param string $url Valid YouTube video URL
 * @return bool
 */
function mg_is_youtube_url( $url ) {
	return ( preg_match('/youtu\.be/i', $url) || preg_match('/youtube\.com\/watch/i', $url) );
}

/**
 * Determines if url is a valid Vimeo URL
 *
 * @param string $url Valid Vimeo video URL
 * @return bool
 */
function mg_is_vimeo_url( $url ) {
	return ( preg_match('/vimeo\.com/i', $url) );
}

/**
 * Parses a url for a YouTube video ID
 *
 * @param string $url Valid YouTube video URL
 * @return string YouTube video ID
 */
function mg_get_youtube_video_id( $url ) {
	if( !mg_is_youtube_url( $url ) )
		return false;

	$pattern = '/^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/';
	preg_match( $pattern, $url, $matches );
	
	if ( count($matches) && strlen( $matches[7] ) == 11 ) {
		return $matches[7];
	}
}

/**
 * Parses a url for a Vimeo video ID
 *
 * @param string $url Valid Vimeo video URL
 * @return string Vimeo video ID
 */
function mg_get_vimeo_video_id( $url ) {
	if( !mg_is_vimeo_url( $url ) )
		return false;

	$pattern = '/(https?:\/\/)?(www\.)?(player\.)?vimeo\.com\/([a-z]*\/)*([0-9]{6,11})[?]?.*/';
	preg_match( $pattern, $url, $matches );
	
	if ( count($matches) ) {
		return $matches[5];
	}
}

/**
 * Accepts a YouTube video ID and returns a shortened link
 *
 * @param int $id Valid YouTube video ID
 * @return string Short YouTube video link
 */
function mg_youtube_short_link( $id ) {
	return 'https://youtu.be/' . $id;
}

/**
 * Accepts a YouTube video ID and returns an link
 *
 * @param int $id Valid YouTube video ID
 * @return string YouTube video embed link
 */
function mg_youtube_embed_link( $id ) {
	return 'https://www.youtube.com/embed/' . $id . '?rel=0&autoplay=1&rel=0';
}

/**
 * Accepts a Vimeo video ID and returns an embed link
 *
 * @param int $id Valid Vimeo video ID
 * @return string Vimeo video embed link
 */
function mg_vimeo_embed_link( $id ) {
	return 'https://player.vimeo.com/video/' . $id . '?autoplay=1';
}

/**
 * Generates a YouTube iFrame embed
 * Duplicates wp_oembed_get() but this allows specifying of YouTube video arguments
 *
 * @param string $id Valid YouTube video ID
 * @param array $iframe_args List of arguments for the iframe markup
 * @param array $youtube_args List of arguments for the youtube video
 * @return string HTML for iFrame embed
 */
function mg_youtube_embed( $id, $iframe_args = array(), $youtube_args = array() ) {
	$iframe_defaults = array(
		'class' => 'video',
		'width' => 640,
		'height' => 360,
		'responsive' => false
	);
	$iframe_args = wp_parse_args( $iframe_args, $iframe_defaults );
	extract( $iframe_args, EXTR_SKIP );

	$youtube_defaults = array(
		'autoplay' => 1,
		'rel' => 0,
		'origin' => get_bloginfo('url')
	);
	$youtube_args = wp_parse_args( $youtube_args, $youtube_defaults );
	$youtube_args = http_build_query( $youtube_args );

	$dimensions = ( $responsive ) ? '' : 'width="' . $width . '" height="' . $height . '"';

	// iFrame embed
	printf('<iframe type="text/html" class="%s" %s src="https://www.youtube.com/embed/%s?%s" frameborder="0"></iframe>', $class, $dimensions, $id, $youtube_args );
}