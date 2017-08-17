<?php 
/**
 * Template part for displaying posts.
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php 
    if ( is_sticky() && is_home() ) :
        echo typenow_get_svg( array( 'icon' => 'thumb-tack' ) );
    endif;
    ?>
    <header class="entry-header">
        <?php 
        if ( 'post' === get_post_type() ) {
            echo '<div class="entry-meta">';
                if ( is_single() ) {
                    typenow_posted_on();
                } else {
                    echo typenow_time_link();
                    typenow_edit_link();
                };
            echo '</div><!-- .entry-meta -->';
        };

		if ( is_single() ) {
			the_title( '<h1 class="entry-title">', '</h1>' );
		} else {
			the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
		}

        ?>
    </header><!-- .entry-header -->
    
    <?php if ( '' !== get_the_post_thumbnail() && ! is_single() ) : ?>
        <div class="post-thumbnail">
            <a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'typenow-featured-image' ); ?>
			</a>
        </div><!-- .post-thumbnail -->
    <?php endif; ?>
    
    <div class="entry-content">
        <?php 
        the_content( sprintf(
			__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'typenow' ),
			get_the_title()
        ) );
        
        wp_link_pages( array(
			'before'      => '<div class="page-links">' . __( 'Pages:', 'typenow' ),
			'after'       => '</div>',
			'link_before' => '<span class="page-number">',
			'link_after'  => '</span>',
		) );
        ?>
    </div><!-- .entry-content -->
    <?php if ( is_single() ) {
        typenow_entry_footer();
    } ?>
</article>