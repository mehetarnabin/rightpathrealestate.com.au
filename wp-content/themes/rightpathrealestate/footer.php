<?php
/**
 * Footer template for Right Path Real Estate
 */
?>

<!-- Footer start -->
<footer class="footer-5">
    <div class="lines">
        <?php for($i=0;$i<6;$i++): ?>
        <div class="line"></div>
        <?php endfor; ?>
    </div>

    <div class="clearfix"></div>
    <div class="footer-inner">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-8 col-sm-6">
                    <div class="footer-item clearfix">
                        <h4>Contact Info</h4>
                        <div class="s-border"></div>
                        <div class="m-border"></div>
                        <ul class="contact-info">
                            <li><i class="flaticon-facebook-placeholder-for-locate-places-on-maps"></i> Sydney, Australia</li>
                            <li><i class="fa fa-envelope"></i><a href="mailto:anjal@rightpathrealestate.com.au">anjal@rightpathrealestate.com.au</a></li>
                            <li><i class="fa fa-phone"></i><a href="tel:+0447640628">+0447640628</a></li>
                            <li class="mb-0"><i class="fa fa-fax"></i>+0447640628</li>
                        </ul>
                    </div>
                </div>

                <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6">
                    <div class="footer-item">
                        <h4>Useful Links</h4>
                        <div class="s-border"></div>
                        <div class="m-border"></div>
                        <ul class="links">
                            <li><a href="<?php echo home_url(); ?>"><i class="fa fa-angle-right"></i>Home</a></li>
                            <li><a href="<?php echo home_url('/about'); ?>"><i class="fa fa-angle-right"></i>About Us</a></li>
                            <li><a href="<?php echo home_url('/team'); ?>"><i class="fa fa-angle-right"></i>Team</a></li>
                            <li><a href="<?php echo home_url('/faq'); ?>"><i class="fa fa-angle-right"></i>FAQ</a></li>
                            <li><a href="<?php echo home_url('/careers'); ?>"><i class="fa fa-angle-right"></i>Careers</a></li>
                            <li><a href="<?php echo home_url('/blog'); ?>"><i class="fa fa-angle-right"></i>Blog</a></li>
                            <li><a href="<?php echo home_url('/contact'); ?>"><i class="fa fa-angle-right"></i>Contact Us</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                    <div class="footer-item fi-2 clearfix">
                        <div class="footer-gallery clearfix">
                            <h4>Our Gallery</h4>
                            <div class="s-border"></div>
                            <div class="m-border"></div>
                            <ul>
                                <?php for($i=1;$i<=6;$i++): ?>
                                <li>
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/sub-property/sub-property-<?php echo ($i==0?'':$i); ?>.png" alt="small-img">
                                </li>
                                <?php endfor; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="sub-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <p>Powered by <a href="https://sanmicron.com/" target="_blank">sanmicron.com</a></p>
                </div>
                <div class="col-lg-4 col-md-4">
                    <p class="copy">© <?php echo date('Y'); ?> <a href="#">Right Path.</a></p>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="social-media clearfix">
                        <div class="social-list">
                            <div class="icon facebook"><div class="tooltip">Facebook</div><span><i class="fa fa-facebook"></i></span></div>
                            <div class="icon twitter"><div class="tooltip">Twitter</div><span><i class="fa fa-twitter"></i></span></div>
                            <div class="icon instagram"><div class="tooltip">Instagram</div><span><i class="fa fa-instagram"></i></span></div>
                            <div class="icon youtube mr-0"><div class="tooltip">Youtube</div><span><i class="fa fa-youtube"></i></span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer end -->

<!-- Full Page Search -->
<div id="full-page-search">
    <button type="button" class="close">×</button>
    <form action="#" class="search">
        <input type="search" placeholder="type keyword(s) here"/>
        <button type="button" class="btn btn-sm btn-color">Search</button>
    </form>
</div>

<!-- Off-canvas sidebar -->
<div class="off-canvas-sidebar">
    <div class="off-canvas-sidebar-wrapper">
        <div class="off-canvas-header">
            <a class="close-offcanvas" href="#"><span class="fa fa-times"></span></a>
        </div>
        <div class="off-canvas-content">
            <aside class="canvas-widget">
                <div class="logo-sitebar text-center">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logos/logo.png" alt="logo">
                </div>
            </aside>
            <aside class="canvas-widget">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer_menu',
                    'menu_class' => 'menu',
                    'container' => false,
                ));
                ?>
            </aside>
            <aside class="canvas-widget">
                <ul class="social-icons">
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                </ul>
            </aside>
        </div>
    </div>
</div>

<?php
// WordPress footer hook: prints enqueued scripts, including themeVars for JS
wp_footer();
?>
</body>
</html>
