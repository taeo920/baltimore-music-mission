<?php the_post(); ?>

<div class="hero hero--internal">
	<div class="hero__container">
		<div class="hero__search"><?php get_template_part('partials/form-search'); ?></div>
	</div>
</div>

<div class="content wysiwyg">
	<header class="page-header">
		<h1 class="page-header__title"><?php the_title(); ?></h1>
	</header>

	<div class="wysiwyg">
		<?php the_content(); ?>
	</div>
</div>