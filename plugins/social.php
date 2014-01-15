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

  add_settings_field(
    'video_wallpaper_youtube_id',
    'YouTube ID',
    'video_wallpaper_youtube_id_callback',
    'video_wallpaper_options',
    'video_wallpaper_social_section'
  );

  register_setting(
    'video_wallpaper_settings_group',
    'video_wallpaper_social_settings',
    'video_wallpaper_settings_validate'
  );

}
add_action( 'admin_init', 'video_wallpaper_social_settings_init');

function video_wallpaper_social_section_callback(){
?>
  <p>These settings are used on the home page to link to your social network links.</p>
  <p><strong>DO NOT include the entire address</strong> i.e. http://facebook.com/your_user_name</p>
  <p>We just need the <em>your_username</em> part</p>
<?php
}

function video_wallpaper_facebook_id_callback(){
  $options = get_option('video_wallpaper_social_settings');

  ?><input name="video_wallpaper_social_settings[facebook_id]"
           type="text"
           value="<?php echo $options['facebook_id']; ?>" /><?php
}

function video_wallpaper_instagram_id_callback(){
  $options = get_option('video_wallpaper_social_settings');

  ?><input name="video_wallpaper_social_settings[instagram_id]"
           type="text"
           value="<?php echo $options['instagram_id']; ?>" /><?php
}

function video_wallpaper_twitter_id_callback(){
  $options = get_option('video_wallpaper_social_settings');

  ?><input name="video_wallpaper_social_settings[twitter_id]"
           type="text"
           value="<?php echo $options['twitter_id'] ?>" /><?php
}

function video_wallpaper_youtube_id_callback(){
  $options = get_option('video_wallpaper_social_settings');

  ?><input name="video_wallpaper_social_settings[youtube_id]"
           type="text"
           value="<?php echo $options['youtube_id'] ?>" /><?php
}

function video_wallpaper_settings_validate($input){
  $options = get_option('video_wallpaper_social_settings');

  $options['facebook_id'] = sanitize_text_field($input['facebook_id']);
  $options['instagram_id'] = sanitize_text_field($input['instagram_id']);
  $options['twitter_id'] = sanitize_text_field($input['twitter_id']);
  $options['youtube_id'] = sanitize_text_field($input['youtube_id']);

  return $options;
}

/**
 * Render Social Links on home page
 *
 * @since Video Wallpaper 1.0
 *
 * @return void
 */

function video_wallpaper_social_links(){
  $options = get_option('video_wallpaper_social_settings');
  $facebook_id = $options['facebook_id'];
  $instagram_id = $options['instagram_id'];
  $twitter_id = $options['twitter_id'];
  $youtube_id = $options['youtube_id'];

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

    if( ! empty( $youtube_id ) ) :
      ?><li><a href="http://youtube.com/user/<?php echo $youtube_id; ?>" class="youtube" target="_blank">Youtube</a></li><?php
    endif;

    ?></ul>
  </div>
  <?php
}