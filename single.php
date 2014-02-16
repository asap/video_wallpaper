<?php
/**
 * The template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Video_Wallpaper
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

<div id="main-content" class="main-content">

    <div id="primary" class="content-area">
        <div id="content" class="site-content" role="main">

            <?php while ( have_posts() ) : the_post(); ?>

                <?php video_wallpaper_post_nav(); ?>
                <?php get_template_part( 'content', get_post_format() ); ?>
                <?php //video_wallpaper_post_nav(); ?>

                <?php 
                    // Used for exluding this post from the recent blogs
                    $post_id = get_the_id();
                ?>
            <?php endwhile; ?>

            <?php
                // Get the latest 3 posts for the bottom section
                $q = new WP_Query(
                    array(
                        'posts_per_page'   => 3,
                        'post__not_in'          => array($post_id)
                    )
                );
            ?>
            <?php while ( $q->have_posts() ) : $q->the_post(); ?>

                <?php get_template_part( 'content', 'blog' ); ?>

            <?php endwhile; ?>

            <?php wp_reset_postdata(); ?>

        </div><!-- #content -->
    </div><!-- #primary -->
<?php get_sidebar( 'content' ); ?>
<?php
if( function_exists( video_wallpaper_do_static ) ) {
    video_wallpaper_do_static();
}
?>

</div><!-- #main-content -->

<?php get_footer(); ?>