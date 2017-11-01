<?php
/**
 * Custom header implementation.
 *
 * @package:    TypeNow
 * @since:      1.0
 * @version:    1.0
 */

/**
 * Set up the WordPress core custom header feature.
 */
function typenow_custom_header_setup() {
    
    // Filter TypeNow custom-header support arguments.
    add_theme_support( 'custom-header', apply_filters( 'typenow_custom_header_args', array(
        'default-image'     => get_parent_theme_file_uri('/assets/images/header.jpg'),
        'width'             => 2000,
        'height'            => 1200,
        'flex-height'       => true,
        'video'             => false,
        'wp-head-callback'  => 'typenow_header_style',
        'header-text'       => false,
    ) ) );
    
    register_default_headers( array(
        'default-image' => array(
            'url'           => '%s/assets/images/header.jpg',
            'thumbnail_url' => '%s/assets/images/header.jpg',
            'description'   => __( 'Default Header Image', 'typenow' ),
        ),
    ) );
}
add_action( 'after_setup_theme', 'typenow_custom_header_setup' );

if ( ! function_exists( 'typenow_header_style' ) ) :
// Styles the text displayed on the blog.
function typenow_header_style() {

    ?>
    <style id="typenow-custom-header-styles" type="text/css">
    <?php
        if ( false === get_theme_mod( 'typenow_display_title', typenow_get_theme_default( 'typenow_display_title' ) ) ) {
    ?>
        .site-title {
            position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
        }
    <?php } ?>
    <?php
        if ( false === get_theme_mod( 'typenow_display_tagline', typenow_get_theme_default( 'typenow_display_tagline' ), ) ) {
    ?>
        .site-description {
            position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
        }
    <?php } ?>
    </style>
    <?php
}
endif; // End of typenow_header_style.
