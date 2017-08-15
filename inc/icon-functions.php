<?php
/**
 * SVG icons related functions and filters.
 */


/**
 * Add SVG definitions to the footer.
 */
function typenow_include_svg_icons() {
    // Define SVG sprite file.
    $svg_icons = get_parent_theme_file_path( '/assets/images/svg-icons.svg' );
    
    if ( file_exists( $svg_icons ) ) {
        require_once( $svg_icons );
    }
}
add_action( 'wp_footer', 'typenow_include_svg_icons', 9999 );

/**
 * Return SVG markup.
 */
function typenow_get_svg( $args = array() ) {
    if ( empty( $args ) ) {
        return __( 'Please define default parameters in the form of an array.', 'typenow' );
    }
    
    // Define an icon.
    if ( false === array_key_exists( 'icon', $args ) ) {
        return __( 'Please define an SVG icon filename.', 'typenow' );
    }
    
    // Set defaults.
    $defaults = array(
        'icon'      => '',
        'title'     => '',
        'desc'      => '',
        'fallback'  => false,
    );
    
    // Parse args.
	$args = wp_parse_args( $args, $defaults );
    
    // Set aria hidden.
    $aria_hidden = ' aria-hidden="true"';
    
    // Set ARIA.
    $aria_labelledby = '';
    
    if ( $args['title'] ) {
        $aria_hidden        = '';
        $unique_id          = uniqid();
        $aria_labelledby    = ' aria-labelledby="title-' . $unique_id . '"';
        
        if ( $args['desc'] ) {
            $aria_labelledby = ' aria-labelledby="title-' . $unique_id . ' desc-' . $unique_id . '"';
        }
    }
    
    // Begin SVG markup.
    $svg = '<svg class="icon icon-' . esc_attr( $args['icon'] ) . '"' . $aria_hidden . $aria_labelledby . ' role="img">';
    
    // Display the title.
    if ( $args['title'] ) {
        $svg .= '<title id="title-' . $unique_id . '">' . esc_html( $args['title'] ) . '</title>';
        
        // Display the desc only if the title is already set.
        if ( $args['desc'] ) {
            $svg .= '<desc id="desc-' . $unique_id . '">' . esc_html( $args['desc'] ) . '</desc>';
        }
    }
    
    // Display the icon.
    $svg .= ' <use href="#icon-' . esc_html( $args['icon'] ) . '" xlink:href="#icon-' . esc_html( $args['icon'] ) . '"></use> ';
    
    if ( $args['fallback'] ) {
        $svg .= '<span class="svg-fallback icon-' . esc_attr( $args['icon'] ) . '"></span>';
    }
    
    $svg .= '</svg>';
    
    return $svg;
}

/**
 * Display SVG icons in social links menu.
 */
function typenow_nav_menu_social_icons( $item_output, $item, $depth, $args ) {
    // Get supported social icons.
    $social_icons = typenow_social_links_icons();
    
    // Change SVG icon inside social links menu if there is supported URL.
    if ( 'social' === $args->theme_location ) {
        foreach( $social_icons as $attr => $value ){
            if ( false !== strpos( $item_output, $attr ) ) {
                $item_output = str_replace( $args->link_after, '</span>' . typenow_get_svg( array( 'icon' => esc_attr( $value ) ) ), $item_output );
            }
        }
    }
    return $item_output;
}

add_filter( 'walker_nav_menu_start_el', 'typenow_nav_menu_social_icons', 10, 4 );

/**
 * Add dropdown icon if menu item has children.
 */
function typenow_dropdown_icon_to_menu_link( $title, $item, $args, $depth ) {
    if ( 'top' === $args->theme_location ) {
        foreach ( $item->classes as $value ) {
            if ( 'menu-item-has-children' === $value || 'page_item_has_children' === $value ) {
                $title = $title . typenow_get_svg( array( 'icon' => 'angle-down' ) );
            }
        }
    }
    return $title;
}
add_filter( 'nav_menu_item_title', 'typenow_dropdown_icon_to_menu_link', 10, 4 );

/**
 * Returns an array of supported social links (URL and icon name).
 */
function typenow_social_links_icons() {
    // Supported social links icons.
    $social_links_icons = array(
        'behance.net'     => 'behance',
        'codepen.io'      => 'codepen',
		'deviantart.com'  => 'deviantart',
		'digg.com'        => 'digg',
		'dribbble.com'    => 'dribbble',
		'dropbox.com'     => 'dropbox',
		'facebook.com'    => 'facebook',
		'flickr.com'      => 'flickr',
		'foursquare.com'  => 'foursquare',
		'plus.google.com' => 'google-plus',
		'github.com'      => 'github',
		'instagram.com'   => 'instagram',
		'linkedin.com'    => 'linkedin',
		'mailto:'         => 'envelope-o',
		'medium.com'      => 'medium',
		'pinterest.com'   => 'pinterest-p',
		'getpocket.com'   => 'get-pocket',
		'reddit.com'      => 'reddit-alien',
		'skype.com'       => 'skype',
		'skype:'          => 'skype',
		'slideshare.net'  => 'slideshare',
		'snapchat.com'    => 'snapchat-ghost',
		'soundcloud.com'  => 'soundcloud',
		'spotify.com'     => 'spotify',
		'stumbleupon.com' => 'stumbleupon',
		'tumblr.com'      => 'tumblr',
		'twitch.tv'       => 'twitch',
		'twitter.com'     => 'twitter',
		'vimeo.com'       => 'vimeo',
		'vine.co'         => 'vine',
		'vk.com'          => 'vk',
        'weibo.com'       => 'weibo',
		'wordpress.org'   => 'wordpress',
		'wordpress.com'   => 'wordpress',
		'yelp.com'        => 'yelp',
		'youtube.com'     => 'youtube',
    );
    return apply_filters( 'typenow_social_links_icons', $social_links_icons );
}