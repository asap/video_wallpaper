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

<div id="share"></div>

<?php
if( function_exists( video_wallpaper_do_wallpaper ) ) {
    video_wallpaper_do_wallpaper();
}
?>

<?php get_footer(); ?>