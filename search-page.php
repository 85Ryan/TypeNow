<?php
/**
 * Template Name: TypeNow Search
 *
 * The template for search page.
 *
 * @package:    TypeNow
 * @since:      1.0
 * @version:    1.0
 */
get_header(); ?>
<div id="content" class="site-content">
    <div class="wrap">
        <?php if (function_exists('typenow_breadcrumbs')) typenow_breadcrumbs(); ?>
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
            <div class="search-form-container">
                <?php get_search_form(); ?>
            </div><!-- .search-form-container -->
            <div class="tag-cloud-container">
                <p><?php _e('The following tabs can help you! :)', 'typenow'); ?></p>
                <?php wp_tag_cloud( array(
                    'smallest' => 12,
                    'largest' => 12,
                    'unit' => 'px',
                    'number' => 0,
                    'format' => 'flat',
                    'separator' => '',
                    'taxonomy' => array( 'post_tag', 'category' ),
                ) ); ?>
            </div><!-- .tag-cloud-container -->
            </main><!-- #main .site-main -->
        </div><!-- #primary .content-area -->
    </div><!-- .wrap -->
</div><!-- #content .site-content -->
<?php get_footer();
