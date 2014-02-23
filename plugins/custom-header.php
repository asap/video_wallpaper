<?php

/**
 * Set up the WordPress core custom header settings.
 *
 * @since Twenty Fourteen 1.0
 *
 * @return void
 */
function video_wallpaper_custom_header_setup() {
    /**
     * Filter Twenty Fourteen custom-header support arguments.
     *
     * @since Twenty Fourteen 1.0
     *
     * @param array $args {
     *     An array of custom-header support arguments.
     *
     *     @type bool   $header_text            Whether to display custom header text. Default false.
     *     @type int    $width                  Width in pixels of the custom header image. Default 1260.
     *     @type int    $height                 Height in pixels of the custom header image. Default 240.
     *     @type bool   $flex_height            Whether to allow flexible-height header images. Default true.
     *     @type string $admin_head_callback    Callback function used to style the image displayed in
     *                                          the Appearance > Header screen.
     *     @type string $admin_preview_callback Callback function used to create the custom header markup in
     *                                          the Appearance > Header screen.
     * }
     */
    add_theme_support( 'custom-header', apply_filters(
    'video_wallpaper_custom_header_args', array(
        'width'                  => 130,
        'height'                 => 00,
        'flex-height'            => true,
        'wp-head-callback'       => 'video_wallpaper_header_style',
        'admin-head-callback'    => 'video_wallpaper_admin_header_style',
        'admin-preview-callback' => 'video_wallpaper_admin_header_image',
    ) ) );
}
add_action( 'after_setup_theme', 'video_wallpaper_custom_header_setup' );

if ( ! function_exists( 'video_wallpaper_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see video_wallpaper_custom_header_setup().
 *
 */
function video_wallpaper_header_style() {
    // If we get this far, we have custom styles.
    ?>
    <style type="text/css" id="video_wallpaper-header-css">
    <?php if ( get_header_image() ) : ?>
        ul#menu-main li a[title=Home]{
            <?php 
                // The 23 should be proportional to the margin of the nav
                $top_offset = 23 - (get_custom_header()->height/2);
            ?>
            background-image: url(<?php echo header_image(); ?>);
            background-repeat: no-repeat;
            background-position: 0 0;
            display: inline-block;
            height: <?php echo get_custom_header()->height; ?>px;
            position: relative;
            text-indent: -9999px; 
            top: <?php echo $top_offset; ?>px;
            width: <?php echo get_custom_header()->width; ?>px;
            white-space: nowrap;
        }

        
        @media screen and (max-width: 320px){
            ul#menu-main li a[title=Home]{
                display: none;
            }
        }
    <?php endif; ?>
    </style>
    <?php
}
endif; // twentyfourteen_header_style


if ( ! function_exists( 'video_wallpaper_admin_header_style' ) ) :
/**
 * Style the header image displayed on the Appearance > Header screen.
 *
 * @see twentyfourteen_custom_header_setup()
 *
 * @since Twenty Fourteen 1.0
 */
function video_wallpaper_admin_header_style() {
?>
    <style type="text/css" id="video-wallpaper-admin-header-css">
    <?php if ( get_header_image() ) : ?>
        ul#menu-main li a[title=Home]{
            <?php 
                // The 23 should be proportional to the margin of the nav
                $top_offset = 23 - (get_custom_header()->height/2);
            ?>
            background-image: url(<?php echo header_image(); ?>);
            background-repeat: no-repeat;
            background-position: 0 0;
            display: inline-block;
            height: <?php echo get_custom_header()->height; ?>px;
            position: relative;
            text-indent: -9999px; 
            top: <?php echo $top_offset; ?>px;
            width: <?php echo get_custom_header()->width; ?>px;
            white-space: nowrap;
        }
    <?php endif; ?>

    ul#menu-main{
        min-width: 696px;
        list-style: none;
    }
    ul#menu-main li {
        display: inline;
    }
    ul#menu-main li a{
        font-family: 'Raleway', sans-serif;
        font-size: 1.2em;
        padding: 10px;
        text-transform: uppercase;
    }
    ul#menu-main li a:hover{
        text-decoration: none;
    }

    ul#menu-main li.menu-item-home a{
        font-size: 2em;
    }
    </style>
<?php
}
endif; // video_wallpaper_admin_header_style

if ( ! function_exists( 'video_wallpaper_admin_header_image' ) ) :
/**
 * Create the custom header image markup displayed on
 * the Appearance > Header screen.
 *
 * @see video_wallpaper_custom_header_setup()
 *
 * @since Video Wallpaper 1.0
 */
function video_wallpaper_admin_header_image() {
?>
    <div class="menu-main-container">
        <ul id="menu-main" class="nav-menu">
            <li id="menu-item-x"
                class="menu-item menu-item-type-custom menu-item-object-custom menu-item-x">
                <a title="Home" href="<?php echo esc_url( home_url( '/' ) ); ?>" onclick="return false;">
                    <?php bloginfo( 'name' ); ?>
                </a>
            </li>
        </ul>
    </div>
<?php
}
endif; // video_wallpaper_admin_header_image