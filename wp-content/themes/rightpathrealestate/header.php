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

<!--<div class="page_loader"></div>-->

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
                    <button class="navbar-toggler" type="button" id="drawer">
                        <span class="fa fa-bars"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbar">
                        <ul class="navbar-nav justify-content-end ml-auto">
                            <li class="nav-item active"><a class="nav-link" href="<?php echo home_url(); ?>">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?php echo home_url('/about'); ?>">About Us</a></li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown">Properties</a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink2">
                                    <li><a class="dropdown-item" href="<?php echo home_url('/properties-for-sale'); ?>">For Sale</a></li>
                                    <li><a class="dropdown-item" href="<?php echo home_url('/properties-for-lease'); ?>">For Lease</a></li>
                                    <li><a class="dropdown-item" href="<?php echo home_url('/sold-properties'); ?>">Recently Sold</a></li>
                                    <li><a class="dropdown-item" href="<?php echo home_url('/property-invest'); ?>">Invest</a></li>
                                </ul>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="<?php echo home_url('/team'); ?>">Team</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?php echo home_url('/blog'); ?>">Blog</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?php echo home_url('/careers'); ?>">Careers</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?php echo home_url('/faq'); ?>">FAQ</a></li>
                            <li class="nav-item sb2">
                                <a href="<?php echo home_url('/contact'); ?>" class="submit-btn">Contact Us</a>
                            </li>
                        </ul>
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
                'menu_class' => 'menu-list',
                'container' => false
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
