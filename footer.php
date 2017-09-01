<?php 
/**
 * The footer for TypeNow.
 */
?>
        </div><!-- #content .site-content -->
        <footer id="colophon" class="site-footer" role="contentinfo">
            <div class="wrap">
                <?php if ( has_nav_menu( 'social' ) ) : ?>
                    <nav class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Social Links Menu', 'typenow' ); ?>">
                        <?php 
                            wp_nav_menu( array(
                                'theme_location'    => 'social',
                                'menu-class'        => 'social-links-menu',
                                'depth'             => 1,
                                'link_before'       => '<span class="screen-reader-text">',
                                'link_after'        => '</span>' . typenow_get_svg( array( 'icon' => 'chain' ) ),
                            ) );
                        ?>
                    </nav><!-- .social-navigation -->
                <?php endif; 
                get_template_part( 'template-parts/footer/site', 'info' );
				?>
            </div><!-- .wrap -->
        </footer><!-- #colophon -->
    </div><!-- .site-content-contain -->
</div><!-- #page -->
<?php wp_footer(); ?>
<script src="https://cdn.bootcss.com/highlight.js/9.12.0/highlight.min.js"></script>
<script>hljs.initHighlightingOnLoad();</script>
</body>
</html>
