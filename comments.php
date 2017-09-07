<?php 
/** 
 * The template for displaying comments.
 *
 * @package:    TypeNow
 * @since:      1.0
 * @version:    1.0
 */

if ( post_password_required() ) {
    return;
}
?>
<div id="comments" class="comments area">
    <?php 
	comment_form();
    if ( have_comments() ) : ?>
        <ol class="comment-list">
            <?php
				wp_list_comments( array(
					'avatar_size' => 40,
					'style'       => 'ol',
					'short_ping'  => true,
					'reply_text'  => typenow_get_svg( array( 'icon' => 'comment-reply' ) ) . __( 'Reply', 'typenow' ),
				) );
			?>
        </ol>
        
        <?php the_comments_pagination( array(
			'prev_text' => typenow_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . __( 'Previous', 'typenow' ) . '</span>',
			'next_text' => '<span class="screen-reader-text">' . __( 'Next', 'typenow' ) . '</span>' . typenow_get_svg( array( 'icon' => 'arrow-right' ) ),
            'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'typenow' ) . ' </span>',
		) );
    endif;
    ?>
</div><!-- #comments .comments-area -->
