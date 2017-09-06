<?php 
/**
 * The template for displaying all single posts.
 */
get_header(); ?>

<div class="wrap">
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <?php 
            /* Start the Loop. */
            while ( have_posts() ) : the_post();
                get_template_part( 'template-parts/post/content', get_post_format() );
            
                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) :
                        comments_template();
                endif;

                the_post_navigation( array(
                        'prev_text' => '<span class="screen-reader-text">' . __( 'Previous Post', 'typenow' ) . '</span><span class="nav-title-icon-wrapper">' . typenow_get_svg( array( 'icon' => 'arrow-left' ) ) . '</span> <span aria-hidden="true" class="nav-text">' . __( 'Previous Post', 'typenow' ) . '</span>',
                        'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', 'typenow' ) . '</span><span aria-hidden="true" class="nav-text">' . __( 'Next Post', 'typenow' ) . '</span> <span class="nav-title-icon-wrapper">' . typenow_get_svg( array( 'icon' => 'arrow-right' ) ) . '</span>',
                        'in_same_term'       => true,
                ) );

                // If post format is not status, display the related posts.
                //if ( ! has_post_format('status') ) :
                //    typenow_related_post($post->ID);
                //endif;

            endwhile; // End of the loop.
            ?>
        </main><!-- .site-mian -->
    </div><!-- #primary .content-area -->
</div><!-- .wrap -->
<?php get_footer();
