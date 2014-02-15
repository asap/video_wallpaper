<?php

/**
 * Video_Wallpaper Homepage Settings.
 *
 * Sets up social links used in video_wallpaper_social_links
 *
 * @uses add_options_page() To create options page
 * @uses add_settings_section() To define social settings section
 * @uses add_settings_field() To define social IDs
 * @uses register_setting() to define settings group
 *
 * @since Video Wallpaper 1.0
 *
 * @return void
 */

// Constants

function video_wallpaper_homepage_settings_init(){
    add_settings_section(
        'video_wallpaper_homepage_section',
        'Homepage',
        'video_wallpaper_homepage_section_callback',
        'video_wallpaper_options'
    );

    add_settings_field(
        'video_wallpaper_slider_id',
        'Meta Slider ID',
        'video_wallpaper_slider_id_callback',
        'video_wallpaper_options',
        'video_wallpaper_homepage_section'
    );

    register_setting(
        'video_wallpaper_settings_group',
        'video_wallpaper_homepage_settings',
        'video_wallpaper_homepage_settings_validate'
    );
}
add_action( 'admin_init', 'video_wallpaper_homepage_settings_init');

function video_wallpaper_homepage_section_callback(){
?>
<p>This is for the home page</p>
<?php
}

function video_wallpaper_slider_id_callback(){
  $options = get_option('video_wallpaper_homepage_settings');

  ?><input name="video_wallpaper_homepage_settings[slider_id]"
           type="text"
           value="<?php echo $options['slider_id']; ?>" />

  <p class="description">
    Please look in the Usage section of the
    <?php echo "<a href='" .
               META_SLIDER_ADMIN_URL .
               "' target='_blank'>Meta Slider</a>"; ?>
    admin page for the ID.</p>

  <p class="description">It should appear as:</p>
  <pre>[metaslider id=XX]</pre>

  <p class="description">Please only enter the numbers after the = sign</p><?php

}

function video_wallpaper_homepage_settings_validate($input){
  $options = get_option('video_wallpaper_homepage_settings');

  $options['slider_id'] = sanitize_text_field($input['slider_id']);

  return $options;
}

function video_wallpaper_do_slider(){
    $options = get_option('video_wallpaper_homepage_settings');
    $slider_id = $options['slider_id'];

    if (shortcode_exists("metaslider") && $slider_id) {
        echo do_shortcode("[metaslider id=" . $slider_id . "]");
    }
}

function video_wallpaper_slider_warning(){
    
    if (!shortcode_exists("metaslider")) : ?>
        <div class="error">
            <p class='description'><b>Warning</b>: 
                <a href='http://wordpress.org/plugins/ml-slider/'
                   target='_blank'>Meta Slider Plugin</a>
                is not installed. This is needed for the Home Page Slider!
            </p>
        </div><?php
    endif;

    $options = get_option('video_wallpaper_homepage_settings');
    $slider_id = $options['slider_id'];

    if (!$slider_id) : ?>
        <div class="error">
            <p class='description'><b>Warning</b>: 
                Meta Slider ID is not set. Your slider will not appear
                on the home page. Please set the ID in the
                <?php
                    echo "<a href='" . VW_ADMIN_URL .
                         "' target='_blank'>Video Wallpaper Settings</a>";
                ?>
            </p>
          </div><?php
    endif;
}
add_action('admin_notices', 'video_wallpaper_slider_warning');     
