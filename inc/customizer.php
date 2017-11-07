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

    // Refresh header text.
    $wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector' => '.site-title a',
		'render_callback' => function (){
            bloginfo ( 'name' );
        },
	) );
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector' => '.site-description',
		'render_callback' => function (){
            bloginfo ( 'description' );
        },
	) );

    // Refresh header image.
	$wp_customize->selective_refresh->add_partial( 'header_image', array(
		'selector' => '.wp-custom-header',
		'render_callback' => 'the_custom_header_markup',
	) );

	$wp_customize->selective_refresh->add_partial( 'header_image_data', array(
		'selector' => '.wp-custom-header',
		'render_callback' => 'the_custom_header_markup',
	) );

    // Display  Bloginfo.
	$wp_customize->add_setting('typenow_display_title', array(
        'capability' => 'edit_theme_options',
        'theme-supports' => array('custom-logo', 'header-text'),
        'default' => typenow_get_theme_default( 'typenow_display_title' ),
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
        'theme-supports' => array('custom-logo', 'header-text'),
        'default' => typenow_get_theme_default( 'typenow_display_tagline' ),
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control('typenow_display_tagline', array(
        'settings' => 'typenow_display_tagline',
        'label'    => __('Display Site Tagline', 'typenow'),
        'section'  => 'title_tagline',
        'type'     => 'checkbox',
    ));

    // Set the site owner.
    $wp_customize->add_setting('typenow_site_owner', array(
        'capability' => 'edit_theme_options',
        'default' => typenow_get_theme_default( 'typenow_site_owner' ),
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control('typenow_site_owner', array(
        'settings'      => 'typenow_site_owner',
        'label'         => __('Site Owner', 'typenow'),
        'section'       => 'title_tagline',
        'type'          => 'text',
        'description'   =>  __('This only used for the copyright info in the site footer, if blank display the site title.', 'typenow'),
        'priority'      => 180,
    ));

	$wp_customize->selective_refresh->add_partial( 'typenow_site_owner', array(
		'selector' => '.site-copyright a',
        'settings' => 'typenow_site_owner',
        'render_callback' => function () {
            return get_theme_mod( 'typenow_site_owner', typenow_get_theme_default( 'typenow_site_owner' ) );
        },
	) );

    // Set the site ICP.
    $wp_customize->add_setting('typenow_site_icp', array(
        'capability' => 'edit_theme_options',
        'default' => typenow_get_theme_default( 'typenow_site_icp' ),
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control('typenow_site_icp', array(
        'settings'      => 'typenow_site_icp',
        'label'         => __('Site ICP', 'typenow'),
        'section'       => 'title_tagline',
        'type'          => 'text',
        'description'   =>  __('This only used for the copyright info in the site footer, if blank display none.', 'typenow'),
        'priority'      => 200,
    ));

	$wp_customize->selective_refresh->add_partial( 'typenow_site_icp', array(
		'selector' => '.site-icp a',
        'settings' => 'typenow_site_icp',
        'render_callback' => function () {
            return get_theme_mod( 'typenow_site_icp', typenow_get_theme_default( 'typenow_site_icp' ) );
        },
	) );

    // Theme Options.
    $wp_customize->add_section('typenow_theme_options', array(
        'title'         => __('Theme Options', 'typenow'),
        'priority'      => 110,
    ));

    // Search page
    $wp_customize->add_setting('typenow_search_page', array(
        'capability' => 'edit_theme_options',
        'default' => typenow_get_theme_default( 'typenow_search_page' ),
    ));

    $wp_customize->add_control('typenow_search_page', array(
        'settings'      => 'typenow_search_page',
        'label'         => __('Search Page URL', 'typenow'),
        'section'       => 'typenow_theme_options',
        'type'          => 'url',
        'description'   =>  __('Before set this, you should add a new page use the page template of TypeNow Search.If blank, display none.', 'typenow'),
        'priority'      => 10,
    ));

    // Site Map
    $wp_customize->add_setting('typenow_site_map', array(
        'capability' => 'edit_theme_options',
        'default' => typenow_get_theme_default( 'typenow_site_map' ),
    ));

    $wp_customize->add_control('typenow_site_map', array(
        'settings'      => 'typenow_site_map',
        'label'         => __('Site Map URL', 'typenow'),
        'section'       => 'typenow_theme_options',
        'type'          => 'url',
        'description'   =>  __('If blank, display none.', 'typenow'),
        'priority'      => 20,
    ));

    // Related Post.
    $wp_customize->add_setting('typenow_related_post', array(
        'capability' => 'edit_theme_options',
        'default' => typenow_get_theme_default( 'typenow_related_post' ),
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control('typenow_related_post', array(
        'settings'      => 'typenow_related_post',
        'label'         => __('Display Related Posts', 'typenow'),
        'section'       => 'typenow_theme_options',
        'type'          => 'checkbox',
        'priority'      => 30,
    ));

	$wp_customize->selective_refresh->add_partial( 'typenow_related_post', array(
        'settings' => 'typenow_related_post',
        'render_callback' => function () {
            return get_theme_mod( 'typenow_related_post', typenow_get_theme_default( 'typenow_related_post' ) );
        },
	) );

    $wp_customize->add_setting('typenow_related_post_num', array(
        'capability' => 'edit_theme_options',
        'default' => typenow_get_theme_default( 'typenow_related_post_num' ),
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control('typenow_related_post_num', array(
        'settings'      => 'typenow_related_post_num',
        'label'         => __('Related Posts Number', 'typenow'),
        'section'       => 'typenow_theme_options',
        'type'          => 'radio',
        'priority'      => 35,
        'choices'       => array (
                            '2'  => __('Two posts', 'typenow'),
                            '4' => __('Four posts', 'typenow'),
                            ),
        'active_callback' =>  function () {
            return get_theme_mod( 'typenow_related_post', typenow_get_theme_default( 'typenow_related_post' ) );
        },
    ));

	$wp_customize->selective_refresh->add_partial( 'typenow_related_post_num', array(
        'settings' => 'typenow_related_post_num',
        'render_callback' => function () {
            return get_theme_mod( 'typenow_related_post_num', typenow_get_theme_default( 'typenow_related_post_num' ) );
        },
	) );

    // Post dir.
    $wp_customize->add_setting('typenow_post_dir', array(
        'capability' => 'edit_theme_options',
        'default' => typenow_get_theme_default( 'typenow_post_dir' ),
    ));

    $wp_customize->add_control('typenow_post_dir', array(
        'settings'      => 'typenow_post_dir',
        'label'         => __('Display Post Directory', 'typenow'),
        'section'       => 'typenow_theme_options',
        'type'          => 'checkbox',
        'priority'      => 40,
    ));

    // Code High Light.
    $wp_customize->add_setting('typenow_high_light', array(
        'capability' => 'edit_theme_options',
        'default' => typenow_get_theme_default( 'typenow_high_light' ),
    ));

    $wp_customize->add_control('typenow_high_light', array(
        'settings'      => 'typenow_high_light',
        'label'         => __('Enable High Light', 'typenow'),
        'section'       => 'typenow_theme_options',
        'type'          => 'checkbox',
        'priority'      => 50,
    ));

    // Comment Captcha.
    $wp_customize->add_setting('typenow_comment_captcha', array(
        'capability' => 'edit_theme_options',
        'default' => typenow_get_theme_default( 'typenow_comment_captcha' ),
    ));

    $wp_customize->add_control('typenow_comment_captcha', array(
        'settings'      => 'typenow_comment_captcha',
        'label'         => __('Enable Comment Captcha', 'typenow'),
        'section'       => 'typenow_theme_options',
        'type'          => 'checkbox',
        'priority'      => 60,
    ));

    // Enable Markdown.
    $wp_customize->add_setting('typenow_comment_markdown', array(
        'capability' => 'edit_theme_options',
        'default' => typenow_get_theme_default( 'typenow_comment_markdown' ),
    ));

    $wp_customize->add_control('typenow_comment_markdown', array(
        'settings'      => 'typenow_comment_markdown',
        'label'         => __('Enable Comment Markdown', 'typenow'),
        'section'       => 'typenow_theme_options',
        'type'          => 'checkbox',
        'description'   =>  __('This is a test function.', 'typenow'),
        'priority'      => 70,
    ));

    // Copyright Notice.
    $wp_customize->add_setting('typenow_copy_notice', array(
        'capability' => 'edit_theme_options',
        'transport' => 'postMessage',
        'default' => typenow_get_theme_default( 'typenow_copy_notice' ),
    ));

    $wp_customize->add_control('typenow_copy_notice', array(
        'settings'      => 'typenow_copy_notice',
        'label'         => __('Copyright Notice', 'typenow'),
        'section'       => 'typenow_theme_options',
        'type'          => 'textarea',
        'description'   =>  __('Set the Copyright Notice in the site footer.', 'typenow'),
        'priority'      => 70,
    ));

	$wp_customize->selective_refresh->add_partial( 'typenow_copy_notice', array(
		'selector' => '.site-copy-notice',
        'settings' => 'typenow_copy_notice',
        'render_callback' => function () {
            return get_theme_mod( 'typenow_copy_notice', typenow_get_theme_default( 'typenow_copy_notice' ) );
        },
	) );

    // AD Slots.
    $wp_customize->add_section('typenow_ad_slots', array(
        'title'         => __('AD Slots', 'typenow'),
        'priority'      => 115,
    ));

    // Home AD.
    $wp_customize->add_setting('typenow_home_ad', array(
        'capability' => 'edit_theme_options',
        'default' => typenow_get_theme_default( 'typenow_home_ad' ),
    ));

    $wp_customize->add_control('typenow_home_ad', array(
        'settings'      => 'typenow_home_ad',
        'label'         => __('Home Page AD', 'typenow'),
        'section'       => 'typenow_ad_slots',
        'type'          => 'textarea',
        'description'   =>  __('This AD slot will appear behind the first two posts per page.', 'typenow'),
        'priority'      => 10,
    ));

    // Single page AD.
    $wp_customize->add_setting('typenow_single_ad', array(
        'capability' => 'edit_theme_options',
        'default' => typenow_get_theme_default( 'typenow_single_ad' ),
    ));

    $wp_customize->add_control('typenow_single_ad', array(
        'settings'      => 'typenow_single_ad',
        'label'         => __('Single Page AD', 'typenow'),
        'section'       => 'typenow_ad_slots',
        'type'          => 'textarea',
        'description'   =>  __('This AD slot will appear behind the post content.', 'typenow'),
        'priority'      => 20,
    ));

    // Donate.
    $wp_customize->add_section('typenow_donate', array(
        'title'         => __('Buy Me a Cup of Coffee', 'typenow'),
        'priority'      => 200,
        'description'   => __('<p>Thanks for stopping by!</P><p>If you like what I do and are so inclined, you can help keep this theme (and me!) going by making a contribution to <a href="https://github.com/85Ryan/TypeNow">GitHub</a>.</p><p>Simply scan the QR-Code below to donate me through AliPay or WechatPay.</p><p><img src="https://iiiryan.com/wp-content/uploads/2017/10/donate-pay.png" /></p><p>And you can also donate me by clicking the button below through PayPal.</p><p><a href="https://paypal.me/iiiryan"><img src="http://bocachurch.org/wp-content/uploads/2016/01/donate-paypal-1x.png"></a></p><p>Thank you in advance for your kindness.</p><p>@ <a href="https://iiiryan.com">Ryan</a></P>', 'typenow'),
    ));

    // Donate hidden.
    $wp_customize->add_setting('typenow_donate_hidden', array(
        'capability' => 'edit_theme_options',
    ));

    $wp_customize->add_control('typenow_donate_hidden', array(
        'settings'      => 'typenow_donate_hidden',
        'section'       => 'typenow_donate',
        'type'          => 'hidden',
    ));
}
add_action( 'customize_register', 'typenow_customize_register' );

/**
 * Set Options default value.
 */
function typenow_get_theme_default( $setting ) {
    $defaults = array (
        'typenow_display_title'         =>  true,
        'typenow_display_tagline'       =>  true,
        'typenow_site_owner'            =>  '',
        'typenow_site_icp'              =>  '',
        'typenow_search_page'           =>  '',
        'typenow_site_map'              =>  '',
        'typenow_related_post'          =>  false,
        'typenow_related_post_num'      =>  '2',
        'typenow_post_dir'              =>  false,
        'typenow_high_light'            =>  false,
        'typenow_comment_captcha'       =>  false,
        'typenow_comment_markdown'      =>  false,
        'typenow_copy_notice'           =>  '',
        'typenow_home_ad'               =>  '',
        'typenow_single_ad'             =>  '',

    );

    return $defaults[$setting];
}

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
 * Bind JS handlers to instantly live-preview changes.
 */
function typenow_customize_preview_js() {
	wp_enqueue_script( 'typenow-customize-preview', get_theme_file_uri( '/assets/js/customize-preview.js' ), array( 'customize-preview' ), '1.0', true );
}
add_action( 'customize_preview_init', 'typenow_customize_preview_js' );
