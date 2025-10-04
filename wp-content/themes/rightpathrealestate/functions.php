<?php
// Enqueue styles and scripts
function rightpath_enqueue_assets() {
    // Styles
    $styles = [
        'bootstrap' => '/assets/css/bootstrap.min.css',
        'magnific-popup' => '/assets/css/magnific-popup.css',
        'selectbox' => '/assets/css/jquery.selectBox.css',
        'dropzone' => '/assets/css/dropzone.css',
        'rangeslider' => '/assets/css/rangeslider.css',
        'animate' => '/assets/css/animate.min.css',
        'leaflet' => '/assets/css/leaflet.css',
        'slick' => '/assets/css/slick.css',
        'slick-theme' => '/assets/css/slick-theme.css',
        'mcustomscrollbar' => '/assets/css/jquery.mCustomScrollbar.css',
        'fontawesome' => '/assets/fonts/font-awesome/css/font-awesome.min.css',
        'flaticon' => '/assets/fonts/flaticon/font/flaticon.css',
        'rightpath-style' => '/assets/css/style.css',
        'rightpath-stylecss' => '/style.css',
        'skin-default' => '/assets/css/skins/default.css'
    ];

    foreach($styles as $handle => $path){
        wp_enqueue_style($handle, get_template_directory_uri() . $path, [], filemtime(get_template_directory() . $path));
    }

    // jQuery
    wp_enqueue_script('jquery');

    // JS Libraries
    $js_libs = [
        'popper' => 'assets/js/popper.min.js',
        'bootstrap' => 'assets/js/bootstrap.min.js',
        'selectbox' => 'assets/js/jquery.selectBox.js',
        'magnific-popup' => 'assets/js/jquery.magnific-popup.min.js',
        'filterizr' => 'assets/js/jquery.filterizr.js',
        'wow' => 'assets/js/wow.min.js',
        'backstretch' => 'assets/js/backstretch.js',
        'countdown' => 'assets/js/jquery.countdown.js',
        'scrollup' => 'assets/js/jquery.scrollUp.js',
        'particles' => 'assets/js/particles.min.js',
        'typed' => 'assets/js/typed.min.js',
        'dropzone' => 'assets/js/dropzone.js',
        'leaflet' => 'assets/js/leaflet.js',
        'leaflet-providers' => 'assets/js/leaflet-providers.js',
        'leaflet-cluster' => 'assets/js/leaflet.markercluster.js',
        'slick' => 'assets/js/slick.min.js',
        'mcustomscrollbar' => 'assets/js/jquery.mCustomScrollbar.concat.min.js',
        'app' => 'assets/js/app.js'
    ];

    foreach($js_libs as $handle => $path){
        wp_enqueue_script($handle, get_template_directory_uri() . '/' . $path, ['jquery'], filemtime(get_template_directory() . '/' . $path), true);
    }

    // Pass theme URL to JS
    wp_localize_script('app', 'themeVars', ['themeUrl' => get_template_directory_uri()]);
}
add_action('wp_enqueue_scripts', 'rightpath_enqueue_assets');


// Theme setup: menus, thumbnails, title tag
function rightpath_theme_setup() {
    // Menus
    register_nav_menus([
        'primary_menu' => __('Primary Menu', 'rightpathrealestate'),
    ]);

    // Thumbnails
    add_theme_support('post-thumbnails');

    // Title tag
    add_theme_support('title-tag');
}
add_action('after_setup_theme', 'rightpath_theme_setup');


