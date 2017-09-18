<?php
/**
 * The template for displaying search results pages.
 *
 * @package:    TypeNow
 * @since:      1.0
 * @version:    1.0
 */
get_header(); ?>
<div id="content" class="site-content">
    <div class="wrap">
        <?php if (function_exists('typenow_breadcrumbs')) typenow_breadcrumbs(); ?>
        <header class="page-header">
        <?php if ( have_posts() ) : ?>
            <h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'typenow' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
        <?php else : ?>
            <h1 class="page-title"><?php _e( 'Nothing Found', 'typenow' ); ?></h1>
        <?php endif; ?>
        <hr />
        </header><!-- .page-header -->

        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
                <?php if ( have_posts() ) :
                while ( have_posts() ) : the_post();
                    get_template_part( 'template-parts/post/content', 'excerpt' );
                endwhile;
                the_posts_pagination( array(
                    'prev_text' => typenow_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . __( 'Previous Page', 'typenow' ) . '</span>',
                    'next_text' => '<span class="screen-reader-text">' . __( 'Next Page', 'typenow' ) . '</span>' . typenow_get_svg( array( 'icon' => 'arrow-right' ) ),
                    'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'typenow' ) . ' </span>',
                ) );
                else : ?>
                <p class="search-none-text"><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'typenow' ); ?></p>
                <div class="search-form-container">
                    <?php get_search_form(); ?>
                </div><!-- .search-form-container -->
                <?php
                endif;
                ?>
            </main><!-- #main .site-main -->
        </div><!-- #primary .content-area -->
    </div><!-- .wrap -->
</div><!-- #content .site-content -->
<?php get_footer();
