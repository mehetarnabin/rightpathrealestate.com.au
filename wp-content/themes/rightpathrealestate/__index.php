<?php get_header(); ?>


<!-- Featured properties end -->
<?php
// Get all property types for Filterizr buttons
$property_types = get_terms([
    'taxonomy' => 'property_type',
    'hide_empty' => false,
]);
?>

<!-- Featured Properties Start -->
<div class="featured-properties content-area-2">
    <div class="container">
        <!-- Section Title & Filters -->
        <div class="main-title">
            <h1>Featured Properties</h1>
            <ul class="list-inline-listing filters filteriz-navigation">
                <li class="active btn filtr-button filtr" data-filter="all">All</li>
                <?php foreach ($property_types as $ptype) : ?>
                    <li class="btn btn-inline filtr-button filtr" data-filter="<?php echo esc_attr($ptype->term_id); ?>">
                        <?php echo esc_html($ptype->name); ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- Properties Grid -->
        <div class="row filter-portfolio wow fadeInUp delay-04s">
            <div class="cars"><!-- ✅ wrapper restored -->
                <?php
                $args = [
                    'post_type' => 'property',
                    'posts_per_page' => -1,
                    'meta_query' => [
                        ['key' => 'featured_property', 'value' => 1]
                    ],
                ];
                $properties = new WP_Query($args);
                if ($properties->have_posts()) :
                    while ($properties->have_posts()) : $properties->the_post();

                        // Get property type IDs for Filterizr
                        $terms = wp_get_post_terms(get_the_ID(), 'property_type', ['fields' => 'ids']);
                        $data_category = implode(',', $terms);

                        // ACF fields
                        $price = get_field('price');
                        $status = get_field('status');
                        $area = get_field('area');
                        $beds = get_field('beds');
                        $baths = get_field('baths');
                        $garage = get_field('garage');
                        $address = get_field('address');
                        $agent = get_field('agent');
                        $image = get_field('image');
                ?>
                    <div class="col-lg-4 col-md-6 col-sm-12 filtr-item" data-category="<?php echo esc_attr($data_category); ?>">
                        <div class="property-box-7">
                            <!-- Thumbnail -->
                            <div class="property-thumbnail">
                                <a href="<?php the_permalink(); ?>" class="property-img">
                                    <?php if ($status) : ?>
                                        <div class="tag-2"><?php echo esc_html($status); ?></div>
                                    <?php endif; ?>
                                    <?php if ($price) : ?>
                                        <div class="price-box"><span> $<?php echo esc_html($price); ?></span></div>
                                    <?php endif; ?>
                                    <?php if ($image) : ?>
                                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php the_title(); ?>" class="img-fluid">
                                    <?php else : ?>
                                        <?php the_post_thumbnail('full', ['class' => 'img-fluid']); ?>
                                    <?php endif; ?>
                                </a>
                            </div>

                            <!-- Details -->
                            <div class="detail">
                                <h1 class="title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h1>
                                <?php if ($address) : ?>
                                    <div class="location">
                                        <a href="<?php the_permalink(); ?>">
                                            <i class="flaticon-facebook-placeholder-for-locate-places-on-maps"></i>
                                            <?php echo esc_html($address); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <ul class="facilities-list clearfix">
                                <?php if ($area) : ?><li><span>Area</span><?php echo esc_html($area); ?> Sqft</li><?php endif; ?>
                                <?php if ($beds) : ?><li><span>Beds</span><?php echo esc_html($beds); ?></li><?php endif; ?>
                                <?php if ($baths) : ?><li><span>Baths</span><?php echo esc_html($baths); ?></li><?php endif; ?>
                                <?php if ($garage) : ?><li><span>Garage</span><?php echo esc_html($garage); ?></li><?php endif; ?>
                            </ul>
                            <div class="footer clearfix">
                                <div class="pull-left days">
                                    <p>
                                        <i class="fa fa-user"></i>
                                        <?php 
                                        $agent = get_field('agent'); 
                                        if ($agent) {
                                            // Case 1: Post Object
                                            if ($agent instanceof WP_Post) {
                                                $agent_id = $agent->ID;
                                                echo '<a href="' . esc_url(get_permalink($agent_id)) . '">';
                                                    echo esc_html(get_the_title($agent_id));
                                                echo '</a>';

                                                // Thumbnail clickable
                                                if (has_post_thumbnail($agent_id)) {
                                                    echo '<br><a href="' . esc_url(get_permalink($agent_id)) . '">';
                                                        echo get_the_post_thumbnail($agent_id, 'thumbnail', ['class' => 'rounded-circle']);
                                                    echo '</a>';
                                                }
                                            } 
                                            // Case 2: ID
                                            elseif (is_numeric($agent)) {
                                                echo '<a href="' . esc_url(get_permalink($agent)) . '">';
                                                    echo esc_html(get_the_title($agent));
                                                echo '</a>';

                                                if (has_post_thumbnail($agent)) {
                                                    echo '<br><a href="' . esc_url(get_permalink($agent)) . '">';
                                                        echo get_the_post_thumbnail($agent, 'thumbnail', ['class' => 'rounded-circle']);
                                                    echo '</a>';
                                                }
                                            } 
                                            // Case 3: Text fallback
                                            else {
                                                echo esc_html($agent);
                                            }
                                        } else {
                                            echo 'Agent Name';
                                        }
                                        ?>
                                    </p>
                                </div>
                                <ul class="pull-right">
                                    <li><a href="#"><i class="flaticon-heart-shape-outline"></i></a></li>
                                    <li><a href="#"><i class="flaticon-calendar"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    echo '<p class="text-center w-100 py-5 fw-bold text-muted">No featured properties found.</p>';
                endif;
                ?>
            </div><!-- /.cars -->
        </div>
    </div>
