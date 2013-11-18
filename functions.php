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
 * Video_Wallpaper setup.
 *
 * Sets up theme defaults and registers the various WordPress features that
 * The theme supports.
 *
 * @uses register_nav_menu() To add support for a navigation menu.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */

function video_wallpaper_setup() {
    // This theme uses wp_nav_menu() in one location.
    register_nav_menu( 'primary', __( 'Navigation Menu', 'video_wallpaper' ) );

    /*
     * This theme uses a custom image size for featured images, displayed on
     * "standard" posts and pages.
     */
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 604, 270, true );
}
add_action( 'after_setup_theme', 'video_wallpaper_setup' );

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
    wp_enqueue_script( 'bigvideo', get_template_directory_uri() . '/js/bigvideo.js', array( 'jquery', 'videojs', 'jquery-ui-slider' ), '1.0.3', true );
    wp_enqueue_script( 'imagesLoaded', "http://desandro.github.io/imagesloaded/imagesloaded.pkgd.min.js", array('jquery'), '2013-11-04', true );

    wp_enqueue_script( 'video_wallpaper_scripts', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ), '2013-11-14', true  );

    // Add Normalize.css
    wp_enqueue_style( 'normalize', get_template_directory_uri() . '/css/normalize.css', array(), '2.1.3' );

    // Loads our main stylesheet.
    wp_enqueue_style( 'video_wallpaper-style', get_stylesheet_uri(), array(), '2013-11-14' );
}
add_action( 'wp_enqueue_scripts', 'video_wallpaper_scripts_styles' );
