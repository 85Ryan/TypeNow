<?php 
/**
 * Display top navigation.
 *
 * @package:    TypeNow
 * @since:      1.0
 * @version:    1.0
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
        'depth'     => 1,
    ) ); ?>
    
    <div class="nav-icon-container">
        <?php if( get_theme_mod( 'typenow_search_page', typenow_get_theme_default( 'typenow_search_page' ) ) != '' ) : ?>
            <div class="search-icon-container">
                <a class="menu-search-icon" href="<?php echo get_theme_mod( 'typenow_search_page', typenow_get_theme_default( 'typenow_search_page' ) ); ?>"><?php echo typenow_get_svg( array( 'icon' => 'search' ) ); ?><span class="screen-reader-text"><?php _e( 'Search', 'typenow' ); ?></span></a>
            </div><!-- .search-icon-container -->
        <?php endif; ?>

        <?php if ( ! is_user_logged_in() ) : ?>
            <div class="login-icon-container">
                <a class="menu-login-icon" href="<?php echo wp_login_url( home_url() ); ?>"><?php echo typenow_get_svg( array( 'icon' => 'login' ) ); ?><span class="screen-reader-text"><?php _e( 'Login', 'typenow' ); ?></span></a>
            </div><!-- .login-icon-container -->
        <?php endif; ?>

        <?php if ( ( typenow_is_frontpage() || ( is_home() && is_front_page() ) ) && has_custom_header() ) : ?>
            <div class="scroll-icon-container">
                <a href="#content" class="menu-scroll-down"><?php echo typenow_get_svg( array( 'icon' => 'arrow-right' ) ); ?><span class="screen-reader-text"><?php _e( 'Scroll Down to Content', 'typenow' ); ?></span></a>
            </div><!-- .scroll-icon-container -->
        <?php endif; ?>
    </div><!-- .nav-icon-container -->
</nav><!-- #site-navigation .main-navigation -->
