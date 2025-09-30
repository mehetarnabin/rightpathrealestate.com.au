<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800%7CPlayfair+Display:400,700%7CRoboto:100,300,400,400i,500,700">

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?> id="top" class="index-body">

<!-- Top header start -->
<header class="top-header th-bg" id="top-header-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-7">
                <div class="list-inline">
                    <a href="tel:0447640628"><i class="fa fa-phone"></i>+0447640628</a>
                    <a href="mailto:anjal@rightpathrealestate.com.au"><i class="fa fa-envelope"></i>anjal@rightpathrealestate.com.au</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-5">
                <ul class="top-social-media pull-right">
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</header>
<!-- Top header end -->

<!-- Main header start -->
<header class="main-header sticky-header" id="main-header-2">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="navbar navbar-expand-lg navbar-light rounded">
                    <a class="navbar-brand logo" href="<?php echo home_url(); ?>">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logos/black-logo.png" alt="logo">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
                        <span class="fa fa-bars"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbar">
    <?php
    wp_nav_menu(array(
        'theme_location' => 'primary_menu',
        'container'      => false,
        'menu_class'     => 'navbar-nav justify-content-end ml-auto',
        'fallback_cb'    => false,
        'depth'          => 2, // Only 2 levels for dropdown
        'walker' => new WP_Bootstrap_Navwalker(),

    ));
    ?>
</div>

                </nav>
            </div>
        </div>
    </div>
</header>
<!-- Main header end -->

<!-- Sidenav start -->
<nav id="sidebar" class="nav-sidebar">
    <div id="dismiss"><i class="fa fa-close"></i></div>
    <div class="sidebar-inner">
        <div class="sidebar-logo">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logos/black-logo.png" alt="sidebarlogo">
        </div>
        <div class="sidebar-navigation">
            <h3 class="heading">Menu</h3>
            <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary_menu',
                    'container'      => false,
                    'menu_class'     => 'navbar-nav ml-auto',
                    'fallback_cb'    => false,
                    'depth'          => 2, // 2 levels is enough for dropdown
                    'walker'         => new WP_Bootstrap_Navwalker(),
                ));
            ?>
        </div>
        <div class="get-in-touch">
            <h3 class="heading">Get in Touch</h3>
            <div class="media">
                <i class="fa fa-phone"></i>
                <div class="media-body">
                    <a href="tel:0447640628">0447640628</a>
                </div>
            </div>
            <div class="media">
                <i class="fa fa-envelope"></i>
                <div class="media-body">
                    <a href="mailto:anjal@rightpathrealestate.com.au">anjal@rightpathrealestate.com.au</a>
                </div>
            </div>
        </div>
        <div class="get-social">
            <h3 class="heading">Get Social</h3>
            <a href="#" class="facebook-bg"><i class="fa fa-facebook"></i></a>
            <a href="#" class="twitter-bg"><i class="fa fa-twitter"></i></a>
            <a href="#" class="instagram-bg"><i class="fa fa-instagram"></i></a>
            <a href="#" class="linkedin-bg"><i class="fa fa-linkedin"></i></a>
        </div>
    </div>
</nav>
<!-- Sidenav end -->
