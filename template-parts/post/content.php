<?php 
/**
 * Template part for displaying posts.
 *
 * @package:    TypeNow
 * @since:      1.0
 * @version:    1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php 
    if ( is_sticky() && is_home() ) :
        echo typenow_get_svg( array( 'icon' => 'sticky' ) );
    endif;
    ?>
    <?php
    if ( post_password_required() || get_post_status () == 'private'  ) :
        echo typenow_get_svg( array( 'icon' => 'lock' ) );
    endif;
    ?>
    <header class="entry-header">
        <?php 
		if ( is_single() ) {
			the_title( '<h1 class="entry-title">', '</h1>' );
		} else {
			the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
		};

        if ( 'post' === get_post_type() ) {
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

    <div class="entry-content">
        <?php 
        the_content( sprintf(
			__( 'Continue Reading<span class="screen-reader-text"> "%s"</span>', 'typenow' ),
			get_the_title()
        ) );
        
        wp_link_pages( array(
			'before'             => '<div class="page-links">',
			'after'              => '</div>',
            'next_or_number'     => 'next',
			'link_before'        => '',
			'link_after'         => '',
		) );
        ?>
    </div><!-- .entry-content -->

    <?php if ( is_single() && get_theme_mod( 'typenow_single_ad', '' ) != '' ) : ?>
        <div class="ad-slot single-ad-slot">
            <?php echo get_theme_mod('typenow_single_ad', ''); ?>
        </div><!-- .ad-slot single-ad-slot -->
    <?php endif; ?>

    <?php
    if ( is_single() && get_the_tag_list() ) : ?>
       <div class="entry-footer">
            <span class="tags-links">
                <span class="screen-reader-text"><?php _e( 'Tags', 'typenow' ); ?></span>
                <?php echo get_the_tag_list(); ?>
            </span>
        </div><!-- .entry-footer -->
    <?php endif; ?>
    
</article>
