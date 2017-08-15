<?php
/**
 * TypeNow back compat functionality.
 */

/**
 * Prevent switching to TypeNow on old versions of WordPress.
 */
function typenow_switch_theme() {
    switch_theme( WP_DEFAULT_THEME );
    unset( $_GET['activated'] );
    add_action( 'admin_notices', 'typenow_upgrade_notice' );
}
add_action( 'after_switch_theme', 'typenow_switch_theme' );

/**
 * Adds a message for unsuccessful theme switch.
 */
function typenow_upgrade_notice() {
    $message = sprintf( __( 'TypeNow requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'typenow' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevents the Customizer from being loaded on WordPress versions prior to 4.7.
 */
function typenow_customize() {
    wp_die( sprintf( __( 'TypeNow requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'typenow' ), $GLOBALS['wp_version'] ), '', array(
		'back_link' => true,
	) );
}
add_action( 'load-customize.php', 'typenow_customize' );

/**
 * Prevents the Theme Preview from being loaded on WordPress versions prior to 4.7.
 */
function typenow_preview() {
    if ( isset( $_GET['preview'] ) ) {
        wp_die( sprintf( __( 'TypeNow requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'typenow' ), $GLOBALS['wp_version'] ) );
    }
}
add_action( 'template_redirect', 'typenow_preview' );