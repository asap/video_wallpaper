<?php
/**
 * Default theme for pages
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Video_Wallpaper
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

<div id="share"></div>

<script type="text/javascript">
jQuery(function($) {

    var alt,
        image,
        source,
        video;

    <?php
    if ( has_post_thumbnail() ) {
        $image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
        ?>
        image = '<?php echo $image_url[0]; ?>';

        <?php
    }
    ?>

    <?php
    if ( get_post_meta( $post->ID, 'video_url', true ) ){
        $video_url = esc_url( get_post_meta( $post->ID, 'video_url', true ) );
        ?>
        video = '<?php echo $video_url; ?>';
        <?
    }
    ?>

    <?php
    if ( get_post_meta( $post->ID, 'video_url_alt', true ) ){
        $video_alt_url = esc_url( get_post_meta( $post->ID, 'video_url_alt', true ) );
        ?>
        alt = '<?php echo $video_alt_url; ?>';
        <?
    }
    ?>

    source = video || image;
    altSource = alt || "";

    var BV = new $.BigVideo({
        controls: false,
        doLoop: true,
        useFlashForFirefox:false
    });
    BV.init();
    BV.show(source, {altSource: altSource});
});
</script>

<?php get_footer(); ?>