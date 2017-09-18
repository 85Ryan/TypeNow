<?php
/**
 * Template Name: Archives
 *
 * The template for archives.
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
        <?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?><hr />
        <div class="tabs-container">
            <ul class="archive-tabs">
                <li><a href="#archive-time"><?php _e('Timeline', 'typenow'); ?></a></li>
                <li><a href="#archive-cat"><?php _e('Category', 'typenow'); ?></a></li>
            </ul>
        </div><!-- .tabs-container -->
        </header><!-- .page-header -->

        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
                <div id="archive-time" class="archives archive-time">
                    <?php get_template_part( 'template-parts/page/content', 'archives-time' ); ?>
                </div>
                <div id="archive-cat" class="archives archive-cat">
                    <?php get_template_part( 'template-parts/page/content', 'archives-cat' ); ?>
                </div>
            </main><!-- #main .site-main -->
        </div><!-- #primary .content-area -->
    </div><!-- .wrap -->
</div><!-- #content .site-content -->
<?php get_footer();
