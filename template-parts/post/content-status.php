<?php
/**
 * Template part for displaying status posts.
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
        <div class="status-content-container">
            <div class="status-author">
            <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_avatar( get_the_author_meta( 'ID' ) ); ?></a>
            </div><!-- .status-author -->
            <div class="status-content">
            <?php the_content(); ?>
            </div><!-- .status-content -->
            <div class="entry-meta">
                <span class="entry-format-text">
                <?php echo typenow_get_svg(array('icon' => 'status-format')); ?>
                <a href="<?php echo esc_url( get_post_format_link( 'status' ) ); ?>"><?php echo get_post_format_string( 'status' ); ?></a></span>
                <?php
                    if ( is_single() ) {
                        echo typenow_get_svg(array('icon' => 'time'));
                        echo typenow_time_link();
                    } else {
                        echo typenow_get_svg(array('icon' => 'time'));
                        echo typenow_time_link();
                        typenow_edit_link();
                    };
                ?>
            </div><!-- .entry-meta -->
        </div><!-- .quote-content-container -->
    </div><!-- .entry-content -->
</article>
