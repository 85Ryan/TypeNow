<?php 
/**
 * Displays footer site info.
 *
 * @package:    Typenow
 * @since:      1.0
 * @version:    1.0
 */
?>

<div class="site-info">

    <span class="site-copyright">
       <?php typenow_copyright(); ?>
    </span><!-- .site-copyright -->
    <?php if ( get_theme_mod('typenow_site_icp', typenow_get_theme_default( 'typenow_site_icp' )) != '' ) : ?>
        <span class="site-icp">
            <a href="<?php echo esc_url( __( 'http://www.miibeian.gov.cn/', 'typenow' ) ); ?>"><?php echo get_theme_mod('typenow_site_icp', typenow_get_theme_default( 'typenow_site_icp' )); ?></a>
        </span><!-- .site-icp -->
    <?php endif; ?>

    <?php if ( get_theme_mod('typenow_site_map', typenow_get_theme_default( 'typenow_site_map' )) != '' ) : ?>
        <span class="site-map">
            <a href="<?php echo get_theme_mod('typenow_site_map', typenow_get_theme_default( 'typenow_site_map' )); ?>"><?php printf( __( 'Site Map', 'typenow' ) ); ?></a>
        </span><!-- .site-map -->
    <?php endif; ?>

    <span class="site-theme">
        <?php
            $urltheme = 'https://github.com/85Ryan/TypeNow';
            $urlauthor = 'https://iiiryan.com';
            $sitetheme = sprintf( wp_kses( __( 'Theme is <a href=%1$s>TypeNow</a> by <a href=%2$s>Ryan</a>', 'typenow' ), array(  'a' => array( 'href' => array() ) ) ), esc_url( $urltheme ), esc_url( $urlauthor ) );
            echo $sitetheme;
        ?>
    </span><!-- .site-theme -->

    <span class="site-power">
        <?php
            $url = 'https://wordpress.org';
            $sitepower = sprintf( wp_kses( __( 'Powerd by <a href=%s>WordPress</a>', 'typenow' ), array(  'a' => array( 'href' => array() ) ) ), esc_url( $url ) );
            echo $sitepower;
        ?>
    </span><!-- .site-power -->

     <?php if ( get_theme_mod('typenow_copy_notice', typenow_get_theme_default( 'typenow_copy_notice' )) != '' ) : ?>
        <p class="site-copy-notice">
            <?php echo get_theme_mod('typenow_copy_notice', typenow_get_theme_default( 'typenow_copy_notice' )); ?>
        </p><!-- .site-copy-notice -->
    <?php endif; ?>

</div><!-- .site-info -->
