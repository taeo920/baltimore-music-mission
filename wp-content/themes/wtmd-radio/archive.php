<div class="hero hero--internal">
	<div class="hero__container">
		<div class="hero__search"><?php mg_get_template_part('partials', 'form-search'); ?></div>
	</div>
</div>

<div class="content">
	<?php if( is_tax() ) : ?>
		<header class="page-header">
			<h1 class="page-header__title"><?php single_term_title(); ?></h1>
		</header>
	<?php endif; ?>

	<?php mg_get_template_part('partials', 'sort'); ?>

	<div class="artists">
		<?php while( have_posts() ) : the_post(); ?>
			<?php mg_get_template_part('partials', 'loop-artist'); ?>
		<?php endwhile; ?>
	</div>

	<?php mg_get_template_part('partials', 'pagination'); ?>
</div>