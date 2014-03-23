<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Video_Wallpaper
 * @since Twenty Thirteen 1.0
 */
?>

    <footer>
        <?php if(function_exists(video_wallpaper_social_links)) video_wallpaper_social_links(); ?>
        <?php wp_footer(); ?>
    </footer>
</body>
</html>