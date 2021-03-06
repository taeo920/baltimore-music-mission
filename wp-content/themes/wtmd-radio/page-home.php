<?php // Template Name: Home ?>

<div class="hero" style="background-image: url('<?php mg_the_acf_image_src('hero_image', 'hero'); ?>');">
	<div class="hero__container">
		<h1 class="hero__headline"><?php the_field('hero_headline'); ?></h1>
		<div class="hero__search"><?php get_template_part('partials/form-search'); ?></div>
	</div>
</div>

<div class="content">
	<?php get_template_part('partials/promoted-artist'); ?>
	<?php get_template_part('partials/featured-artists'); ?>
	<div class="btn-group btn-group--center">
		<a class="btn" href="/artists/">View All Artists</a>
	</div>
</div>