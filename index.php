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

    var image = "http://www.beyonce.com/files/video/poster/bey_intro_poster_071513.jpg";

    <?php
    if ( has_post_thumbnail() ) {
        ?>
        image = <?php the_post_thumbnail( $size, $attr ); ?>;

        <?php
    }
    ?>

    var video = 'http://www.beyonce.com/files/video/bey_intro_071513.mp4';

    // var videos = [
    //     'http://www.beyonce.com/files/video/bey_intro_071513.mp4'
    // ];

    var alt = "http://www.beyonce.com/files/video/bey_intro_071513.ogv";

    // var source = (videos.length>0) ? videos : image;
    var source = video || image;

    if(alt){
        altSource = alt;
    } else {
        altSource = "";
    }

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