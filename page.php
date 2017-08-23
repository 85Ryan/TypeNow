<?php 
/**
 * The template for displaying all pages.
 */
get_header(); ?>
<div class="wrap">
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <?php 
            while ( have_posts() ) : the_post();
                get_template_part( 'template-parts/page/content', 'page' );
            
                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
            endwhile;
            ?>
        </main><!-- #main .site-main -->
    </div><!-- #primary .content-area -->
</div><!-- .wrap -->
<?php get_footer();