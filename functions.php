<?php 
/**
 * Typenow functions and definitions.
 *
 * @package:    TypeNow
 * @since:      1.0
 * @version:    1.0
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
    load_theme_textdomain( 'typenow', get_template_directory() . '/lang' );
    
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
        'quote',
		'status',
    ) );
    
    // Add them support for Custom Logo.
    add_theme_support( 'custom-logo', array(
        'width'       => 250,
		'height'      => 250,
		'flex-width'  => true,
    ) );

    // Customize the visual editor to resemble the theme style.
    add_editor_style( 'assets/css/editor-style.css' );

    // Define and register starter content to showcase the theme on new sites.
    $starter_content = array(
        // Specify the core-defined pages to create and add custom thumbnails to some of them.
        'posts' => array(
            'about' => array(
                'thumbnail' => '{{image-about}}',
            ),
            'archive' => array(
                'post_type' => 'page',
                'post_title' => __('Archive', 'typenow'),
                'post_name' => 'archive',
                'template' => 'archives.php',
                'thumbnail' => '{{image-archive}}',
            ),
            'search' => array(
                'post_type' => 'page',
                'post_title' => __('Search', 'typenow'),
                'post_name' => 'search',
                'template' => 'search-page.php',
                'thumbnail' => '{{image-search}}',
            ),
        ),

        // Create the custom image attachments used as post thumbnails for pages.
		'attachments' => array(
			'image-about' => array(
				'post_title' => _x( 'About', 'Theme starter content', 'typenow' ),
				'file' => 'assets/images/about.jpg',
			),
			'image-archive' => array(
				'post_title' => _x( 'Archive', 'Theme starter content', 'typenow' ),
				'file' => 'assets/images/archive.jpg',
			),
			'image-search' => array(
				'post_title' => _x( 'Search', 'Theme starter content', 'typenow' ),
				'file' => 'assets/images/search.jpg',
			),
		),

		// Set up nav menus for each of the two areas registered in the theme.
		'nav_menus' => array(
			// Assign a menu to the "top" location.
			'top' => array(
				'name' => __( 'Top Menu', 'typenow' ),
				'items' => array(
					'link_home',
					'page_archive' => array (
                        'type' => 'post_type',
                        'object' => 'page',
                        'object_id' => '{{archive}}',
                    ),
                    'page_about',
				),
			),
			// Assign a menu to the "social" location.
			'social' => array(
				'name' => __( 'Social Links Menu', 'typenow' ),
				'items' => array(
					'link_github',
					'link_facebook',
					'link_twitter',
					'link_instagram',
                    'link_yelp',
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

    // Include post-directory.js in single and page.
    if ( get_theme_mod('typenow_post_dir', typenow_get_theme_default( 'typenow_post_dir' )) == true && ( is_single() || (is_page() && !is_page_template()) ) ) {
        wp_enqueue_script( 'post-dir', get_theme_file_uri( '/assets/js/post-directory.js' ), array( 'jquery' ), '1.0', true );
    }

    if ( has_nav_menu( 'top' ) ) {
        wp_enqueue_script( 'typenow-script', get_theme_file_uri( '/assets/js/functions.js' ), array( 'jquery' ), '1.0', true );
    }
    
    wp_enqueue_script( 'typenow-global', get_theme_file_uri( '/assets/js/global.js' ), array( 'jquery' ), '1.0', true );
    
    wp_enqueue_script( 'jquery-scrollto', get_theme_file_uri( '/assets/js/jquery.scrollTo.js' ), array( 'jquery' ), '2.1.2', true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    // Highlight
    if ( get_theme_mod('typenow_high_light', typenow_get_theme_default( 'typenow_high_light' )) == true ) {
        // Highlight.js
        wp_enqueue_script( 'bootcdn-highlight', get_theme_file_uri( '/assets/js/highlight.min.js' ), array( 'jquery' ), '9.12.0', true );

        // Highlight.js xcode stylesheet.
        wp_enqueue_style( 'highlight-style-xcode', get_theme_file_uri( '/assets/css/highlight.js.css' ), array( 'typenow-style' ), '9.12.0' );
    }
}
add_action( 'wp_enqueue_scripts', 'typenow_scripts' );

/**
 * Load Highlight.js.
 */
function typenow_highlighting_load() {
    if ( get_theme_mod('typenow_high_light', typenow_get_theme_default( 'typenow_high_light' )) == true ) {
        echo "<script>hljs.initHighlightingOnLoad();</script>\n";
    }
}
add_action( 'wp_footer', 'typenow_highlighting_load',99 );


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
 * Get copyright time.
 */
