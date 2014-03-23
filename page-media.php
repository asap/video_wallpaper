<?php
/**
 * Template Name: Media
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Video_Wallpaper
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

<div id="main-content" class="main-content">

<?php
if( function_exists( video_wallpaper_do_static ) ) {
    video_wallpaper_do_static();
}

// Shift the article to the right or left so we can show 
// off something really awesome in the background

$article_alignment = get_post_meta(
    $post->ID,
    'article_alignment',
    true
);

$classes = array(
    'article_alignment_' . $article_alignment,
    'content-area'
);

?>

    <div id="primary" <?php post_class($classes); ?>>
        <div id="content" class="site-content" role="main">

            <?php /* The loop */ ?>
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php if($post->post_content) : ?>

                    <?php get_template_part( 'content', 'media' ); ?>                

                    <?php endif; ?>
                    
                <?php endwhile; ?>

        </div><!-- #content -->
    </div><!-- #primary -->

</div><!-- #main-content -->

<?php get_footer(); ?>