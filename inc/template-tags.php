<?php
/**
 * Custom template tags for this theme.
 *
 * @package:    TypeNow
 * @since:      1.0
 * @version:    1.0
 */

/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
if ( ! function_exists( 'typenow_posted_on' ) ) :
function typenow_posted_on() {

    $sep = sprintf( __( '%s', 'typenow' ), '<span class="entry-meta-sep">|</span>' );

    $categories_list = sprintf(
        __( '%1$sin %2$s', 'typenow' ), $sep,
		'<span class="cats-links">' . get_the_category_list( __( ', ', 'typenow' ) ) . '</span>'
    );

    $byline = sprintf(
        __( 'by %s', 'typenow' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . get_the_author() . '</a></span>'
    );
    
    echo '<span class="posted-on">' . _e( 'Posted on ' , 'typenow' ) . typenow_time_link() . '</span>' . $categories_list .'<span class="byline">'. $sep . $byline . '</span>';

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
        date('M jS, Y', get_the_time('U')),
		get_the_modified_date( DATE_W3C ),
		date('M jS, Y', get_the_modified_time('U'))
    );
    
    return sprintf(
		/* translators: %s: post date */
		__( '<span class="screen-reader-text">Posted on</span> %s', 'typenow' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);
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
