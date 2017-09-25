<?php
/**
 * TypeNow Customizer.
 *
 * @package:    TypeNow
 * @since:      1.0
 * @version:    1.0
 */

// Add postMessage support for site title and description for the Theme Customizer.
function typenow_customize_register( $wp_customize ) {

    $wp_customize->get_setting( 'blogname' )->transport          = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport   = 'postMessage';
    $wp_customize->get_setting( 'header_image'  )->transport = 'postMessage';
    $wp_customize->get_setting( 'header_image_data'  )->transport = 'postMessage';

    $wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector' => '.site-title a',
		'render_callback' => 'typenow_customize_partial_blogname',
	) );
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector' => '.site-description',
		'render_callback' => 'typenow_customize_partial_blogdescription',
	) );

    // Display  Bloginfo.
	$wp_customize->add_setting('typenow_display_title', array(
        'capability' => 'edit_theme_options',
        'theme-supports' => array( 'custom-logo', 'header-text' ),
        'default' => 1,
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control('typenow_display_title', array(
        'settings' => 'typenow_display_title',
        'label'    => __('Display Site Title', 'typenow'),
        'section'  => 'title_tagline',
        'type'     => 'checkbox',
    ));

    $wp_customize->add_setting('typenow_display_tagline', array(
        'capability' => 'edit_theme_options',
        'theme-supports' => array( 'custom-logo', 'header-text' ),
        'default' => 1,
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control('typenow_display_tagline', array(
        'settings' => 'typenow_display_tagline',
        'label'    => __('Display Site Tagline', 'typenow'),
        'section'  => 'title_tagline',
        'type'     => 'checkbox',
    ));
}
add_action( 'customize_register', 'typenow_customize_register' );

/**
 * Add meta box on new post page.
 */
// Fields Array
$metaboxes = array (
    'quote_options' => array (
        'title' => __('Quote Options', 'typenow'),
        'screen' => 'post',
        'context' => 'side',
        'display_condition' => 'post-format-quote',
        'priority' => 'high',
        'fields' => array (
            'q_author' => array (
                'title' => __('Quote Author:', 'typenow'),
                'type' => 'text',
                'description' => __('Please enter the author name. ', 'typenow'),
                'size' => 28,
            ),
            'author_avatar' => array (
                'title' => __('Author Avatar:', 'typenow'),
                'type' => 'text',
                'description' => __('Please enter a image URL for author avatar.', 'typenow'),
                'size' => 28,
            )
        )
    ),
);

function typenow_post_format_sidebox() {
    global $metaboxes;
    if ( ! empty( $metaboxes ) ) {
        foreach ( $metaboxes as $id => $metabox ) {
            add_meta_box( $id, $metabox['title'], 'typenow_sidebox_callback', $metabox['screen'], $metabox['context'], $metabox['priority'], $id );
        }
    }
}
add_action( 'add_meta_boxes', 'typenow_post_format_sidebox' );

function typenow_sidebox_callback( $post, $args ) {
    global $metaboxes;
    $fields = $tabs = $metaboxes[$args['id']]['fields'];
    $output = '<input type="hidden" name="typenow_post_format_sidebox_nonce" value="' . wp_create_nonce( basename( __FILE__ ) ) . '" />';
        foreach ( $fields as $id => $field ) {
        $value = get_post_meta($post->ID, $id, true);
            switch ( $field['type'] ) {
                default:
                case "text":
                    $output .= '<label for="' . $id . '">' . $field['title'] . '</label><input id="' . $id . '" type="text" name="' . $id . '" value="' . $value . '" size="' . $field['size'] . '" /><br /><p class="description">'.$field['description'].'</p>';
            break;
            }
        }
    echo $output;
}

function typenow_save_sidebox_data( $post_id ) {
    global $metaboxes;
    if ( ! isset( $_POST['typenow_post_format_sidebox_nonce'] ) ) {
		return;
	}
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return $post_id;
    if ( 'page' == $_POST['post_type'] ) {
        if ( ! current_user_can( 'edit_page', $post_id ) )
            return $post_id;
    } elseif ( ! current_user_can( 'edit_post', $post_id ) ) {
        return $post_id;
    }

    $post_type = get_post_type();
    foreach ( $metaboxes as $id => $metabox ) {
        if ( $metabox['screen'] == $post_type ) {
            $fields = $metaboxes[$id]['fields'];
            foreach ( $fields as $id => $field ) {
                $old = get_post_meta( $post_id, $id, true );
                $new = $_POST[$id];
                if ( $new && $new != $old ) {
                    update_post_meta( $post_id, $id, $new );
                }
                elseif ( '' == $new && $old || ! isset( $_POST[$id] ) ) {
                    delete_post_meta( $post_id, $id, $old );
                }
            }
        }
    }
}
add_action( 'save_post', 'typenow_save_sidebox_data' );

function typenow_display_sideboxes() {
    global $metaboxes;
    if ( get_post_type() == "post" ) :
        ?>
        <script type="text/javascript">// <![CDATA[
            $ = jQuery;
            <?php
            $formats = $ids = array();
            foreach ( $metaboxes as $id => $metabox ) {
                array_push( $formats, "'" . $metabox['display_condition'] . "': '" . $id . "'" );
                array_push( $ids, "#" . $id );
            }
            ?>
            var formats = { <?php echo implode( ',', $formats );?> };
            var ids = "<?php echo implode( ',', $ids ); ?>";

            function displayMetaboxes() {
                $(ids).hide();
                var selectedElt = $("input[name='post_format']:checked").attr("id");
                if ( formats[selectedElt] )
                    $("#" + formats[selectedElt]).fadeIn();
            }
            $(function() {
                displayMetaboxes();
                $("input[name='post_format']").change(function() {
                    displayMetaboxes();
                });
            });
        // ]]></script>
        <?php
    endif;
}
add_action( 'admin_print_scripts', 'typenow_display_sideboxes', 1000 );

/**
 * Render the site title for the selective refresh partial.
 */
function typenow_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 */
function typenow_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Bind JS handlers to instantly live-preview changes.
 */
function typenow_customize_preview_js() {
	wp_enqueue_script( 'typenow-customize-preview', get_theme_file_uri( '/assets/js/customize-preview.js' ), array( 'customize-preview' ), '1.0', true );
}
add_action( 'customize_preview_init', 'typenow_customize_preview_js' );
