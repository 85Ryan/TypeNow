<?php
/**
 * Custom template tags for this theme.
 */

/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
if ( ! function_exists( 'typenow_posted_on' ) ) :
function typenow_posted_on() {
    $byline = sprintf(
        __( 'by %s', 'typenow' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . get_the_author() . '</a></span>'
    );
    
    echo '<span class="posted-on">' . typenow_time_link() . '</span><span class="byline"> ' . $byline . '</span>';
}
endif;

/**
 * Gets a nicely formatted string for the published date.
 */
if ( ! function_exists( 'typenow_time_link' ) ) :
function typenow_time_link() {
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
    }
    
    $time_string = sprintf( $time_string,
        get_the_date( DATE_W3C ),
        get_the_date(),
		get_the_modified_date( DATE_W3C ),
		get_the_modified_date()
    );
    
    return sprintf(
		/* translators: %s: post date */
		__( '<span class="screen-reader-text">Posted on</span> %s', 'typenow' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);
}
endif;

/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
if ( ! function_exists( 'typenow_entry_footer' ) ) :
function typenow_entry_footer() {
    // Translators: used between list items, there is a space after the comma.
    $separate_meta = __( ', ', 'typenow' );
    
    // Get Categories for posts.
    $categories_list = get_the_category_list( $separate_meta );
    
    // Get Tags for posts.
    $tags_list = get_the_tag_list( '', $separate_meta );
    
    if ( ( ( typenow_categorized_blog() && $categories_list ) || $tags_list ) || get_edit_post_link() ) {
        echo '<footer class="entry-footer">';
            if ( 'post' === get_post_type() ) {
                if ( ( $categories_list && typenow_categorized_blog() ) || $tags_list ) {
                    echo '<span class="cat-tags-links">';
                    if ( $categories_list && typenow_categorized_blog() ) {
                        echo '<span class="cat-links">' . typenow_get_svg( array( 'icon' => 'folder-open' ) ) . '<span class="screen-reader-text">' . __( 'Categories', 'typenow' ) . '</span>' . $categories_list . '</span>';
                    }
                    if ( $tags_list ) {
                        echo '<span class="tags-links">' . typenow_get_svg( array( 'icon' => 'hashtag' ) ) . '<span class="screen-reader-text">' . __( 'Tags', 'typenow' ) . '</span>' . $tags_list . '</span>';
                    }
                    echo '</span>';
                }
            }
            typnow_edit_link();
        echo '</footer> <!-- .entry-footer -->';
    }
    
}
endif;

/**
 * Returns an accessibility-friendly link to edit a post or page.
 */
if ( ! function_exists( 'typenow_edit_link' ) ) :
function typenow_edit_link() {
    edit_post_link(
        sprintf(
            __( 'Edit<span class="screen-reader-text"> "%s"</span>', 'typenow' ),
            get_the_time()
        ),
        '<span class="edit-link">',
        '</span>'
    );
}
endif;

/**
 * Display a front page section.
 */
function typenow_front_page_section( $partial = null, $id = 0 ) {
    if ( is_a( $partial, 'WP_Customize_Partial' ) ) {
        global $typenowcounter;
        $id = str_replace( 'panel_', '', $partial->id );
        $typenowcounter = $id; 
    }
    global $post;
    if ( get_theme_mod( 'panel_' . $id ) ) {
        $post = get_post( get_theme_mod( 'panel_' . $id ) );
        setup_postdata( $post );
        set_query_var( 'panel', $id );
        
        get_template_part( 'template-parts/page/content', 'front-page-panels' );

        wp_reset_postdata();
    } elseif ( is_customize_preview() ) {
        echo '<article class="panel-placeholder panel typenow-panel typenow-panel' . $id . '" id="panel' . $id . '"><span class="typenow-panel-title">' . sprintf( __( 'Front Page Section %1$s Placeholder', 'typenow' ), $id ) . '</span></article>';
    }
}

/**
 * Returns true if a blog has more than 1 category.
 */
function typenow_categorized_blog() {
    $category_count = get_transient( 'typenow_categories' );
    if ( false === $category_count ) {
        $categories = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			'number'     => 2,
        ) );
        // Count the number of categories that are attached to the posts.
		$category_count = count( $categories );
        set_transient( 'typenow_categories', $category_count );
    }
    
    // Allow viewing case of 0 or 1 categories in post preview.
	if ( is_preview() ) {
		return true;
	}
    return $category_count > 1;
}

/**
 * Flush out the transients used in typenow_categorized_blog.
 */
function typenow_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	delete_transient( 'typenow_categories' );
}
add_action( 'edit_category', 'typenow_category_transient_flusher' );
add_action( 'save_post',     'typenow_category_transient_flusher' );