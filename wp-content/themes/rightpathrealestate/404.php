<?php get_header(); ?>

<!-- page-404 start -->
<div class="pages-404-2 content-area-7">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-12">
                <div class="error404-content">
                    <div class="error404">404</div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-12">
                <div class="nobottomborder">
                    <h1>We're sorry, but the page you were looking for doesn't exist</h1>
                    <p>Return to the home page using the button below.</p>
                    <a class="btn-2" href="<?php echo esc_url(home_url('/')); ?>"><span>Home Page</span></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- page-404 end -->
 

<?php get_footer(); ?>
