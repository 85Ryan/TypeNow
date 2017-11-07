<?php
/**
 * Additional features to allow styling of the templates.
 *
 * @package:    TypeNow
 * @since:      1.0
 * @version:    1.0
 */

/** 
 * Adds custom classes to the array of body classes.
 */
function typenow_body_classes( $classes ) {
    // Add class of group-blog to blogs with more than 1 published author.
    if ( is_multi_author() ) {
        $classes[] = 'group-blog';
    }
    
    // Add class of hfeed to non-singular pages.
    if ( ! is_singular() ) {
        $classes[] = 'hfeed';
    }
    
    // Add class if we're viewing the Customizer for easier styling of theme options.
    if ( is_customize_preview() ) {
        $classes[] = 'typenow-customizer';
    }
    
    // Add class on front page.
    if ( is_front_page() && 'posts' !== get_option( 'show_on_front' ) ) {
        $classes[] = 'typenow-front-page';
    }
    
    // Add a class if there is a custom header.
    if ( has_header_image() ) {
        $classes[] = 'has-header-image';
    }
    
    // Add class if the site title and tagline is hidden.
    if ( ( false === get_theme_mod( 'typenow_display_title' ) ) && ( true === get_theme_mod( 'typenow_display_tagline' ) ) ) {
        $classes[] = 'title-hidden';
    } elseif ( ( true === get_theme_mod( 'typenow_display_title' ) ) && ( false === get_theme_mod( 'typenow_display_tagline' ) ) ) {
        $classes[] = 'tagline-hidden';
    } elseif ( ( false === get_theme_mod( 'typenow_display_title' ) ) && ( false === get_theme_mod( 'typenow_display_tagline' ) ) ) {
        $classes[] = 'title-tagline-hidden';
    }
    
    return $classes;
}
add_filter( 'body_class', 'typenow_body_classes' );

/**
 * Checks to see if we're on the homepage or not.
 */
function typenow_is_frontpage() {
	return ( is_front_page() && ! is_home() );
}
