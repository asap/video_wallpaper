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
        '', // Should be MP4
        {
            altSource: '' // Should be OGV
        }
    );
});
</script>

<?php get_footer(); ?>