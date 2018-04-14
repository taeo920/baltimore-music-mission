<?php $featured_artists = get_field('featured_artists'); ?>

<div class="featured-artists">
    <div class="artists">
        <?php
            foreach( $featured_artists as $post ) {
                setup_postdata( $post );
                get_template_part('partials/loop-artist');
            }
            wp_reset_postdata();
        ?>
    </div>
</div>