<?php
/**
 * Testimonials Section
 * Dynamic using ACF fields from "testimonial" CPT
 */
?>

<!-- Testimonial Start -->
<div class="testimonial-2 content-area-20">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-title">
                    <h1>Our Testimonials</h1>
                    <p>See what our clients say about working with us.</p>
                </div>
            </div>
        </div>

        <!-- Slick slider area start -->
        <div class="slick-slider-area">
            <div class="row slick-carousel" 
                 data-slick='{"slidesToShow": 2, "responsive":[{"breakpoint": 1024,"settings":{"slidesToShow": 1}}, {"breakpoint": 768,"settings":{"slidesToShow": 1}}]}'>
                 
                <?php
                $args = [
                    'post_type' => 'testimonial',
                    'posts_per_page' => -1,
                    'orderby' => 'date',
                    'order' => 'DESC',
                ];

                $testimonials = new WP_Query($args);

                if ($testimonials->have_posts()) :
                    while ($testimonials->have_posts()) : $testimonials->the_post();

                        $client_name = get_field('client_name');
                        $client_role = get_field('client_role');
                        $company = get_field('company');
                        $testimonial_text = get_field('testimonial_text');
                        $rating = get_field('rating') ?: 5; // default 5 stars
                        $client_photo = get_field('client_photo');
                ?>
                    <div class="slick-slide-item">
                        <div class="testimonials-inner">
                            <div class="user">
                                <?php if ($client_photo) : ?>
                                    <img class="media-object rounded-circle" 
                                         src="<?php echo esc_url($client_photo['url']); ?>" 
                                         alt="<?php echo esc_attr($client_name); ?>">
                                <?php else : ?>
                                    <img class="media-object rounded-circle" 
                                         src="<?php bloginfo('template_directory'); ?>/assets/img/avatar/avatar-default.png" 
                                         alt="<?php echo esc_attr($client_name); ?>">
                                <?php endif; ?>
                            </div>
                            <div class="testimonial-info">
                                <h3>
                                    <?php echo esc_html($client_name); ?>
                                    <?php if($client_role) echo ', '.esc_html($client_role); ?>
                                </h3>
                                <?php if($company) : ?>
                                    <p><?php echo esc_html($company); ?></p>
                                <?php endif; ?>
                                <!-- <p><?php //echo esc_html($testimonial_text); ?></p> -->
                                <p><?php the_field('testimonial_text'); ?></p>

                                <div class="rating">
                                    <?php for($i=0; $i<5; $i++) : ?>
                                        <i class="fa fa-star<?php echo ($i < $rating) ? '' : '-o'; ?>"></i>
                                    <?php endfor; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    echo '<p>No testimonials found.</p>';
                endif;
                ?>

            </div>
        </div>
    </div>
</div>
<!-- Testimonial End -->