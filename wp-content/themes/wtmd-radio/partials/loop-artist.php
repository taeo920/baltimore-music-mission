<div <?php post_class('artist'); ?> id="post-<?php the_ID(); ?>">
	<a href="<?php the_permalink(); ?>">
		<div class="artist__image">
			<?php the_post_thumbnail('artist'); ?>
		</div>
		<h3 class="artist__name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	</a>
</div>