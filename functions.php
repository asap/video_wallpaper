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

    <?php settings_fields( $option_group ); ?>

    <?php do_settings_sections( 'video_wallpaper_options' ); ?>
    <?php submit_button('Save Changes'); ?>
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
 * Meta Boxes and custom fields
 *
 * @since Twenty Thirteen 1.0
 *
 * @uses add_meta_box() to add a meta box
 * @uses get_post_meta() to retrive meta data
 * @uses update_post_meta() to save meta data
 * @uses wp_nonce_field() to set a nonce
 *
 * @return void
 */
function video_wallpaper_custom_post_meta(){
    // $post = get_post();

    // add_post_meta($post->id, 'video_url', '');

    add_meta_box(
        'video_url',
        'Video Wallpaper',
        'video_wallpaper_render_video_url_meta_box'
    );
}
add_action( 'add_meta_boxes', 'video_wallpaper_custom_post_meta');

function video_wallpaper_render_video_url_meta_box( $post ){
    // Add an nonce field so we can check for it later.
    wp_nonce_field(
        'video_wallpaper_custom_box',
        'video_wallpaper_custom_box_nonce'
    );

    /*
     * Use get_post_meta() to retrieve an existing value
     * from the database and use the value for the form.
     */
    $video_url     = get_post_meta( $post->ID, 'video_url', true );
    $video_url_alt = get_post_meta( $post->ID, 'video_url_alt', true );

    ?>
    <label for="video_wallpaper_video_url">Video URL</label>
    <input type="text" id="video_wallpaper_video_url"
         name="video_wallpaper_video_url"
         value="<?php echo esc_attr( $video_url ); ?>" size="50" />
    <br />
    <label for="video_wallpaper_video_url_alt">Alt Video</label>
    <input type="text" id="video_wallpaper_video_url_alt"
         name="video_wallpaper_video_url_alt"
         value="<?php echo esc_attr( $video_url_alt ); ?>" size="50" />


    <?php
}

function video_wallpaper_save_postdata( $post_id ) {
    /*
   * We need to verify this came from the our screen and with proper authorization,
   * because save_post can be triggered at other times.
   */

  // Check if our nonce is set.
  if ( ! isset( $_POST['video_wallpaper_custom_box_nonce'] ) )
    return $post_id;

  $nonce = $_POST['video_wallpaper_custom_box_nonce'];

  // Verify that the nonce is valid.
  if ( ! wp_verify_nonce( $nonce, 'video_wallpaper_custom_box' ) )
      return $post_id;

  // If this is an autosave, our form has not been submitted, so we don't want to do anything.
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return $post_id;

  // Check the user's permissions.
  if ( 'page' == $_POST['post_type'] ) {

    if ( ! current_user_can( 'edit_page', $post_id ) )
        return $post_id;
  
  } else {

    if ( ! current_user_can( 'edit_post', $post_id ) )
        return $post_id;
  }

  /* OK, its safe for us to save the data now. */

  // Sanitize user input.
  $video_url = sanitize_text_field( $_POST['video_wallpaper_video_url'] );
  $video_url_alt = sanitize_text_field( $_POST['video_wallpaper_video_url_alt'] );

  // Update the meta field in the database.
  update_post_meta( $post_id, 'video_url', $video_url );
  update_post_meta( $post_id, 'video_url_alt', $video_url_alt );
}
add_action( 'save_post', 'video_wallpaper_save_postdata' );


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

// Load plugins
define("VW_THEME_DIR", dirname(__FILE__) . "/");
define("VW_PLUGIN_DIR", VW_THEME_DIR . "plugins/");

require_once VW_PLUGIN_DIR . 'social.php';


