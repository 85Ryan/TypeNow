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

    global $randval;

    $commenter = wp_get_current_commenter();
    $args = array();
    $args = wp_parse_args( $args );
	if ( ! isset( $args['format'] ) )
		$args['format'] = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';
    $req      = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $html_req = ( $req ? " required='required'" : '' );
    $html5    = 'html5' === $args['format'];

    for ( $i=0; $i<4; $i++ ) {
        $randstr = mt_rand(ord('A'),ord('Z'));
        srand((double)microtime()*1000000);
        $randv = mt_rand(1,9);
        if ( $randv%2 == 0 ) {
            $randval.=mt_rand(1,9);
        } else {
            $randval.=chr($randstr);
        }
    };

    $fields['author'] = '<input id="author" name="author" type="text" placeholder="' . __( 'Name', 'typenow' ) . ( $req ? ' *' : '' ) . '" value="' . esc_attr( $commenter['comment_author'] ) . '"' . $aria_req . ' />';

    $fields['email'] = '<input id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) .'placeholder="' . __( 'Email', 'typenow' ) . ( $req ? ' *' : '' ) . '" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" aria-describedby="email-notes"' . $aria_req . $html_req  . ' />';

    $fields['url'] = '<input id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) .'placeholder="' . __( 'Website', 'typenow' ).' " value="' . esc_attr( $commenter['comment_author_url'] ) . '" />';

    // Add comment captcha fields.
    if (get_theme_mod('typenow_comment_captcha', '') == '1') {
        $fields['captcha'] = '<p class="comment-form-captcha">' . '<label for="subpcodes">' . __('Please Enter the Xaptcha: ','typenow').' <span class="required">*</span></label><input type="text"  size="4" id="subpcodes" class="subpcodes" name="subpcodes"><span class="pcodes">'.$randval.'</span><input type="hidden" value="'.$randval.'" name="pcodes"></p>';
    };

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

    if (get_theme_mod('typenow_comment_markdown', '') == '1') {
        $defaults['comment_notes_after'] = '<div class="comment-notes-after"><p class="form-allowed-tags">' .
        sprintf(
        __( 'You may use the <strong>Markdown</strong> tags and attributes.' )) . '</p></div>';
    } else {
        $defaults['comment_notes_after'] = '<div class="comment-notes-after"><p class="form-allowed-tags">' .
        sprintf(
        __( 'You may use the <strong>HTML</strong> tags and attributes.' )) . '</p></div>';
    }
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

/**
 * Add Comment captcha.
 */
function typenow_comment_captcha(){

    global $alert;

    $user = wp_get_current_user();

	if ( !$user->ID ) {
		$pcodes = trim($_POST['pcodes']);
		$subpcodes = trim($_POST['subpcodes']);
		$alert .= sprintf( __( 'Captcha Error, Please Re-enter!','typenow' ) );
		if((($pcodes)!=$subpcodes)|| empty($subpcodes)){
			echo "<meta http-equiv=\"Content-Type\" content=\"text/html\" charset=\"utf-8\">\r\n";
			echo "<script language=\"JavaScript\">\r\n";
			echo " alert(\"$alert\");\r\n";
			echo " history.back();\r\n";
			echo "</script>";
			exit;
		}
	}
}
add_filter('pre_comment_on_post', 'typenow_comment_captcha');
