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

    var image;

    <?php
    if ( has_post_thumbnail() ) {
        $image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
        ?>
        image = '<?php echo $image_url[0]; ?>';

        <?php
    }
    ?>

    var BV = new $.BigVideo({
        controls: false,
        doLoop: true,
        useFlashForFirefox:false
    });
    BV.init();
    BV.show(image);
});
</script>

<?php get_footer(); ?>