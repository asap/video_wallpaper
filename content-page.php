<?php

    // Shift the article to the right or left so we can show 
    // off something really awesome in the background

    $article_alignment = get_post_meta(
        $post->ID,
        'article_alignment',
        true
    );

    $classes = array(
        'article_alignment_' . $article_alignment
    );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>

    <header class="entry-header">
        <h1 class="entry-title"><?php the_title(); ?></h1>
    </header><!-- .entry-header -->

    <div class="entry-content">
        <?php the_content(); ?>
        <?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
    </div><!-- .entry-content -->
    

    <footer class="entry-meta">
        <?php edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>
    </footer><!-- .entry-meta -->

</article><!-- #post -->