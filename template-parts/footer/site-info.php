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

    <span class="site-icp">
        <a href="<?php echo esc_url( __( 'http://www.miibeian.gov.cn/', 'typenow' ) ); ?>"><?php printf( __( 'ICP 12345678', 'typenow' ) ); ?></a>
    </span><!-- .site-icp -->

    <span class="site-map">
        <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'typenow' ) ); ?>"><?php printf( __( 'Site Map', 'typenow' ) ); ?></a>
    </span><!-- .site-map -->

    <span class="site-theme">
        <?php
            $urltheme = 'https://github.com/85Ryan/TypeNow';
            $urlauthor = 'https://iiiryan.com';
            $sitetheme = sprintf( wp_kses( __( 'Theme is <a href="%1$s">TypeNow</a> by <a href="%2$s">Ryan</a>', 'typenow' ), array(  'a' => array( 'href' => array() ) ) ), esc_url( $urltheme ), esc_url( $urlauthor ) );
            echo $sitetheme;
        ?>
    </span><!-- .site-theme -->

    <span class="site-power">
        <?php
            $url = 'https://wordpress.org';
            $sitepower = sprintf( wp_kses( __( 'Powerd by <a href="%s">WordPress</a>', 'typenow' ), array(  'a' => array( 'href' => array() ) ) ), esc_url( $url ) );
            echo $sitepower;
        ?>
    </span><!-- .site-power -->

</div><!-- .site-info -->
