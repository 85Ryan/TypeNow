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