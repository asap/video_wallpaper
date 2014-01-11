<?php
/**
 * The template for displaying all single posts
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

            <?php video_wallpaper_post_nav(); ?>
            <?php get_template_part( 'content', get_post_format() ); ?>
            <?php video_wallpaper_post_nav(); ?>

        <?php endwhile; ?>

    </div><!-- #content -->
</div><!-- #primary -->

<?php
if( function_exists( video_wallpaper_do_static ) ) {
    video_wallpaper_do_static();
}
?>

<?php // get_sidebar(); ?>
<?php get_footer(); ?>