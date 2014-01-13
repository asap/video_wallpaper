<?php

/**
 * Video_Wallpaper Wallpaper Settings.
 *
 * Sets up the default wallpaper for the site
 *
 * @since Video Wallpaper 1.0
 *
 * @return void
 */

function video_wallpaper_wallpaper_settings_init(){
    add_settings_section(
        'video_wallpaper_wallpaper_section',
        'Wallpaper',
        'video_wallpaper_wallpaper_section_callback',
        'video_wallpaper_options'
    );

    add_settings_field(
        'video_wallpaper_video_url',
        'Video URL',
        'video_wallpaper_video_url_callback',
        'video_wallpaper_options',
        'video_wallpaper_wallpaper_section'
    );

    add_settings_field(
        'video_wallpaper_video_url_alt',
        'Alt Video URL',
        'video_wallpaper_video_url_alt_callback',
        'video_wallpaper_options',
        'video_wallpaper_wallpaper_section'
    );

    add_settings_field(
        'video_wallpaper_image_url',
        'Image URL',
        'video_wallpaper_image_url_callback',
        'video_wallpaper_options',
        'video_wallpaper_wallpaper_section'
    );

    register_setting(
        'video_wallpaper_settings_group',
        'video_wallpaper_wallpaper_settings'
    );
}
add_action( 'admin_init', 'video_wallpaper_wallpaper_settings_init');

function video_wallpaper_wallpaper_section_callback(){
?>
  <p>This is the default wallpaper/background for the site</p>
  <p>To override the wallpaper for individual pages or posts, use the options on the post/page edit screen</p>
  </p>
  <p>Blog posts will not have a video wallpaper, as this will be distracting to readers</p>
<?php
}

function video_wallpaper_video_url_callback(){
  $options = get_option('video_wallpaper_wallpaper_settings');

  ?><input name="video_wallpaper_wallpaper_settings[video_url]"
           type="text" style="width: 400px;"
           value="<?php echo $options['video_url']; ?>" />
    <p class="description">A link to your video that should work in most browsers</p><?php
}

function video_wallpaper_video_url_alt_callback(){
  $options = get_option('video_wallpaper_wallpaper_settings');

  ?><input name="video_wallpaper_wallpaper_settings[video_url_alt]"
           type="text" style="width: 400px;"
           value="<?php echo $options['video_url_alt']; ?>" />
    <p class="description">required for browsers that do not support your Video URL</p><?php
}

function video_wallpaper_image_url_callback(){
  $options = get_option('video_wallpaper_wallpaper_settings');

  ?><input name="video_wallpaper_wallpaper_settings[image_url]"
           type="text" style="width: 400px;"
           value="<?php echo $options['image_url']; ?>" />
    <p class="description">Image to be used in place of video on mobile devices or before the video loads</p><?php
}

function video_wallpaper_do_static(){
// Renders the JS that creates the static image wallpaper
global $post;

$options = get_option('video_wallpaper_wallpaper_settings');
$image_url = $options['image_url'];

if( !is_front_page() ) {
    if( has_post_thumbnail() ) {
        $images = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' ); 
        $image_url = $images[0];
    }
}

?><script type="text/javascript">
jQuery(function($) {

    var source;

    <?php if($image_url) : ?>
    source = '<?php echo $image_url; ?>';
    <?php endif; ?>
    
    var BV = new $.BigVideo({
        controls: false
    });
    BV.init();
    BV.show(source);
});
</script>
<?php
}

function video_wallpaper_do_wallpaper(){
// Renders the JS that creates the video wallpaper

global $post;

$options = get_option('video_wallpaper_wallpaper_settings');
$image_url = $options['image_url'];
$video_url = $options['video_url'];
$video_url_alt = $options['video_url_alt'];
$video_disabled = get_post_meta( $post->ID, 'video_disabled', true );

if( !is_front_page() ) {
    if( has_post_thumbnail() ) {
        $images = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
        $image_url = $images[0];
    }

    if( get_post_meta( $post->ID, 'video_url', true ) ) {
        $video_url = esc_url( get_post_meta( $post->ID, 'video_url', true ) );
    }

    if( get_post_meta( $post->ID, 'video_url_alt', true ) ) {
        $video_url_alt = esc_url( get_post_meta( $post->ID, 'video_url_alt', true ) );
    }
}

?><script type="text/javascript">
jQuery(function($) {

    var alt,
        image,
        source,
        video;

    <?php if( $image_url ) : ?>
    image = '<?php echo $image_url; ?>';
    <?php endif; ?>

    <?php if( $video_url && !$video_disabled ) : ?>
    video = '<?php echo $video_url; ?>';
    <?php endif; ?>

    <?php if( $video_url_alt && !$video_disabled ) : ?>
    alt = '<?php echo $video_url_alt; ?>';
    <?php endif; ?>

    source = video || image;
    altSource = alt || "";

    var BV = new $.BigVideo({
        controls: false,
        doLoop: false,
        useFlashForFirefox:false
    });
    BV.init();
    BV.show(source, {altSource: altSource});
});
</script>
<?php
}