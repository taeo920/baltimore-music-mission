<!DOCTYPE html>
<!--[if lt IE 7 ]> <html <?php language_attributes(); ?> class="ie ie6 lte9 lte8 lte7 lte6 no-js"> <![endif]-->
<!--[if IE 7 ]>    <html <?php language_attributes(); ?> class="ie ie7 lte9 lte8 lte7 no-js"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="ie ie8 lte9 lte8 no-js"> <![endif]-->
<!--[if IE 9 ]>    <html <?php language_attributes(); ?> class="ie ie9 lte9 no-js"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html <?php language_attributes(); ?> class="no-js"> <!--<![endif]-->
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="cleartype" content="on">

	<?php if( is_singular('artist') && has_post_thumbnail() ) : ?>
		<meta name="twitter:card" content="summary_large_image">
		<meta name="twitter:image" content="<?php the_post_thumbnail_url('artist'); ?>">
		<meta property="og:image" content="<?php the_post_thumbnail_url('artist'); ?>">
	<?php endif; ?>

	<?php wp_head(); ?>
</head>
