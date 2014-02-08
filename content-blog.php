<?php $classes = array('blog'); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
    <a class="post-thumbnail" href="<?php the_permalink(); ?>">
        <?php
            // Output the featured image.
            if ( has_post_thumbnail() ) :
                    the_post_thumbnail( 'thumbnail' );
            endif;
        ?>
    </a>
    <header class="entry-header">
        <h1 class="entry-title">
            <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
        </h1>
    </header><!-- .entry-header -->

    <div class="entry-summary">
        <?php the_excerpt(); ?>
    </div><!-- .entry-summary -->

</article><!-- #post -->
