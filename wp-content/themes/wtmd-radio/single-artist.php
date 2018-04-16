<?php the_post(); ?>

<div class="hero hero--internal">
	<div class="hero__container">
		<h1 class="hero__headline"><?php the_title(); ?></h1>
		<div class="hero__share"><?php get_template_part('partials/share'); ?></div>
	</div>
</div>

<div class="content">
	<div class="artist-detail">
		<div class="artist-detail__columns">
		<div class="artist-detail__col">
				<div class="artist-detail__image">
					<?php the_post_thumbnail('artist'); ?>
				</div>
				
				<?php if( $embed = get_field('track_embed') ) : ?>
					<div class="artist-detail__track-embed"><?php echo $embed; ?></div>
				<?php endif; ?>
				
				<?php if( $social = get_field('social') ) : ?>
					<div class="artist-detail__social">
						<label class="artist-detail__social-label">Follow The Band</label>
						<div class="artist-detail__social-platforms">
							<?php if( $social['instagram'] ) : ?>
								<a class="artist-detail__social-platform" href="https://www.instagram.com/<?php echo $social['instagram']; ?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i><span class="sr-only">Instagram</span></a>
							<?php endif; ?>
							<?php if( $social['twitter'] ) : ?>
								<a class="artist-detail__social-platform" href="https://www.twitter.com/<?php echo $social['twitter']; ?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i><span class="sr-only">Twitter</span></a>
							<?php endif; ?>
							<?php if( $social['facebook'] ) : ?>
								<a class="artist-detail__social-platform" href="https://www.faebook.com/<?php echo $social['facebook']; ?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i><span class="sr-only">Facebook</span></a>
							<?php endif; ?>
						</div>
					</div>
				<?php endif; ?>
			</div>

			<div class="artist-detail__col">
				<?php if( $introduction = get_field('introduction') ) : ?>
					<div class="artist-detail__introduction"><?php the_field('introduction'); ?></div>
				<?php endif; ?>

				<div class="artist-detail__description wysiwyg"><?php the_content(); ?></div>
				
				<?php if( $genres = wp_get_object_terms( $post->ID, 'genre') ) : ?>
					<div class="artist-detail__genres">
						<?php foreach( $genres as $genre ) : ?>
							<a class="artist-detail__genres-link" href="<?php echo get_term_link( $genre ); ?>"><?php echo $genre->name; ?></a>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>

				<?php if( $purchase_link = get_field('purchase_link') ) : ?>
					<a class="artist-detail__purchase-link btn" href="<?php echo $purchase_link; ?>">Buy Music</a>
				<?php endif; ?>
			</div>
		</div>

		<?php if( have_rows('music_videos') ) : ?>
			<div class="artist-detail__music-videos-container">
				<h3 class="artist-detail__music-videos-title">Music Videos</h3>

				<div class="artist-detail__music-videos">
					<?php while( have_rows('music_videos') ) : the_row(); ?>
						<div class="artist-detail__music-video">
							<div class="embed-responsive embed-responsive-16by9"><?php the_sub_field('video'); ?></div>
						</div>
					<?php endwhile; ?>
				</div>
			</div>
		<?php endif; ?>
	</div>
</div>