<?php 
/**
 * The index for TypeNow.
 *
 * @package:    TypeNow
 * @since:      1.0
 * @version:    1.0
 */

get_header(); ?>
<div id="content" class="site-content">
    <div class="wrap">
        <?php if ( is_home() && ! is_front_page() ) : ?>
            <header class="page-header">
                <h1 class="page-title"><?php single_post_title(); ?></h1>
            </header>
        <?php endif; ?>
                
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
                <?php $count = 0; ?>
                <?php if ( have_posts() ) : ?>
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php if ($count == 1 or $count == 2) : ?>
						    <?php if (get_theme_mod('typenow_home_ad', '') != '') : ?>
                                <div class="ad-slot home-ad-slot">
                                    <?php echo get_theme_mod('typenow_home_ad', ''); ?>
                                </div><!-- .ad-slot home-ad-slot -->
						    <?php endif; ?>
					    <?php endif; $count++; ?>
                        <?php get_template_part( 'template-parts/post/content', get_post_format() ); ?>
                    <?php endwhile; ?>
                    <?php the_posts_pagination( array(
                        'prev_text' => typenow_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . __( 'Previous Page', 'typenow' ) . '</span>',
                        'next_text' => '<span class="screen-reader-text">' . __( 'Next Page', 'typenow' ) . '</span>' . typenow_get_svg( array( 'icon' => 'arrow-right' ) ),
                        'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page ', 'typenow' ) . ' </span>',
                        'after_page_number' => '<span class="meta-nav screen-reader-text">' . __( ' ', 'typenow' ) . ' </span>',
                    ) ); ?>
                <?php else : ?>
                    <?php get_template_part( 'template-parts/post/content', 'none' ); ?>
                <?php endif; ?>
            </main>
        </div><!-- #primary .content-area -->
    </div><!-- .wrap -->
</div><!-- #content .site-content -->
<?php get_footer();
