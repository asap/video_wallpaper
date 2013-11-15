<?php
/**
 * Video Wallpaper functions and definitions
 *
 *
 * @package WordPress
 * @subpackage Video_Wallpaper
 * @since Twenty Thirteen 1.0
 */

/**
 * Enqueue scripts and styles for the front end.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function video_wallpaper_scripts_styles() {
    /*
     * Adds JavaScript to pages with the comment form to support
     * sites with threaded comments (when in use).
     */

    // Loads JavaScript file with functionality specific to Video Wallpaper.
    wp_enqueue_script( 'jquery-ui-slider' );
    wp_enqueue_script( 'videojs', get_template_directory_uri() . '/js/video.js', array( 'jquery' ), '2013-11-14', true );
    wp_enqueue_script( 'bigvideo', get_template_directory_uri() . '/js/bigvideo.js', array( 'jquery', 'videojs', 'jquery-ui-slider' ), '2013-11-14', true );

    // Loads our main stylesheet.
    wp_enqueue_style( 'video_wallpaper-style', get_stylesheet_uri(), array(), '2013-11-14' );
}
add_action( 'wp_enqueue_scripts', 'video_wallpaper_scripts_styles' );