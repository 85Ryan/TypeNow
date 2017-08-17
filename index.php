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
    </header><!-- #masthead -->
</div><!-- #page -->
</body>
</html>