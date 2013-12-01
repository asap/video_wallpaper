<?php
/**
 * Default theme for pages
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Video_Wallpaper
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

<div id="primary" class="content-area">
    <div id="content" class="site-content" role="main">

        <?php /* The loop */ ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <?php if($post->post_content) : ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                    <header class="entry-header">
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                    </header><!-- .entry-header -->

                    <div class="entry-content">
                        <?php the_content(); ?>
                        <?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
                    </div><!-- .entry-content -->
                    

                    <footer class="entry-meta">
                        <?php edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>
                    </footer><!-- .entry-meta -->

                </article><!-- #post -->

                <?php endif; ?>
                
            <?php endwhile; ?>

    </div><!-- #content -->
</div><!-- #primary -->

<?php
if( function_exists( video_wallpaper_do_wallpaper ) ) {
    video_wallpaper_do_wallpaper();
}
?>

<?php get_footer(); ?>