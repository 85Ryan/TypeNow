<?php
/**
 * Template part for displaying quote posts.
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
        <div class="quote-content-container">
            <?php if ( '' !== get_the_post_thumbnail() ) : ?>
                <div class="quote-header-image" style="background-image:url(<?php the_post_thumbnail_url( 'typenow-featured-image' ); ?>)"></div><!-- .quote-header-image -->
            <?php endif; ?>
            <div class="quote-content">
            <?php echo typenow_get_svg( array( 'icon' => 'quote-right' ) ); ?>
            <?php the_content(); ?>
            </div>
        </div><!-- .quote-content-container -->
        <div class="quote-footer-container">
            <div class="quote-author">
                    <?php if ( get_post_meta($post->ID, 'author_avatar', true) !== '' ) : ?>
                        <div class="author-avatar-container" style="background-image:url(<?php echo get_post_meta($post->ID, 'author_avatar', true); ?>)"></div>
                    <?php endif; ?>
                <p class="author-name"><?php echo get_post_meta( $post->ID , 'q_author' , true ); ?></p>
            </div>
            <div class="entry-meta">
                <span class="entry-format-text">
                <?php echo typenow_get_svg(array('icon' => 'quote-format')); ?>
                <a href="<?php echo esc_url( get_post_format_link( 'quote' ) ); ?>"><?php echo get_post_format_string( 'quote' ); ?></a></span>
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
        </div><!-- .entry-footer-container -->
    </div><!-- .entry-content -->
</article>
