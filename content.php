<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Video_Wallpaper
 * @since Twenty Thirteen 1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
    
    <header class="entry-header">
        <?php if ( is_single() ) : ?>
        <h1 class="entry-title"><?php the_title(); ?></h1>
        <?php else : ?>
        <h1 class="entry-title">
            <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
        </h1>
        <?php endif; // is_single() ?>

    </header><!-- .entry-header -->

    <?php
        // Output the featured image.
        if ( has_post_thumbnail() && is_home() ) : ?>
            <a class="post-thumbnail" href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail( 'thumbnail' ); ?>
            </a>
    <?php endif; ?>

    <?php if ( is_search() || is_home() ) : // Only display Excerpts for Search or Home ?>
    <div class="entry-summary">
        <?php the_excerpt(); ?>
    </div><!-- .entry-summary -->
    <?php else : ?>
    <div class="entry-content">
        <?php // the_post_thumbnail(); ?>
        <?php the_content( 'Continue reading <span class="meta-nav">&rarr;</span>' ); ?>
        <?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
    </div><!-- .entry-content -->
    <?php endif; ?>

</article><!-- #post -->
