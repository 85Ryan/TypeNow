<?php 
/**
 * Typenow functions and definitions.
 *
 */

/**
 * TypeNow only works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function typenow_setup() {
    
    // Make theme available for translation.
    load_theme_textdomain( 'typenow' );
    
    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );
    
    // Let WordPress manage the document title.
    add_theme_support( 'title-tag' );
    
    // Enable support for post Thumbnails on posts and pages.
    add_theme_support( 'post-thumbnails' );
    add_image_size( 'typenow-featured-image', 2000, 1200, true );
    add_image_size( 'typenow-thumbnail-avatar', 100, 100, true );
    
    // Set the default content width.
    $GLOBALS['content_width'] = 525;
    
    // TypeNow uses wp_nav_menu() in two locations.
    register_nav_menus( array(
		'top'    => __( 'Top Menu', 'typenow' ),
		'social' => __( 'Social Links Menu', 'typenow' ),
	) );
    
    // Switch default core markup for search form, comment form, and comments to output valid HTML5.
    add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
    
    // Enable support for Post Formats.
    add_theme_support( 'post-formats', array(
        'aside',
        'image',
        'quote',
        'link',
    ) );
    
    // Add them support for Custom Logo.
    add_theme_support( 'custom-logo', array(
        'width'       => 250,
		'height'      => 250,
		'flex-width'  => true,
    ) );
    
	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
    
    // Customize the visual editor to resemble the theme style.
    add_editor_style( 'assets/css/editor-style.css' );
    
    // Define and register starter content on new sites.
    $starter_content = array(
        
        // Add custom thumbnail to specify the core-defined pages.
        'posts' => array(
            'home',
            'about' => array(
                'thumbnail' => '{{image-sandwich}}',
            ),
            'content' => array(
                'thumbnail' => '{{image-espresso}}',
            ),
            'archive' => array(
                'thumbnail' => '{{image-coffee}}',
            ),
        ),
        
        // Creat the custom image attachments used as post thumbnails for pages.
        'attachments' => array(
			'image-espresso' => array(
				'post_title' => _x( 'Espresso', 'Theme starter content', 'typenow' ),
				'file' => 'assets/images/espresso.jpg',
			),
			'image-sandwich' => array(
				'post_title' => _x( 'Sandwich', 'Theme starter content', 'typenow' ),
				'file' => 'assets/images/sandwich.jpg',
			),
			'image-coffee' => array(
				'post_title' => _x( 'Coffee', 'Theme starter content', 'typenow' ),
				'file' => 'assets/images/coffee.jpg',
			),
        ),
        
        // Set up nav menus.
        'nav-menus' => array(
            'top' => array(
                'name' => __( 'Top Menu', 'typenow' ),
                'items' => array(
                    'link_home',
                    'page_about',
                    'page_archive',
                    'page_contact',
                ),
            ),
            
            'social' => array(
                'name' => __( 'Social Links Menu', 'typenow' ),
                'items' => array(
                    'link_weibo',
                    'link_twitter',
                    'link_facebook',
                    'link_instagram',
                    'link_email',
                ),
            ),
        ),
    );
    $starter_content = apply_filters( 'typenow_starter_content', $starter_content );
    
    add_theme_support( 'starter-content', $starter_content );
}
add_action( 'after_setup_theme', 'typenow_setup' ); 