<?php $post = get_field('promoted_artist'); ?>

<?php if( $post ) : setup_postdata( $post ); ?>
    <div class="promoted-artist">
        <div class="promoted-artist__image">
            <?php the_post_thumbnail('artist'); ?>
        </div>
        <div class="promoted-artist__text wysiwyg">
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <?php the_excerpt(); ?>
            <a class="btn" href="<?php the_permalink(); ?>">Learn More</a>
        </div>
    </div>
<?php endif; wp_reset_postdata(); ?>