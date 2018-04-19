<div class="hero hero--internal">
	<div class="hero__container">
		<div class="hero__search"><?php get_template_part('partials/form-search'); ?></div>
	</div>
</div>

<div class="content">
	<?php if( is_tax() ) : ?>
		<header class="page-header">
			<h1 class="page-header__title"><?php single_term_title(); ?></h1>
		</header>
	<?php endif; ?>

	<?php get_template_part('partials/sort'); ?>

	<div class="artists">
		<?php while( have_posts() ) : the_post(); ?>
			<?php get_template_part('partials/loop-artist'); ?>
		<?php endwhile; ?>
	</div>

	<?php get_template_part('partials/pagination'); ?>
</div>