function typenow_copyright() {
    global $wpdb;
    $url = home_url( '/' );
    if ( get_theme_mod('typenow_site_owner', typenow_get_theme_default( 'typenow_site_owner' )) != '' ) {
        $copyname = get_theme_mod('typenow_site_owner', typenow_get_theme_default( 'typenow_site_owner' ));
    } else {
        $copyname = get_bloginfo('name');
    }
    $first = $wpdb -> get_results("
        SELECT user_registered
        FROM   $wpdb->users
        ORDER BY  ID ASC
        LIMIT 0,1
    ");
    $copyright = '';
    $current = date( 'Y' ) ;
    if( $first ) {
        $first = date( 'Y', strtotime( $first[0] -> user_registered ) );
        $copytime = $first;
    if( $first != $current ) {
        $copytime .= '-' .$current;
    }
    $copyright = sprintf( wp_kses(__('&copy; <a href="%1$s">%2$s</a>, %3$s', 'typnow'), array(  'a' => array( 'href' => array() ) ) ) , esc_url( $url ),$copyname, $copytime );
    }
    echo  $copyright;
}

/**
 * Add 'EOF' to entry content for single.
 */
function typenow_single_eof ( $content ) {
	if ( is_single() && ! has_post_format( array ('aside', 'status', 'quote') ) ) {
		$content .= '<p class="text-eof">#EOF</p>';
	}
	return $content;
}
add_filter( 'the_content', 'typenow_single_eof', 8 ); // After embeds,

/**
 * Re-Define the post excerpt length.
 */
function typenow_excerpt_length( $length ) {
    return 150;
}
add_filter( 'excerpt_length', 'typenow_excerpt_length', 999 );

/**
 * Define the related posts.
 */
// Get the thumbnail src.
function typenow_post_thumbnail_src(){
    global $post;
	if ( has_post_thumbnail() ){
        $thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'medium');
		$post_thumbnail_src = $thumbnail_src [0];
    } else {
		$post_thumbnail_src = '';
		ob_start();
		ob_end_clean();
        $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
        if ( $output ) {
            $post_thumbnail_src = $matches [1][0];
        } else {
            $post_thumbnail_src = ''.bloginfo('template_url').'/assets/images/related-post-default.jpg';
        }
	}
	return $post_thumbnail_src;
}

// Define related posts.
function typenow_related_post( $post_id ) {
    global $post, $posts;

    $post_num = get_theme_mod('typenow_related_post_num', typenow_get_theme_default( 'typenow_related_post_num' ));
    $exclude_id = $post->ID;
    $posttags = get_the_tags(); $i = 0;

    echo '<div class="related-post-container"><ul class="related-post-content">';

    if ( $posttags ) {

        $tags = ''; foreach ( $posttags as $tag ) $tags .= $tag->term_id . ',';
        $args = array(
            'post_status' => 'publish',
            'tag__in' => explode(',', $tags),
            'post__not_in' => explode(',', $exclude_id),
            'ignore_sticky_posts' => 1,
            'orderby' => 'comment_date',
            'posts_per_page' => $post_num
        );
        query_posts($args);
        while( have_posts() ) { the_post(); ?>
            <li class="related-post-list">
                <a href="<?php the_permalink(); ?>">
                <div class="related-post-thumb" style="background-image:url(<?php echo typenow_post_thumbnail_src(); ?>)">
                </div></a>
                <div class="related-post-title">
                    <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                </div>
                <div class="related-post-time">
                    <a href="<?php the_permalink(); ?>"><?php echo typenow_get_svg(array('icon' => 'time')); ?><?php echo date('M jS, Y', get_the_time('U')); ?></a>
                </div>
            </li>
        <?php
            $exclude_id .= ',' . $post->ID; $i ++;
        } wp_reset_query();
    }

    if ( $i < $post_num ) {
        $cats = ''; foreach ( get_the_category() as $cat ) $cats .= $cat->cat_ID . ',';
        $args = array(
            'category__in' => explode(',', $cats),
            'post__not_in' => explode(',', $exclude_id),
            'ignore_sticky_posts' => 1,
            'orderby' => 'comment_date',
            'posts_per_page' => $post_num - $i
        );
        query_posts($args);
        while( have_posts() ) { the_post(); ?>
            <li class="related-post-list">
                <a href="<?php the_permalink(); ?>">
                <div class="related-post-thumb" style="background-image:url(<?php echo typenow_post_thumbnail_src(); ?>)">
                </div></a>
                <div class="related-post-title">
                    <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                </div>
                <div class="related-post-time">
                    <a href="<?php the_permalink(); ?>"><?php echo typenow_get_svg(array('icon' => 'time')); ?><?php echo date('M jS, Y', get_the_time('U')); ?></a>
                </div>
            </li>
        <?php $i++;
        } wp_reset_query();
    }

    echo '</ul></div>';
}

