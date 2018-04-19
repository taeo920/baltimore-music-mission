<?php global $wp_query; ?>

<div class="hero hero--internal">
	<div class="hero__container">
		<div class="hero__search"><?php get_template_part('partials/form-search'); ?></div>
	</div>
</div>

<div class="content">
	<header class="page-header">
		<h1 class="page-header__title"><?php echo $wp_query->found_posts; ?> result<?php if( $wp_query->found_posts != 1 ) echo 's'; ?> for "<?php the_search_query(); ?>"</h1>
	</header>

	<div class="artists">
		<?php while( have_posts() ) : the_post(); ?>
			<?php get_template_part('partials/loop-artist'); ?>
		<?php endwhile; ?>
	</div>

	<?php get_template_part('partials/pagination'); ?>
</div>