<?php
/**
 * Template part for displaying archives by category.
 *
 * @package:    TypeNow
 * @since:      1.0
 * @version:    1.0
 */
?>
<?php
    global $cat;
    $cats = get_categories(array(
        'child_of' => $cat,
        'parent' => $cat,
        'hide_empty' => 0
    ));
    foreach($cats as $the_cat){
        $posts = get_posts(array(
            'category' => $the_cat->cat_ID,
            'numberposts' => -1,
        ));
        if( !empty( $posts ) ) {
            echo '<div class="archives-title"><a  href="'.get_category_link($the_cat).'">'.$the_cat->name.'</a></div><div class="post-list-container"><ul class="post-list-body">';

            foreach( $posts as $post ){
                echo '<li class="post-list-item"><a href="'.get_permalink($post->ID).'"><div class="item-label"><div class="item-title">'.$post->post_title.'</div><span class="item-date">'.typenow_get_svg(array('icon' => 'time')).date('M jS, Y', get_the_time('U')).'</span></div></a></li>';
            }

            echo '</ul></div>';
        }
    }
?>
