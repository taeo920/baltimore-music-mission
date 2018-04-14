<div class="content">
	<?php if( is_tax() ) : ?>
		<h1 class="genre"><?php echo single_term_title(); ?></h1>
	<?php endif; ?>

	<div class="artists">
		<?php while( have_posts() ) : the_post(); ?>
			<?php mg_get_template_part('partials', 'loop-artist'); ?>
		<?php endwhile; ?>
	</div>
</div>