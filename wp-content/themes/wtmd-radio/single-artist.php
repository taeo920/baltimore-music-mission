<?php the_post(); ?>

<div class="hero hero--small">
	<div class="hero__container">
		<h1 class="hero__headline"><?php the_title(); ?></h1>
	</div>
</div>

<div class="content">
	<div class="artist-detail">
		<div class="artist-detail__image">
			<?php the_post_thumbnail('artist'); ?>
		</div>
		<div class="artist-detail__text">
			<div class="wysiwyg"><?php the_content(); ?></div>
		</div>
	</div>
</div>