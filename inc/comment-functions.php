<?php
/**
 * Customize the comment functions.
 *
 * @package:    TypeNow
 * @since:      1.0
 * @version:    1.0
 */

/**
 * Customize the comment form fields.
 */
function typenow_comment_form_fields($fields) {
    $commenter = wp_get_current_commenter();
    $args = array();
    $args = wp_parse_args( $args );
	if ( ! isset( $args['format'] ) )
		$args['format'] = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';
    $req      = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $html_req = ( $req ? " required='required'" : '' );
    $html5    = 'html5' === $args['format'];

    $fields['author'] = '<input id="author" name="author" type="text" placeholder="' . __( 'Name', 'TypeNow' ) . ( $req ? ' *' : '' ) . '" value="' . esc_attr( $commenter['comment_author'] ) . '"' . $aria_req . ' />';

    $fields['email'] = '<input id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) .'placeholder="' . __( 'Email', 'TypeNow' ) . ( $req ? ' *' : '' ) . '" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" aria-describedby="email-notes"' . $aria_req . $html_req  . ' />';

    $fields['url'] = '<input id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) .'placeholder="' . __( 'Website', 'TypeNow' ).' " value="' . esc_attr( $commenter['comment_author_url'] ) . '" />';

    return $fields;

}
add_filter('comment_form_default_fields','typenow_comment_form_fields');


/**
 * Customize the comment form defaults.
 */
function typenow_comment_form_defaults($defaults) {
    $req      = get_option( 'require_name_email' );

    $defaults['comment_field'] = '<textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" placeholder="'. __( 'Your email address will not be published. ','typenow') . ( $req ? __('Required fields are marked ( * ).', 'typenow') : __('You can also post a comment anonymously.', 'typenow') ) . '" aria-required="true" required="required"></textarea>';

    $defaults['comment_notes_before'] = '';
    $defaults['comment_notes_after'] = '<p class="form-allowed-tags">' .
    sprintf(
      __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s' ),
      ' <code>' . allowed_tags() . '</code>'
    ) . '</p>';
    $defaults['label_submit'] = __( 'Submit', 'typenow' );
    $defaults['submit_field'] = '%1$s %2$s';
    $defaults['cancel_reply_before'] = '<span class="cancel-reply">';
    $defaults['cancel_reply_after'] = '</span>';
    $defaults['cancel_reply_link'] = typenow_get_svg( array( 'icon' => 'cancel-reply' ) ) . __( 'Cancel Reply', 'typenow' );

    return $defaults;
 }
add_filter( 'comment_form_defaults', 'typenow_comment_form_defaults' );

/**
 * Customize the comment date format.
 */
function typenow_get_comment_date( $date, $d = '', $comment_ID = 0 ) {
	$comment = get_comment( $comment_ID );
    $comment_date = $comment->comment_date;
	if ( '' == $d )
		$date = mysql2date('M jS, Y', $comment_date, false);
	else
		$date = mysql2date($d, $comment_date, false);

	return $date;
}
add_filter( 'get_comment_date', 'typenow_get_comment_date' );

/**
 * Customize the comment time format.
 */
function typenow_get_comment_time( $date, $d = '', $gmt = false, $translate=false ) {
    $comment = get_comment();
    $comment_date = $gmt ? $comment->comment_date_gmt : $comment->comment_date;
	if ( '' == $d )
		$date = mysql2date('@ h:i A', $comment_date, $translate);
	else
		$date = mysql2date($d, $comment_date, $translate);

    return $date;
}
add_filter( 'get_comment_time', 'typenow_get_comment_time' );

/**
 * Add @user when reply comment.
 */
function typenow_comment_add_at( $comment_text, $comment = '') {
  if( $comment->comment_parent > 0) {
    $comment_text = '<span class="at-user">@</span><a href="#comment-' . $comment->comment_parent . '">'.get_comment_author( $comment->comment_parent ) . '</a>, ' . $comment_text;
  }

  return $comment_text;
}
add_filter( 'comment_text' , 'typenow_comment_add_at', 20, 2);
