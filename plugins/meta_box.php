<?php

/**
 * Meta Boxes and custom fields
 *
 * @since Video Wallpaper 1.0
 *
 * @uses add_meta_box() to add a meta box
 * @uses get_post_meta() to retrive meta data
 * @uses update_post_meta() to save meta data
 * @uses wp_nonce_field() to set a nonce
 *
 * @return void
 */
function video_wallpaper_custom_post_meta(){

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
    $video_disabled = get_post_meta( $post->ID, 'video_disabled', true );

    ?>
    <p class="description">
      Video Wallpaper is set in the <a href="<?php echo VW_SETTINGS_URL; ?>">
      Settings</a> panel for the entire site.
      Override global settings for this specific page here.
    </p>
    <label for="video_wallpaper_disable_video">
      Turn off Video for just this page?</label>
    <input type="checkbox" id="video_wallpaper_disable_video"
          name="video_wallpaper_disable_video"
          value="1" <?php checked( $video_disabled, 1 ); ?> />
    <br />
    <br />
    <br />
    <p class="description">
      Override global video for just this page
    </p>
    <label for="video_wallpaper_video_url">Video URL</label>
    <input type="text" id="video_wallpaper_video_url"
         name="video_wallpaper_video_url"
         value="<?php echo esc_attr( $video_url ); ?>" size="50" />
    <br />
    <label for="video_wallpaper_video_url_alt">Alt Video</label>
    <input type="text" id="video_wallpaper_video_url_alt"
         name="video_wallpaper_video_url_alt"
         value="<?php echo esc_attr( $video_url_alt ); ?>" size="50" />

    <br />
    <br />
    <br />
    <p class="description">
      Use the Featured Image on the left to replace the Background Image
      for just this page
    </p>

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
  $video_disabled = $_POST['video_wallpaper_disable_video'];

  // Update the meta field in the database.
  update_post_meta( $post_id, 'video_url', $video_url );
  update_post_meta( $post_id, 'video_url_alt', $video_url_alt );
  update_post_meta( $post_id, 'video_disabled', $video_disabled );
}
add_action( 'save_post', 'video_wallpaper_save_postdata' );
