<?php 
/**
 * Display top navigation.
 */
?>
<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'typenow' ); ?>">
    <button class="menu-toggle" aria-controls="top-menu" aria-expanded="false">
        <?php 
        echo typenow_get_svg( array( 'icon' => 'bars' ) );
        echo typenow_get_svg( array( 'icon' => 'close' ) );
        _e( 'Menu', 'typenow' );
        ?>
    </button>
    
    <?php wp_nav_menu( array(
        'theme_location' => 'top',
        'menu_id'   => 'top-menu',
    ) ); ?>
    
    <a class="menu-search-icon" href="<?php echo wp_login_url( home_url() ); ?>"><?php echo typenow_get_svg( array( 'icon' => 'search' ) ); ?><span class="screen-reader-text"><?php _e( 'Search', 'typenow' ); ?></span></a>

    <?php if ( is_user_logged_in() ) : ?>
        <a class="menu-login-icon" href="<?php echo wp_login_url( home_url() ); ?>"><?php echo typenow_get_svg( array( 'icon' => 'login' ) ); ?><span class="screen-reader-text"><?php _e( 'Login', 'typenow' ); ?></span></a>
    <?php endif; ?>

    <?php if ( ( typenow_is_frontpage() || ( is_home() && is_front_page() ) ) && has_custom_header() ) : ?>
        <a href="#content" class="menu-scroll-down"><?php echo typenow_get_svg( array( 'icon' => 'arrow-right' ) ); ?><span class="screen-reader-text"><?php _e( 'Scroll Down to Content', 'typenow' ); ?></span></a>
    <?php endif; ?>
</nav><!-- #site-navigation .main-navigation -->