</div>
<!-- Featured Properties End -->

<!-- services start -->
<div class="services content-area-20 bg-white">
    <div class="container">
        <div class="main-title">
            <h1>What Are you Looking For?</h1>
            <p>We're so glad you're here! At Right Path, we believe that finding your perfect home should be an exciting and stress-free experience. Whether you're buying, selling, or renting, our friendly and dedicated team is here to make your journey as smooth and enjoyable as possible.</p>
        </div>
        <div class="row">
            <?php
            $args = [
                'post_type' => 'service',
                'posts_per_page' => -1,
                'orderby' => 'menu_order',
                'order' => 'ASC',
            ];
            $services = new WP_Query($args);

            if ($services->have_posts()) :
                while ($services->have_posts()) : $services->the_post();

                    $title = get_field('post_title') ?: get_the_title();
                    $description = get_field('description');
                    $icon = get_field('icon'); // e.g., flaticon-user
                    $image = get_field('image'); // returns array
                    $link = get_field('link');
                    
                    // Image URL
                    $image_url = $image ? $image['url'] : '';
            ?>
                <div class="col-lg-4 col-md-12 col-sm-12 wow fadeInUp delay-04s">
                    <div class="services-info-2">
                        <div class="inner">
                            <!-- Front -->
                            <div class="inner-top text-center">
                                <?php if ($link) : ?>
                                    <a href="<?php echo esc_url($link['url']); ?>" target="<?php echo esc_attr($link['target'] ?: '_self'); ?>">
                                        <h4><?php echo esc_html($title); ?></h4>
                                        <?php if ($icon) : ?>
                                            <i class="<?php echo esc_attr($icon); ?>"></i>
                                        <?php endif; ?>
                                    </a>
                                <?php else: ?>
                                    <h4><?php echo esc_html($title); ?></h4>
                                    <?php if ($icon) : ?>
                                        <i class="<?php echo esc_attr($icon); ?>"></i>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                            <!-- Back -->
                            <div class="inner-buttom text-center" style="<?php echo $image_url ? 'background-image:url('.esc_url($image_url).'); background-size:cover; background-position:center; opacity:0.9;' : ''; ?>">
                                <?php if ($description) : ?>
                                    <p><?php echo esc_html($description); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
                echo '<p class="text-center w-100 py-5 fw-bold text-muted">No services found.</p>';
            endif;
            ?>
        </div>
    </div>
</div>
<!-- services end -->


<!-- Testimonial Start -->
<div class="testimonial-2 content-area-20">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-title">
                    <h1>Our Testimonial</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.</p>
                </div>
            </div>
        </div>
        <!-- Slick slider area start -->
        <div class="slick-slider-area">
            <div class="row slick-carousel" data-slick='{"slidesToShow": 2, "responsive":[{"breakpoint": 1024,"settings":{"slidesToShow": 1}}, {"breakpoint": 768,"settings":{"slidesToShow": 1}}]}'>
                <div class="slick-slide-item">
                    <div class="testimonials-inner">
                        <div class="user">
                            <a href="#">
                                <img class="media-object" src="<?php bloginfo('template_directory') ?>/assets/img/avatar/avatar-2.png" alt="user">
                            </a>
                        </div>
                        <div class="testimonial-info">
                            <h3>
                                Creative Director, india
                            </h3>
                            <p>Office Manager</p>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text everLorem industry's standard dummy text everLorem.</p>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half-full"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="slick-slide-item">
                    <div class="testimonials-inner">
                        <div class="user">
                            <a href="#">
                                <img class="media-object" src="<?php bloginfo('template_directory') ?>/assets/img/avatar/avatar.png" alt="user">
                            </a>
                        </div>
                        <div class="testimonial-info">
                            <h3>
                                Pitarshon Roky
                            </h3>
                            <p>Web Designer, Uk</p>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text everLorem industry's standard dummy text everLorem.</p>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half-full"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="slick-slide-item">
                    <div class="testimonials-inner">
                        <div class="user">
                            <a href="#">
                                <img class="media-object" src="<?php bloginfo('template_directory') ?>/assets/img/avatar/avatar-3.png" alt="user">
                            </a>
                        </div>
                        <div class="testimonial-info">
                            <h3>
                                Maikel Alisa
                            </h3>
                            <p>Creative Director</p>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text everLorem industry's standard dummy text everLorem.</p>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half-full"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="slick-slide-item">
                    <div class="testimonials-inner">
                        <div class="user">
                            <a href="#">
                                <img class="media-object" src="<?php bloginfo('template_directory') ?>/assets/img/avatar/avatar-3.png" alt="user">
                            </a>
                        </div>
                        <div class="testimonial-info">
                            <h3>
                                Maikel Alisa
                            </h3>
                            <p>Creative Director</p>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text everLorem industry's standard dummy text everLorem.</p>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half-full"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Testimonial End -->

