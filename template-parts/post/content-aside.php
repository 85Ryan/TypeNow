<?php
/**
 * Template part for displaying aside posts.
 *
 * @package:    TypeNow
 * @since:      1.0
 * @version:    1.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php
    if ( is_sticky() && is_home() ) :
        echo typenow_get_svg( array( 'icon' => 'sticky' ) );
    endif;
    ?>
    <header class="entry-header">
        <?php
		if ( is_single() ) {
			the_title( '<h1 class="entry-title">', '</h1>' );
		} else {
			the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
		};
        ?>
    </header><!-- .entry-header -->
    <div class="entry-content">
        <div class="aside-content-container">
            <?php if ( '' !== get_the_post_thumbnail() ) : ?>
                <div class="aside-header-image" style="background-image:url(<?php the_post_thumbnail_url( 'typenow-featured-image' ); ?>)">
            <?php else: ?>
                <div class="aside-header-image" style="background-image:url(<?php echo get_parent_theme_file_uri('/assets/images/aside.jpg'); ?>)">
            <?php endif; ?>
                <span class="aside-date"><?php echo date('d', get_the_time('U')); ?>
                <a href="<?php echo esc_url(get_permalink()); ?>" class="aside-month-year"><?php echo date('F / Y', get_the_time('U')); ?></a></span>
            </div><!-- .aside-header-image -->
            <div class="aside-content">
                <?php the_content(); ?>
            </div>
        </div><!-- .quote-content-container -->
        <div class="aside-footer-container">
            <div class="entry-meta">
                <span class="entry-format-text">
                <?php echo typenow_get_svg(array('icon' => 'aside-format')); ?>
                <a href="<?php echo esc_url( get_post_format_link( 'aside' ) ); ?>"><?php echo get_post_format_string( 'aside' ); ?></a></span>
                <?php
                    if ( ! is_single() ) {
                        typenow_edit_link();
                    };
                ?>
            </div><!-- .entry-meta -->
        </div><!-- .entry-footer-container -->
    </div><!-- .entry-content -->
</article>