// Menu classes for bootstrap
function rightpath_add_menu_classes($classes, $item, $args, $depth = 0) {
    if ($args->theme_location === 'primary_menu') {
        $classes[] = 'nav-item';
        if (in_array('current-menu-item', $item->classes) || in_array('current-menu-parent', $item->classes) || in_array('current-menu-ancestor', $item->classes)) {
            $classes[] = 'active';
        }
        if ($item->title === 'Contact Us') $classes[] = 'sb2';
        if (in_array('menu-item-has-children', $item->classes)) $classes[] = 'dropdown';
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'rightpath_add_menu_classes', 10, 4);

function rightpath_add_link_attributes($atts, $item, $args, $depth = 0) {
    if ($args->theme_location === 'primary_menu') {
        $atts['class'] = ($item->title === 'Contact Us') ? 'submit-btn' : 'nav-link';
        if (in_array('menu-item-has-children', $item->classes)) {
            $atts['class'] .= ' dropdown-toggle';
            $atts['data-toggle'] = 'dropdown';
            $atts['aria-haspopup'] = 'true';
            $atts['aria-expanded'] = 'false';
            $atts['id'] = 'navbarDropdownMenuLink-' . $item->ID;
        }
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'rightpath_add_link_attributes', 10, 4);


// Include Bootstrap Navwalker
require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';


// Property CPT
function create_property_cpt() {
    $labels = [
        'name' => __( 'Properties', 'textdomain' ),
        'singular_name' => __( 'Property', 'textdomain' ),
        'add_new' => __( 'Add Property', 'textdomain' ),
        'add_new_item' => __( 'Add New Property', 'textdomain' ),
        'edit_item' => __( 'Edit Property', 'textdomain' ),
        'view_item' => __( 'View Property', 'textdomain' ),
    ];

    $args = [
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'supports' => ['title','editor','thumbnail'],
        'menu_icon' => 'dashicons-admin-home',
        'rewrite' => ['slug' => 'properties'],
        'show_in_rest' => true,
    ];

    register_post_type('property', $args);
}
add_action('init', 'create_property_cpt');


// Agent CPT
function create_agent_cpt() {
    $labels = [
        'name' => __( 'Agents', 'textdomain' ),
        'singular_name' => __( 'Agent', 'textdomain' ),
        'add_new' => __( 'Add Agent', 'textdomain' ),
        'add_new_item' => __( 'Add New Agent', 'textdomain' ),
        'edit_item' => __( 'Edit Agent', 'textdomain' ),
        'view_item' => __( 'View Agent', 'textdomain' ),
    ];

    $args = [
        'labels' => $labels,
        'public' => true,
        'has_archive' => false,
        'supports' => ['title','editor','thumbnail'],
        'menu_icon' => 'dashicons-businessperson',
        'show_in_rest' => true,
    ];

    register_post_type('agent', $args);
}
add_action('init', 'create_agent_cpt');


// Property Type Taxonomy
function create_property_type_taxonomy() {
    register_taxonomy('property_type', 'property', [
        'labels' => [
            'name' => 'Property Types',
            'singular_name' => 'Property Type',
            'menu_name' => 'Property Types',
        ],
        'public' => true,
        'hierarchical' => true,
        'rewrite' => ['slug' => 'property-type'],
        'show_in_rest' => true,
    ]);
}
add_action('init', 'create_property_type_taxonomy');


// Unified AJAX Load More Properties
function rightpath_load_more_properties() {
    $paged   = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $status  = sanitize_text_field($_POST['status'] ?? '');      // For status pages
    $filter  = sanitize_text_field($_POST['filter'] ?? 'all');   // Taxonomy filter
    $featured = isset($_POST['featured']) ? intval($_POST['featured']) : 0; // Featured only

    $args = [
        'post_type'      => 'property',
        'posts_per_page' => 6,
        'paged'          => $paged,
        'meta_query'     => [],
    ];

    // Filter by status if set
    if ($status) {
        $args['meta_query'][] = [
            'key'     => 'status',
            'value'   => $status,
            'compare' => '='
        ];
    }

    // Filter featured if set
    if ($featured) {
        $args['meta_query'][] = [
            'key'     => 'featured_property',
            'value'   => 1,
            'compare' => '='
        ];
    }

    // Filter by taxonomy if set
    if ($filter !== 'all') {
        $args['tax_query'] = [
            [
                'taxonomy' => 'property_type',
                'field'    => 'slug',
                'terms'    => $filter,
            ]
        ];
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()): $query->the_post();
            get_template_part('template-parts/content', 'property');
        endwhile;
    } else {
        echo 'no_more';
    }

    wp_die();
}
add_action('wp_ajax_load_more_properties', 'rightpath_load_more_properties');
add_action('wp_ajax_nopriv_load_more_properties', 'rightpath_load_more_properties');


// Register Services CPT
function rightpath_register_services_cpt() {
    $labels = [
        'name' => __('Services', 'rightpathrealestate'),
        'singular_name' => __('Service', 'rightpathrealestate'),
        'menu_name' => __('Services', 'rightpathrealestate'),
        'name_admin_bar' => __('Service', 'rightpathrealestate'),
        'add_new' => __('Add New', 'rightpathrealestate'),
        'add_new_item' => __('Add New Service', 'rightpathrealestate'),
        'edit_item' => __('Edit Service', 'rightpathrealestate'),
        'new_item' => __('New Service', 'rightpathrealestate'),
        'view_item' => __('View Service', 'rightpathrealestate'),
        'search_items' => __('Search Services', 'rightpathrealestate'),
        'not_found' => __('No services found', 'rightpathrealestate'),
        'not_found_in_trash' => __('No services found in Trash', 'rightpathrealestate'),
        'all_items' => __('All Services', 'rightpathrealestate'),
    ];

    $args = [
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-hammer',
        'has_archive' => false,
        'hierarchical' => false,
        'supports' => ['title','editor','thumbnail','revisions'],
        'show_in_rest' => true,
        'rewrite' => ['slug' => 'services'], // optional nice URL
    ];

    register_post_type('service', $args);
}
add_action('init', 'rightpath_register_services_cpt');

function rightpath_register_testimonial_cpt() {
    $labels = [
        'name' => 'Testimonials',
        'singular_name' => 'Testimonial',
        'menu_name' => 'Testimonials',
        'add_new' => 'Add Testimonial',
        'add_new_item' => 'Add New Testimonial',
        'edit_item' => 'Edit Testimonial',
        'all_items' => 'All Testimonials',
        'view_item' => 'View Testimonial',
        'search_items' => 'Search Testimonials',
        'not_found' => 'No testimonials found',
        'not_found_in_trash' => 'No testimonials found in trash',
    ];

    $args = [
        'labels' => $labels,
        'public' => true,
        'has_archive' => false,
        'show_in_menu' => true,
        'supports' => ['title', 'editor', 'thumbnail'],
        'menu_icon' => 'dashicons-format-quote',
    ];

    register_post_type('testimonial', $args);
}
add_action('init', 'rightpath_register_testimonial_cpt');




function rightpath_enable_post_tags() {
    // Attach the built-in 'post_tag' taxonomy to 'post' post type
    register_taxonomy_for_object_type('post_tag', 'post');
    
    // Make sure the 'post' post type supports 'tags'
    add_post_type_support('post', 'tags');
}
add_action('init', 'rightpath_enable_post_tags');



// Enqueue AJAX
function rightpath_ajax_comments_enqueue() {
    wp_enqueue_script(
        'ajax-comments',
        get_template_directory_uri() . '/assets/js/ajax-comments.js',
        ['jquery'],
        null,
        true
    );

    wp_localize_script('ajax-comments', 'ajax_comments', [
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('ajax-comment-nonce')
    ]);
}
add_action('wp_enqueue_scripts', 'rightpath_ajax_comments_enqueue');

// Handle AJAX comment
add_action('wp_ajax_nopriv_rightpath_ajax_comment', 'rightpath_ajax_comment_submit');
add_action('wp_ajax_rightpath_ajax_comment', 'rightpath_ajax_comment_submit');

function rightpath_ajax_comment_submit() {
    if ( ! isset($_POST['nonce']) || ! wp_verify_nonce($_POST['nonce'], 'ajax-comment-nonce') ) {
        wp_send_json_error('Invalid security token.');
    }

    $comment_post_ID = intval($_POST['comment_post_ID']);
    $author = sanitize_text_field($_POST['author']);
    $email  = sanitize_email($_POST['email']);
    $comment_content = sanitize_textarea_field($_POST['comment']);
    $comment_parent  = isset($_POST['comment_parent']) ? intval($_POST['comment_parent']) : 0;

    if(!$comment_post_ID || empty($author) || empty($email) || empty($comment_content)){
        wp_send_json_error('Please fill all fields.');
    }

    $comment_data = [
        'comment_post_ID'      => $comment_post_ID,
        'comment_author'       => $author,
        'comment_author_email' => $email,
        'comment_content'      => $comment_content,
        'comment_approved'     => 1,
        'comment_parent'       => $comment_parent
    ];

    $comment_id = wp_insert_comment($comment_data);

    if($comment_id){
        $comments = get_comments([
            'post_id' => $comment_post_ID,
            'status'  => 'approve',
        ]);

        ob_start();
        wp_list_comments([
            'style'       => 'ul',
            'short_ping'  => true,
            'avatar_size' => 50,
            'callback'    => 'custom_comment_layout'
        ], $comments);
        $comments_html = ob_get_clean();

        wp_send_json_success([
            'comments_html' => $comments_html,
            'message'       => '✅ Comment submitted successfully!',
            'parent'        => $comment_parent
        ]);
    } else {
        wp_send_json_error('Failed to submit comment.');
    }

    wp_die();
}

// Custom callback for comments
function custom_comment_layout($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment; ?>
    
    <li <?php comment_class('comment-item'); ?> id="comment-<?php comment_ID(); ?>">
        <div class="comment d-flex">
            <div class="comment-author">
                <?php echo get_avatar($comment, 60, '', '', ['class' => 'rounded-circle']); ?>
            </div>
            <div class="comment-content">
                <div class="comment-meta d-flex justify-content-between align-items-center">
                    <div class="comment-meta-author">
                        <?php echo get_comment_author_link(); ?>
                    </div>
                    <div class="comment-meta-date">
                        <span><?php echo get_comment_date('F j, Y'); ?> at <?php echo get_comment_time(); ?></span>
                    </div>
                </div>
                <div class="comment-body">
                    <?php comment_text(); ?>
                </div>
                <!-- <div class="comment-meta-reply">
                    <?php
                    comment_reply_link(array_merge($args, [
                        'reply_text' => 'Reply',
                        'depth' => $depth,
                        'max_depth' => $args['max_depth']
                    ]));
                    ?>
                </div> -->
            </div>
        </div>
    </li>
<?php }








