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
    
    <?php if ( ( typenow_is_frontpage() || ( is_home() && is_front_page() ) ) && has_custom_header() ) : ?>
        <a href="#content" class="menu-scroll-down"><?php echo typenow_get_svg( array( 'icon' => 'arrow-right' ) ); ?><span class="screen-reader-text"><?php _e( 'Scroll Down to Content', 'typenow' ); ?></span></a>
    <?php endif; ?>
</nav><!-- #site-navigation .main-navigation -->