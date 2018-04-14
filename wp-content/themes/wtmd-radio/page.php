<?php the_post(); ?>

<div class="container">
	<div class="row">
		<article class="content">
			<header class="page-header">
				<h1 class="page-header__title"><?php the_title(); ?></h1>
			</header>
			
			<div class="wysiwyg">
				<?php the_content(); ?>
			</div>
		</article>

		<?php mg_get_sidebar(); ?>
	</div>
</div>