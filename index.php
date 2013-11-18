<?php
/**
 * The template for displaying image attachments
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Video_Wallpaper
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

<nav></nav>

<div id="share"></div>

<script type="text/javascript">
jQuery(function($) {
    var BV = new $.BigVideo({
        controls: false,
        doLoop: true,
        useFlashForFirefox:false
    });
    BV.init();
    BV.show(
        'http://www.beyonce.com/files/video/bey_intro_071513.mp4',
        {
            altSource: "http://www.beyonce.com/files/video/bey_intro_071513.ogv"
        }
    );
});
</script>

<?php get_footer(); ?>