<?php
/**
 * Template part for displaying a property
 */

$price  = get_field('price');
$status = get_field('status');
$area   = get_field('area');
$beds   = get_field('beds');
$baths  = get_field('baths');
$garage = get_field('garage');
$address = get_field('address');
$image = get_field('property_image');
?>

<div class="col-lg-4 col-md-6 col-sm-12">
    <div class="property-box-4">
        <?php if ($image): ?>
        <div class="thumbnail_inner">
            <div class="thumbnail">
                <a href="<?php the_permalink(); ?>">
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="img-fluid">
                </a>
            </div>
        </div>
        <?php endif; ?>
        
        <div class="content">
            <div class="inner">
                <div class="portfolio_heading">
                    <h4 class="title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h4>
                    <div class="category_list">
                        <span><i class="flaticon-facebook-placeholder-for-locate-places-on-maps"></i> <?php echo esc_html($address); ?></span>
                    </div>
                </div>

                <div class="portfolio_hover">
                    <ul class="facilities-list clearfix">
                        <?php if ($beds): ?><li><i class="flaticon-bed"></i> <?php echo esc_html($beds); ?> Beds</li><?php endif; ?>
                        <?php if ($baths): ?><li><i class="flaticon-bath"></i> <?php echo esc_html($baths); ?> Baths</li><?php endif; ?>
                        <?php if ($area): ?><li><i class="flaticon-square-layouting-with-black-square-in-east-area"></i> Sq Ft: <?php echo esc_html($area); ?></li><?php endif; ?>
                        <?php if ($garage): ?><li><i class="flaticon-car-repair"></i> <?php echo esc_html($garage); ?> Garage</li><?php endif; ?>
                        <?php if ($status): ?><li><span class="property-status"><?php echo esc_html($status); ?></span></li><?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>

        <a class="transparent_link" href="<?php the_permalink(); ?>"></a>
    </div>
</div>