<?php
/**
 * Custom header implementation.
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
// Styles the header image and text displayed on the blog.
function typenow_header_style() {
    $header_text_color = get_header_textcolor();
    if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
        return;
    }

    ?>
    <style id="typenow-custom-header-styles" type="text/css">
    <?php
        if ( 'blank' === $header_text_color ) :
    ?>
        .site-title,
        .site-description {
            position: absolute;
            clip: rect(1px, 1px, 1px, 1px);
        }
    <?php
        else :
    ?>
        .site-title a,
		.colors-dark .site-title a,
		.colors-custom .site-title a,
		body.has-header-image .site-title a,
		body.has-header-video .site-title a,
		body.has-header-image.colors-dark .site-title a,
		body.has-header-video.colors-dark .site-title a,
		body.has-header-image.colors-custom .site-title a,
		body.has-header-video.colors-custom .site-title a,
		.site-description,
		.colors-dark .site-description,
		.colors-custom .site-description,
		body.has-header-image .site-description,
		body.has-header-video .site-description,
		body.has-header-image.colors-dark .site-description,
		body.has-header-video.colors-dark .site-description,
		body.has-header-image.colors-custom .site-description,
        body.has-header-video.colors-custom .site-description {
            color: #<?php echo esc_attr( $header_text_color ); ?>;
        }
        <?php endif; ?>
    </style>
    <?php
}
endif; // End of typenow_header_style.