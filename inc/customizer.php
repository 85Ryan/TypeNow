<?php
/**
 * TypeNow Customizer.
 *
 * @package:    TypeNow
 * @since:      1.0
 * @version:    1.0
 */

// Add postMessage support for site title and description for the Theme Customizer.
function typenow_customize_register( $wp_customize ) {

    $wp_customize->get_setting( 'blogname' )->transport          = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport   = 'postMessage';
    $wp_customize->get_setting( 'header_image'  )->transport = 'postMessage';
    $wp_customize->get_setting( 'header_image_data'  )->transport = 'postMessage';

    $wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector' => '.site-title a',
		'render_callback' => 'typenow_customize_partial_blogname',
	) );
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector' => '.site-description',
		'render_callback' => 'typenow_customize_partial_blogdescription',
	) );

    // Display  Bloginfo.
	$wp_customize->add_setting('typenow_display_title', array(
        'capability' => 'edit_theme_options',
        'theme-supports' => array( 'custom-logo', 'header-text' ),
        'default' => 1,
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control('typenow_display_title', array(
        'settings' => 'typenow_display_title',
        'label'    => __('Display Site Title', 'typenow'),
        'section'  => 'title_tagline',
        'type'     => 'checkbox',
    ));

    $wp_customize->add_setting('typenow_display_tagline', array(
        'capability' => 'edit_theme_options',
        'theme-supports' => array( 'custom-logo', 'header-text' ),
        'default' => 1,
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control('typenow_display_tagline', array(
        'settings' => 'typenow_display_tagline',
        'label'    => __('Display Site Tagline', 'typenow'),
        'section'  => 'title_tagline',
        'type'     => 'checkbox',
    ));
}
add_action( 'customize_register', 'typenow_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 */
function typenow_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 */
function typenow_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Bind JS handlers to instantly live-preview changes.
 */
function typenow_customize_preview_js() {
	wp_enqueue_script( 'typenow-customize-preview', get_theme_file_uri( '/assets/js/customize-preview.js' ), array( 'customize-preview' ), '1.0', true );
}
add_action( 'customize_preview_init', 'typenow_customize_preview_js' );
