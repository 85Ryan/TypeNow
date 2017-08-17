<?php 
/**
 * The index for TypeNow.
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="page" class="site">
    <a href="#content" class="skip-link screen-reader-text"><?php _e( 'Skip to Content', 'typenow' ); ?></a>
    
    <header id="masthead" class="site-header" role="banner">
        <?php get_template_part( 'template-parts/header/header', 'image' ); ?>
        
        <?php if ( has_nav_menu( 'top' ) ) : ?>
        <div class="navigation-top">
            <div class="wrap">
                <?php get_template_part( 'template-parts/navigation/navigation', 'top' ); ?>
            </div><!-- .wrap -->
        </div><!-- .navigation-top -->
        <?php endif; ?>
    </header><!-- #masthead -->
    
    <?php if ( ( is_single() || ( is_page() && ! typenow_is_frontpage() ) ) && has_post_thumbnail( get_queried_object_id() ) ) :
        echo '<div class="single-featured-image-header">';
        echo get_the_post_thumbnail( get_queried_object_id(), 'typenow-featured-image' );
        echo '</div><!-- .single-featured-image-header -->';
    endif;
    ?>
    
    <div class="site-content-contain">
        <div id="content" class="site-content">
            <div class="wrap">
                <?php if ( is_home() && ! is_front_page() ) : ?>
                <header class="page-header">
                    <h1 class="page-title"><?php single_post_title(); ?></h1>
                </header>
                <?php else : ?>
                <header class="page-header">
                    <h2 class="page-title"><?php _e( 'Posts', 'typenow' ); ?></h2>
                </header>
                <?php endif; ?>
                
                <div id="primary" class="content-area">
                    <main id="main" class="site-main" role="main">
                        <?php 
                        if ( have_posts() ) :
                            while ( have_posts() ) : the_post();
                            get_template_part( 'template-parts/post/content', get_post_format() );
                        endwhile;
                        
                        else :
                            get_template_part( 'template-parts/post/content', 'none' );
                        endif;
                        ?>
                    </main>
                </div><!-- #primary .content-area -->
            </div><!-- .wrap -->
        </div><!-- #content .site-content -->
    </div><!-- .site-content-contain -->
    
</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>