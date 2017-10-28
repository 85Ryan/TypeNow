<?php 
/**
 * Display header image.
 *
 * @package:    TypeNow
 * @since:      1.0
 * @version:    1.0
 */

?>
<div class="custom-header">
    <div class="custom-header-image">
        <?php if ( '' !== get_the_post_thumbnail() && ( is_single() || is_page() ) && !has_post_format( array('quote', 'aside', 'status') ) ) : ?>
            <?php the_post_thumbnail( 'typenow-featured-image' ); ?>
        <?php else : ?>
            <?php the_custom_header_markup(); ?>
        <?php endif; ?>
    </div><!-- .custom-header-media -->
    <div class="site-branding">
       <div class="wrap">
            <?php the_custom_logo(); ?>

            <div class="site-branding-text">
                <?php if ( is_front_page() ) : ?>
                    <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                <?php else : ?>
                    <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                <?php endif; ?>

                <?php 
                $description = get_bloginfo( 'description', 'display' ); 
                if ( $description || is_customize_preview() ) :
                ?>
                    <p class="site-description"><?php echo $description; ?></p>
                <?php endif; ?>
            </div><!-- .site-branding-text -->
            <?php if ( ( typenow_is_frontpage() || ( is_home() && is_front_page() ) ) && ! has_nav_menu( 'top' ) && has_custom_header() ) : ?>
                <div class="nav-icon-container">
                    <?php if( get_theme_mod( 'typenow_search_page', '' ) != '' ) : ?>
                        <div class="search-icon-container">
                            <a class="menu-search-icon" href="<?php echo get_theme_mod( 'typenow_search_page', '' ); ?>"><?php echo typenow_get_svg( array( 'icon' => 'search' ) ); ?><span class="screen-reader-text"><?php _e( 'Search', 'typenow' ); ?></span></a>
                        </div><!-- .search-icon-container -->
                    <?php endif; ?>

                    <?php if ( ! is_user_logged_in() ) : ?>
                        <div class="login-icon-container">
                            <a class="menu-login-icon" href="<?php echo wp_login_url( home_url() ); ?>"><?php echo typenow_get_svg( array( 'icon' => 'login' ) ); ?><span class="screen-reader-text"><?php _e( 'Login', 'typenow' ); ?></span></a>
                        </div><!-- .login-icon-container -->
                    <?php endif; ?>

                    <div class="scroll-icon-container">
                        <a href="#content" class="menu-scroll-down"><?php echo typenow_get_svg( array( 'icon' => 'arrow-right' ) ); ?><span class="screen-reader-text"><?php _e( 'Scroll Down to Content', 'typenow' ); ?></span></a>
                    </div><!-- .scroll-icon-container -->
            <?php endif; ?>
        </div><!-- .wrap -->
    </div><!-- .site-branding -->
</div><!-- .custom-header -->