<!-- Blog start -->
<div class="blog content-area-2">
    <div class="container">
        <div class="main-title">
            <h1>Latest Blog</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.</p>
        </div>
        <div class="slick-slider-area">
            <div class="row slick-carousel wow fadeInUp delay-04s" data-slick='{"slidesToShow": 3, "responsive":[{"breakpoint": 1024,"settings":{"slidesToShow": 2}}, {"breakpoint": 768,"settings":{"slidesToShow": 1}}]}'>
                <div class="slick-slide-item">
                    <div class="blog-2">
                        <div class="blog-photo">
                            <img src="<?php bloginfo('template_directory') ?>/assets/img/blog/blog-3.png" alt="blog-2" class="img-fluid">
                            <div class="overlay-icon">
                                <a href="blog-detail.php"><span><i class="flaticon-add"></i></span></a>
                            </div>
                        </div>
                        <div class="blog-one__single-text-box detail">
                            <h3 class="title">
                                <a href="blog-detail.php">Buying a Best House</a>
                            </h3>
                            <p class="text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the</p>
                            <ul class="post-meta">
                                <li><i class="fa fa-calendar" aria-hidden="true"></i>25 June 2021</li>
                                <li><i class="fa fa-comments" aria-hidden="true"></i><a href="#">Com (05)</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="slick-slide-item wow">
                    <div class="blog-2">
                        <div class="blog-photo">
                            <img src="<?php bloginfo('template_directory') ?>/assets/img/blog/blog.png" alt="blog-2" class="img-fluid">
                            <div class="overlay-icon">
                                <a href="blog-detail.php"><span><i class="flaticon-add"></i></span></a>
                            </div>
                        </div>
                        <div class="blog-one__single-text-box detail">
                            <h3 class="title">
                                <a href="blog-detail.php">Buying a Best House</a>
                            </h3>
                            <p class="text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the</p>
                            <ul class="post-meta">
                                <li><i class="fa fa-calendar" aria-hidden="true"></i>25 June 2021</li>
                                <li><i class="fa fa-comments" aria-hidden="true"></i><a href="#">Com (05)</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="slick-slide-item">
                    <div class="blog-2">
                        <div class="blog-photo">
                            <img src="<?php bloginfo('template_directory') ?>/assets/img/blog/blog-2.png" alt="blog-2" class="img-fluid">
                            <div class="overlay-icon">
                                <a href="blog-detail.php"><span><i class="flaticon-add"></i></span></a>
                            </div>
                        </div>
                        <div class="blog-one__single-text-box detail">
                            <h3 class="title">
                                <a href="blog-detail.php">Find Your Dream Real Estate</a>
                            </h3>
                            <p class="text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the</p>
                            <ul class="post-meta">
                                <li><i class="fa fa-calendar" aria-hidden="true"></i>25 June 2021</li>
                                <li><i class="fa fa-comments" aria-hidden="true"></i><a href="#">Com (05)</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="slick-slide-item">
                    <div class="blog-2">
                        <div class="blog-photo">
                            <img src="<?php bloginfo('template_directory') ?>/assets/img/blog/blog-2.png" alt="blog-2" class="img-fluid">
                            <div class="overlay-icon">
                                <a href="blog-detail.php"><span><i class="flaticon-add"></i></span></a>
                            </div>
                        </div>
                        <div class="blog-one__single-text-box detail">
                            <h3 class="title">
                                <a href="blog-detail.php">Find Your Dream Real Estate</a>
                            </h3>
                            <p class="text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the</p>
                            <ul class="post-meta">
                                <li><i class="fa fa-calendar" aria-hidden="true"></i>25 June 2021</li>
                                <li><i class="fa fa-comments" aria-hidden="true"></i><a href="#">Com (05)</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Blog end -->

<!-- Footer start -->
<?php get_footer(); ?>
<!-- Footer end -->
