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


// AJAX Load More Properties
function rightpath_load_more_properties() {
    $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $filter = sanitize_text_field($_POST['filter'] ?? 'all');

    $args = [
        'post_type' => 'property',
        'posts_per_page' => 6,
        'paged' => $paged + 1,
        'meta_query' => [['key'=>'featured_property','value'=>1]]
    ];

    if ($filter !== 'all') {
        $args['tax_query'] = [
            ['taxonomy'=>'property_type','field'=>'slug','terms'=>$filter]
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



// Force 404 for invalid URLs, including restricted CPTs or private pages
function rightpath_smart_404_redirect() {
    if ( is_404() ) return; // Already 404

    global $wp_query, $post;

    // Check if no posts matched
    if ( !have_posts() ) {
        $wp_query->set_404();
        status_header(404);
        nocache_headers();
        include( get_template_directory() . '/404.php' );
        exit;
    }

    // Optional: Check for restricted post types (private or unpublished)
    if ( isset($post) ) {
        $restricted_post_types = ['service', 'agent', 'property']; // Add your CPTs here
        if ( in_array($post->post_type, $restricted_post_types) && $post->post_status != 'publish' ) {
            $wp_query->set_404();
            status_header(404);
            nocache_headers();
            include( get_template_directory() . '/404.php' );
            exit;
        }
    }

    // Optional: check for restricted pages (if you want)
    if ( is_page() && !is_page($post->ID) ) {
        $wp_query->set_404();
        status_header(404);
        nocache_headers();
        include( get_template_directory() . '/404.php' );
        exit;
    }
}
add_action('template_redirect', 'rightpath_smart_404_redirect');

