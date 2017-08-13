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

/**
 * Replaces "[...]" with a 'Continue Reading' link.
 */
function typenow_excerpt_more( $link ) {
    if ( is_admin() ) {
        return $link;
    }
    
    $link = sprintf( 
        '<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>', 
        esc_url( get_permalink( get_the_ID() ) ),
        sprintf( __( 'Continue Reading<span class="screen-reader-text"> "%s"</span>', 'typenow' ), get_the_title( get_the_ID() ) )
    );
    return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'typenow_excerpt_more' );

/**
 * Handles JavaScript detection.
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 */
function typenow_javascript_detection() {
    
    echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n"; 
}
add_action( 'wp_head', 'typenow_javascript_detection', 0 );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function typenow_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
	}
}
add_action( 'wp_head', 'typenow_pingback_header' );

/**
 * Enqueue scripts and styles.
 */
function typenow_scripts() {
    
    // Theme stylesheet.
    wp_enqueue_style( 'typenow-style', get_stylesheet_uri() );
    
    // Load the html5 shiv.
    wp_enqueue_script( 'html5', get_theme_file_uri( '/assets/js/html5.js' ), array(), '3.7.3' );
    wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );
    
    wp_enqueue_script( 'typenow-skip-link-focus-fix', get_theme_file_uri( '/assets/js/skip-link-focus-fix.js' ), array(), '1.0', true );
    
    $typenow_l10n = array(
        'quote' => typenow_get_svg( array( 'icon' => 'quote-right' ) ),
    );
    
    if ( has_nav_menu( 'top' ) ) {
        wp_enqueue_script( 'typenow-navigation', get_theme_file_uri( '/assets/js/navigation.js' ), array( 'jquery' ), '1.0', true );
        $typenow_l10n['expand']         = __( 'Expand child menu', 'typenow' );
        $typenow_l10n['collapse']       = __( 'Collapse child menu', 'typenow' );
        $typenow_l10n['icon']           = typenow_get_svg( array( 'icon' => 'angle-down', 'fallback' => true ) );
    }
    
    wp_enqueue_script( 'typenow-global', get_theme_file_uri( '/assets/js/global.js' ), array( 'jquery' ), '1.0', true );
    
    wp_enqueue_script( 'jquery-scrollto', get_theme_file_uri( '/assets/js/jquery.scrollTo.js' ), array( 'jquery' ), '2.1.2', true );
    
    wp_localize_script( 'typenow-skip-link-focus-fix', 'typenowScreenReaderText', $typenow_l10n );
    
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'typenow_scripts' );

/**
 * Add custom image sizes attribute to enhance responsive image functionality for content images.
 */
function typenow_content_image_sizes_attr( $sizes, $size ) {
    $width = $size[0];
    
    if ( 740 <= $width ) {
        $sizes = '(max-width: 706px) 89vw, (max-width: 767px) 82vw, 740px';
    }
    
    if ( is_archive() || is_search() || is_home() || is_page() ) {
        if ( ! ( is_page() && 'one-column' === get_theme_mod( 'page_options' ) ) && 767 <= $width ) {
            $sizes = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
        }
    }
    return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'typenow_content_image_sizes_attr', 10, 2 );

/**
 * Filter the `sizes` value in the header image markup.
 */
function typenow_header_image_tag ( $html, $header, $attr ) {
	if ( isset( $attr['sizes'] ) ) {
		$html = str_replace( $attr['sizes'], '100vw', $html );
	}
	return $html;
}
add_filter( 'get_header_image_tag', 'typenow_header_image_tag', 10, 3 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality for post thumbnails.
 */
function typenow_post_thumbnail_sizes_attr ( $attr, $attachment, $size ) {
	if ( is_archive() || is_search() || is_home() ) {
		$attr['sizes'] = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
	} else {
		$attr['sizes'] = '100vw';
	}

	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'typenow_post_thumbnail_sizes_attr', 10, 3 );

/** 
 * Include template file.
 */
// Implement the Custom Header feature.
require get_parent_theme_file_path( '/inc/custom-header.php' );
// Custom template tags for this theme.
require get_parent_theme_file_path( '/inc/template-tags.php' );
// Additional features to allow styling of the templates.
require get_parent_theme_file_path( '/inc/template-functions.php' );
// Customizer additions.
require get_parent_theme_file_path( '/inc/customizer.php' );
// SVG icons functions and filters.
require get_parent_theme_file_path( '/inc/icon-functions.php' );