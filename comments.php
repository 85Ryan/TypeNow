<?php 
/** 
 * The template for displaying comments.
 */

if ( post_password_required() ) {
    return;
}
?>
<div id="comments" class="comments area">
    <?php 
    if ( have_comments() ) : ?>
        <h2 class="comments title">
            <?php 
            $comments_number = get_comments_number();
            if ( '1' === $comments_number ) {
                printf( _x( 'One Reply to &ldquo;%s&rdquo;', 'comments title', 'typenow' ), get_the_title() );
            } else {
                printf(
                    _nx(
						'%1$s Reply to &ldquo;%2$s&rdquo;',
						'%1$s Replies to &ldquo;%2$s&rdquo;',
						$comments_number,
						'comments title',
						'twentyseventeen'
					),
                    number_format_i18n( $comments_number ),
                    get_the_title()
                );
            }
            ?>
        </h2>
        
        <ol class="comment-list">
            <?php
				wp_list_comments( array(
					'avatar_size' => 100,
					'style'       => 'ol',
					'short_ping'  => true,
					'reply_text'  => typenow_get_svg( array( 'icon' => 'mail-reply' ) ) . __( 'Reply', 'typenow' ),
				) );
			?>
        </ol>
        
        <?php the_comments_pagination( array(
			'prev_text' => typenow_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . __( 'Previous', 'typenow' ) . '</span>',
			'next_text' => '<span class="screen-reader-text">' . __( 'Next', 'typenow' ) . '</span>' . typenow_get_svg( array( 'icon' => 'arrow-right' ) ),
		) );
    endif;
        
    comment_form();
    ?>
</div><!-- #comments .comments-area -->