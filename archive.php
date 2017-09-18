<?php
/**
 * The template for displaying archive pages.
 *
 * @package:    TypeNow
 * @since:      1.0
 * @version:    1.0
 */
get_header(); ?>

<div id="content" class="site-content">
    <div class="wrap">
       <?php if (function_exists('typenow_breadcrumbs')) typenow_breadcrumbs(); ?>
       <?php if ( have_posts() ) : ?>
       <header class="page-header">
			<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="taxonomy-description">', '</div>' );
			?><hr />
       </header><!-- .page-header -->
       <?php endif; ?>

        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
                <?php if ( have_posts() ) : ?>
                <?php
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
            </main><!-- #main .site-main -->
        </div><!-- #primary .content-area -->
    </div><!-- .wrap -->
</div><!-- #content .site-content -->
<?php get_footer();
