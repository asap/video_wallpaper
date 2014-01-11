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

                <?php get_template_part( 'content', 'page' ); ?>                

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