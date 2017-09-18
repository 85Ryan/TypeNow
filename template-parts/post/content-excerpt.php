<?php
/**
 * Template part for displaying posts with excerpts.
 *
 * @package:    TypeNow
 * @since:      1.0
 * @version:    1.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
	    <?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
		<?php if ( 'post' === get_post_type() ) {
            echo '<div class="entry-meta">';
                if ( is_single() ) {
                    typenow_posted_on();
                } else {
                    typenow_posted_on();
                    typenow_edit_link();
                };
            echo '</div><!-- .entry-meta -->';
        }
        ?>
        <hr class="entry-header-separator" />
	</header><!-- .entry-header -->
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
</article><!-- #post-## -->
