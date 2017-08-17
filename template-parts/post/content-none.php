<?php 
/**
 * Template part for displaying a message that posts cannot be found.
 */
?>
<section class="no-results not-found">
    <header class="page-header">
        <h1 class="page-title"><?php _e( 'Nothing Found', 'typenow' ); ?></h1>
    </header>
    <div class="page-content">
        <?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
            <p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'typenow' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>
        <?php else : ?>
            <p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'typenow' ); ?></p>
            <?php get_search_form(); 
        endif; ?>
    </div><!-- .page-content -->
</section><!-- .no-results -->