/**
 * Customize the Password Protected Form.
 **/
function typenow_password_form( $post = 0 ) {
    $post = get_post( $post );
    $icon = typenow_get_svg( array( 'icon' => 'keychain' ) );

    $label = 'pwbox-' . ( empty($post->ID) ? rand() : $post->ID );

    $output = '<p class="protected-post-text">' . __('This content is password protected. To view it please enter your password below:') .'</p><div class="protected-post-form-container"><form class="protected-post-form" action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" class="post-password-form" method="post"><input name="post_password" id="' . $label . '" class="pw-field" type="password" placeholder="' . __('Please Enter the PassWord...', 'typenow') . '" size="20" /><button type="submit" class="pw-submit" name="Submit">' . $icon . '</button></form></div>';

    return $output;
}
add_filter( 'the_password_form', 'typenow_password_form' );

/**
 * Customize the protected title prefix.
 **/
function typenow_title_format() {
    return '%s';
}
add_filter('private_title_format', 'typenow_title_format');
add_filter('protected_title_format', 'typenow_title_format');

/**
 * Post Comment Reply Mail Notification.
 **/
function typenow_comment_mail_notify($comment_id) {
    $admin_email 	= get_bloginfo ('admin_email');
    $comment		= get_comment($comment_id);
    $post			= get_post( $comment->comment_post_ID );
    $parent_id		= $comment->comment_parent ? $comment->comment_parent : '';
    $spam_confirmed	= $comment->comment_approved;
    $blogname		= wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);
    if (($parent_id != '') && ($spam_confirmed != 'spam') && ($to != $admin_email)  && get_theme_mod('typenow_comment_email') == true ) {
        //$wp_email = 'no-reply@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME']));
        $wp_email = get_theme_mod('typenow_send_mail', typenow_get_theme_default( 'typenow_send_mail' ));
        $to = trim(get_comment($parent_id)->comment_author_email);
        $subject = sprintf( __('[%1$s] New Reply in "%2$s"', 'typenow'), $blogname, $post->post_title );
        $notify_message .= sprintf( __('<p>Hi, %s', 'typenow'), trim(get_comment($parent_id)->comment_author) ) . '</p>';
        $notify_message .= sprintf( __('<p>Your comment in "%s": ', 'typenow'), $post->post_title ) . '</p><blockquote style="padding-left:15px;border-left:4px solid #ddd;"><p>' . get_comment($parent_id)->comment_content . '</p></blockquote>';
        $notify_message .= sprintf( __('<p>%s reply: ', 'typenow'), $comment->comment_author ) . '</p><blockquote style="padding-left:15px;border-left:4px solid #ddd;"><p>' . $comment->comment_content . '</p></blockquote>';
        $notify_message .= __('<p>You can click here to reply the comment: ', 'typenow') .'</p><p>' . get_permalink($comment->comment_post_ID) . "#comment-$comment_id</p>";
        $notify_message .= __('<p>You can see all comments on this post here: ', 'typenow') . '</p><p>' . get_permalink($comment->comment_post_ID) . "#comments</p>";
        $notify_message .= __('<p>The email address for notification only, does not receive a reply, so please do not reply to this email.</p>', 'typenow');
        
        $from = "From: \"$blogname-Reply\" <$wp_email>";
        $message_headers = "$from\n"
			. "Content-Type: text/html; charset=\"" . get_option('blog_charset') . "\"\n";
        $notify_message = apply_filters('comment_notification_text', $notify_message, $comment_id);
        $subject = apply_filters('comment_notification_subject', $subject, $comment_id);
        $message_headers = apply_filters('comment_notification_headers', $message_headers, $comment_id);
        @wp_mail( $to, $subject, $notify_message, $message_headers );
    }
}
add_action('comment_post', 'typenow_comment_mail_notify');

/** 
 * Include template file.
 **/
// Implement the Custom Header feature.
require get_parent_theme_file_path( '/inc/custom-header.php' );
// Custom template tags for this theme.
require get_parent_theme_file_path( '/inc/template-tags.php' );
// Additional features to allow styling of the templates.
require get_parent_theme_file_path( '/inc/template-functions.php' );
// Customizer additions.
require get_parent_theme_file_path( '/inc/customizer.php' );
// Customiz comment form functions.
require get_parent_theme_file_path( '/inc/comment-functions.php' );
// SVG icons functions and filters.
require get_parent_theme_file_path( '/inc/icon-functions.php' );
// SEO functions and filters.
require get_parent_theme_file_path( '/inc/seo-functions.php' );
