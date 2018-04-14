<div class="container">
	<div class="row">
		<section class="content">
			<header class="page-header">
				<h1 class="page-header__title"><?php the_archive_title(); ?></h1>
			</header>

			<ol class="posts">
				<?php while( have_posts() ) : the_post(); ?>
					<?php mg_get_template_part('partials', 'loop-post'); ?>
				<?php endwhile; ?>
			</ol>

			<?php mg_get_template_part('partials', 'pagination'); ?>
		</section>

		<?php mg_get_sidebar(); ?>
	</div>
</div>