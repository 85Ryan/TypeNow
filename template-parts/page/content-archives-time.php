<?php
/**
 * Template part for displaying archives by timeline.
 *
 * @package:    TypeNow
 * @since:      1.0
 * @version:    1.0
 */
?>
<?php

    $ref_month = '';
    $monthly = new WP_Query(array(
        'posts_per_page' => -1,
        'ignore_sticky_posts' => true
    ));
    if( $monthly->have_posts() ) :
        while( $monthly->have_posts() ) : $monthly->the_post();

    if( get_the_date('mY') != $ref_month ) {
        $archive_year  = get_the_time('Y');
        $archive_month = get_the_time('m');
        if( $ref_month ) echo '</ul></div>';
        echo '<div class="archives-title"><a href="'.get_month_link( $archive_year, $archive_month ).'">'.date('F Y',get_the_time('U')).'</a></div>';
        echo '<div class="post-list-container"><ul class="post-list-body">';
        $ref_month = get_the_date('mY');
        $counter = 0;
    }

    echo '<li class="post-list-item"><a href='.get_permalink($post->ID).'><div class="item-label"><div class="item-title">'.get_the_title($post->ID).'</div><span class="item-date">'.typenow_get_svg(array('icon' => 'time')).date('M jS, Y', get_the_time('U')).'</span></div></a></li>';

    endwhile;
    echo '</ul></div>';
    endif;
?>
