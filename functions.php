<?php
/**
 * Video Wallpaper functions and definitions
 *
 *
 * @package WordPress
 * @subpackage Video_Wallpaper
 * @since Twenty Thirteen 1.0
 */

define("VW_SETTINGS_URL", 'options-general.php?page=video_wallpaper_options');

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
    add_image_size( 'gallery_thumb', 380, 380, true );
}
add_action( 'after_setup_theme', 'video_wallpaper_setup' );

function video_wallpaper_custom_image_sizes( $sizes ){
  return array_merge( $sizes, array(
      'gallery_thumb' => __('Large Gallery Thumbnails'),
  ) );
}
add_filter( 'image_size_names_choose', 'video_wallpaper_custom_image_sizes');

/**
 * Video_Wallpaper Options and settings.
 *
 * Sets up configurable options for the theme, such as social links
 *
 * @uses add_options_page() To create options page
 * @uses settings_fields()
 * @uses do_settings_sections()
 * @uses screen_icon()
 * @uses submit_button()
 *
 * @since Video Wallpaper 1.0
 *
 * @return void
 */

function video_wallpaper_admin_menu(){
  add_options_page(
    'Video Wallpaper Options',
    'Video Wallpaper',
    'manage_options',
    'video_wallpaper_options',
    'video_wallpaper_options_callback'
  );
}
add_action( 'admin_menu', 'video_wallpaper_admin_menu');

function video_wallpaper_options_callback(){
  if ( !current_user_can( 'manage_options' ) )  {
    wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
  }
  ?>
  <div class="wrap">
    <?php screen_icon(); ?>
    <h2>Video Wallpaper Settings</h2>

    <form method="post" action="options.php">
      <?php settings_fields( 'video_wallpaper_settings_group' ); ?>

      <?php do_settings_sections( 'video_wallpaper_options' ); ?>
      <?php submit_button(); ?>
    </form>
  </div><?php
}

// Individual settings are defined in their respective plugin folders
// Social settings -> social.php



if ( ! function_exists( 'video_wallpaper_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function video_wallpaper_paging_nav() {
    global $wp_query;

    // Don't print empty markup if there's only one page.
    if ( $wp_query->max_num_pages < 2 )
        return;
    ?>
    <nav class="navigation paging-navigation" role="navigation">
        <h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'twentythirteen' ); ?></h1>
        <div class="nav-links">

            <?php if ( get_next_posts_link() ) : ?>
            <div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'twentythirteen' ) ); ?></div>
            <?php endif; ?>

            <?php if ( get_previous_posts_link() ) : ?>
            <div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentythirteen' ) ); ?></div>
            <?php endif; ?>

        </div><!-- .nav-links -->
    </nav><!-- .navigation -->
    <?php
}
endif;

if ( ! function_exists( 'video_wallpaper_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
*
* @since Twenty Thirteen 1.0
*
* @return void
*/
function video_wallpaper_post_nav() {
    global $post;

    // Don't print empty markup if there's nowhere to navigate.
    $previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
    $next     = get_adjacent_post( false, '', false );

    if ( ! $next && ! $previous )
        return;
    ?>
    <nav class="navigation post-navigation" role="navigation">
        <h3 class="screen-reader-text">Browse News</h3>
        <div class="nav-links">

            <?php previous_post_link( '%link', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'twentythirteen' ) ); ?>
            <?php next_post_link( '%link', _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link', 'twentythirteen' ) ); ?>

        </div><!-- .nav-links -->
    </nav><!-- .navigation -->
    <?php
}
endif;

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
    wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.min.js', array( 'jquery' ), '2.7.1', true );
    wp_enqueue_script( 'videojs', get_template_directory_uri() . '/js/video.js', array( 'jquery' ), '2013-11-14', true );
    wp_enqueue_script( 'bigvideo', get_template_directory_uri() . '/js/bigvideo.js', array( 'jquery', 'videojs', 'jquery-ui-slider', 'modernizr' ), '1.0.3', true );
    wp_enqueue_script( 'imagesLoaded', "http://desandro.github.io/imagesloaded/imagesloaded.pkgd.min.js", array('jquery'), '2013-11-04', true );

    wp_enqueue_script( 'video_wallpaper_scripts', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ), '2013-11-14', true  );

    // Add Normalize.css
    wp_enqueue_style( 'normalize', get_template_directory_uri() . '/css/normalize.css', array(), '2.1.3' );

    // Loads our main stylesheet.
    wp_enqueue_style( 'video_wallpaper-style', get_stylesheet_uri(), array(), '2013-11-14' );
}
add_action( 'wp_enqueue_scripts', 'video_wallpaper_scripts_styles' );

// Load plugins
define("VW_THEME_DIR", dirname(__FILE__) . "/");
define("VW_PLUGIN_DIR", VW_THEME_DIR . "plugins/");

require_once VW_PLUGIN_DIR . 'meta_box.php';
require_once VW_PLUGIN_DIR . 'social.php';
// require_once VW_PLUGIN_DIR . 'wallpaper.php';


