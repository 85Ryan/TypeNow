<?php 
/**
 * The index for TypeNow.
 */

get_header(); ?>
            <div class="wrap">
                <?php if ( is_home() && ! is_front_page() ) : ?>
                <header class="page-header">
                    <h1 class="page-title"><?php single_post_title(); ?></h1>
                </header>
                <?php endif; ?>
                
                <div id="primary" class="content-area">
                    <main id="main" class="site-main" role="main">
                        <?php 
                        if ( have_posts() ) :
                            while ( have_posts() ) : the_post();
                            get_template_part( 'template-parts/post/content', get_post_format() );
                        endwhile;
                        the_posts_pagination( array(
                                'prev_text' => typenow_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . __( 'Previous Page', 'typenow' ) . '</span>',
                                'next_text' => '<span class="screen-reader-text">' . __( 'Next Page', 'typenow' ) . '</span>' . typenow_get_svg( array( 'icon' => 'arrow-right' ) ),
                                'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'typenow' ) . ' </span>',
                            ) );
                        else :
                            get_template_part( 'template-parts/post/content', 'none' );
                        endif;
                        ?>
                    </main>
                </div><!-- #primary .content-area -->
            </div><!-- .wrap -->
<?php get_footer();