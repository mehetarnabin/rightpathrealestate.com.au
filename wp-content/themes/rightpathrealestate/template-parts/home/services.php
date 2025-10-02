<?php
/**
 * Services Section
 */
?>
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