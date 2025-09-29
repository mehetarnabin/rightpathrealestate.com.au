<?php
function rightpath_enqueue_assets() {
    // Styles
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '4.6.0');
    wp_enqueue_style('magnific-popup', get_template_directory_uri() . '/assets/css/magnific-popup.css', array(), '1.1.0');
    wp_enqueue_style('selectbox', get_template_directory_uri() . '/assets/css/jquery.selectBox.css', array(), '1.0');
    wp_enqueue_style('dropzone', get_template_directory_uri() . '/assets/css/dropzone.css', array(), '5.9.3');
    wp_enqueue_style('rangeslider', get_template_directory_uri() . '/assets/css/rangeslider.css', array(), '2.3.0');
    wp_enqueue_style('animate', get_template_directory_uri() . '/assets/css/animate.min.css', array(), '4.1.1');
    wp_enqueue_style('leaflet', get_template_directory_uri() . '/assets/css/leaflet.css', array(), '1.9.3');
    wp_enqueue_style('slick', get_template_directory_uri() . '/assets/css/slick.css', array(), '1.8.1');
    wp_enqueue_style('slick-theme', get_template_directory_uri() . '/assets/css/slick-theme.css', array(), '1.8.1');
    wp_enqueue_style('mcustomscrollbar', get_template_directory_uri() . '/assets/css/jquery.mCustomScrollbar.css', array(), '3.1.5');
    wp_enqueue_style('fontawesome', get_template_directory_uri() . '/assets/fonts/font-awesome/css/font-awesome.min.css', array(), '4.7.0');
    wp_enqueue_style('flaticon', get_template_directory_uri() . '/assets/fonts/flaticon/font/flaticon.css', array(), '1.0');
    
    // Main stylesheet
    wp_enqueue_style('rightpath-style', get_template_directory_uri() . '/assets/css/style.css', array(), filemtime(get_template_directory() . '/assets/css/style.css'));
    
    // Skin CSS
    wp_enqueue_style('skin-default', get_template_directory_uri() . '/assets/css/skins/default.css', array('rightpath-style'), filemtime(get_template_directory() . '/assets/css/skins/default.css'));

    // jQuery (WP-bundled)
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
        $deps = ['jquery'];
        $in_footer = true;
        $ver = filemtime(get_template_directory() . '/' . $path);
        wp_enqueue_script($handle, get_template_directory_uri() . '/' . $path, $deps, $ver, $in_footer);
    }

    // Pass theme URL to JS
    $theme_vars = [
        'themeUrl' => get_template_directory_uri()
    ];
    wp_localize_script('app', 'themeVars', $theme_vars);
}
add_action('wp_enqueue_scripts', 'rightpath_enqueue_assets');
?>
