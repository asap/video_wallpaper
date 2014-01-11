<?php
/**
 * The template for displaying image attachments
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Video_Wallpaper
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

<nav></nav>

<div id="share"></div>

<?php
if( function_exists( video_wallpaper_do_wallpaper ) ) {
    video_wallpaper_do_wallpaper();
}
?>

<?php get_footer(); ?>