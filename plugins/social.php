<?php

/**
 * Video_Wallpaper Social Settings.
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

function video_wallpaper_social_settings_init(){
  add_settings_section(
    'video_wallpaper_social_section',
    'Social',
    'video_wallpaper_social_section_callback',
    'video_wallpaper_options'
  );

  add_settings_field(
    'video_wallpaper_facebook_id',
    'Facebook ID',
    'video_wallpaper_facebook_id_callback',
    'video_wallpaper_options',
    'video_wallpaper_social_section'
  );

  add_settings_field(
    'video_wallpaper_instagram_id',
    'Instagram ID',
    'video_wallpaper_instagram_id_callback',
    'video_wallpaper_options',
    'video_wallpaper_social_section'
  );

  add_settings_field(
    'video_wallpaper_twitter_id',
    'Twitter ID',
    'video_wallpaper_twitter_id_callback',
    'video_wallpaper_options',
    'video_wallpaper_social_section'
  );

  register_setting('video_wallpaper_options', 'video_wallpaper_facebook_id');
  register_setting('video_wallpaper_options', 'video_wallpaper_instagram_id');
  register_setting('video_wallpaper_options', 'video_wallpaper_twitter_id');

}
add_action( 'admin_init', 'video_wallpaper_social_settings_init');


function video_wallpaper_social_section_callback(){
?>
  <p>These settings are used on the home page to link to your social network links.</p>
  <p><strong>DO NOT include the entire address</strong> i.e. http://facebook.com/your_user_name</p>
  <p>We just need the <em>your_username</em> part</p>
<?php
}

function video_wallpaper_instagram_id_callback(){
  $facebook_id = esc_attr( get_option( 'video_wallpaper_facebook_id' ) );

  ?><input name="video_wallpaper_facebook_id"
           id="video_wallpaper_facebook_id"
           type="text"
           value="<?php echo $facebook_id ?>" /><?php
}

function video_wallpaper_facebook_id_callback(){
  $instagram_id = esc_attr( get_option( 'video_wallpaper_instagram_id' ) );

  ?><input name="video_wallpaper_instagram_id"
           id="video_wallpaper_instagram_id"
           type="text"
           value="<?php echo $instagram_id ?>" /><?php
}

function video_wallpaper_twitter_id_callback(){
  $twitter_id = esc_attr( get_option( 'video_wallpaper_twitter_id' ) );

  ?><input name="video_wallpaper_twitter_id"
           id="video_wallpaper_twitter_id"
           type="text"
           value="<?php echo $twitter_id ?>" /><?php
}


/**
 * Render Social Links on home page
 *
 * @since Video Wallpaper 1.0
 *
 * @return void
 */

function video_wallpaper_social_links(){
  $facebook_id = esc_attr( get_option( 'video_wallpaper_facebook_id' ) );
  $instagram_id = esc_attr( get_option( 'video_wallpaper_instagram_id' ) );
  $twitter_id = esc_attr( get_option( 'video_wallpaper_twitter_id' ) );

  ?>
  <div class="social-nav">
    <ul><?php

    if( ! empty( $facebook_id ) ) :
      ?><li><a href="http://facebook.com/<?php echo $facebook_id; ?>" class="facebook" target="_blank">Facebook</a></li><?php
    endif;

    if( ! empty( $twitter_id ) ) :
      ?><li><a href="http://twitter.com/<?php echo $twitter_id; ?>" class="twitter" target="_blank">Twitter</a></li><?php
    endif;

    if( ! empty( $instagram_id ) ) :
      ?><li><a href="http://instagram.com/<?php echo $instagram_id; ?>" class="instagram" target="_blank">Instagram</a></li><?php
    endif;

    ?></ul>
  </div>
  <?php
}