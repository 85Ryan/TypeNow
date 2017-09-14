<?php 
/**
 * The template for displaying all pages.
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
                <?php
                while ( have_posts() ) : the_post();
                    get_template_part( 'template-parts/page/content', 'page' );
                endwhile;
                ?>
            </main><!-- #main .site-main -->
            <div id="directory-wrap" class="directory-wrap">
                <div id="post-dir" class="post-dir"></div>
            </div><!-- .directory-wrap -->
        </div><!-- #primary .content-area -->
    </div><!-- .wrap -->
</div><!-- #content .site-content -->
<?php
    // If comments are open or we have at least one comment, load up the comment template.
    if ( comments_open() || get_comments_number() ) :
        get_template_part( 'template-parts/comment/comment', 'template' );
    endif;
?>
<?php get_footer();
