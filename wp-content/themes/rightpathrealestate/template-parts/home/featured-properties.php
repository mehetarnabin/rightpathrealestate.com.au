<?php
/**
 * Featured Properties Section
 */
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