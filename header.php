<?php 
/** 
 * The header for TypeNow.
 *
 * @package:    TypeNow
 * @since:      1.0
 * @version:    1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php if(get_theme_mod('typenow_meta_description') && is_home()) : ?>
        <meta name="description" content="<?php echo get_theme_mod('typenow_meta_description', typenow_get_theme_default( 'typenow_comment_email' )); ?>">
    <?php endif; ?>
    <?php if(get_theme_mod('typenow_meta_keywords') && is_home()) : ?>
        <meta name="keywords" content="<?php echo get_theme_mod('typenow_meta_keywords', typenow_get_theme_default( 'typenow_comment_email' )); ?>">
    <?php endif; ?>
    <?php if(get_theme_mod('typenow_google_analytics')) : ?>
        <?php echo get_theme_mod('typenow_google_analytics', typenow_get_theme_default( 'typenow_google_analytics' )); ?>
    <?php endif; ?>
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
    <div class="site-content-contain">
