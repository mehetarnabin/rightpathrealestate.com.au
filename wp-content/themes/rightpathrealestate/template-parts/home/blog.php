<?php
/**
 * Blog Section - Homepage
 */

$args = [
    'post_type'      => 'post',
    'posts_per_page' => 3,
    'meta_query'     => [
        [
            'key'     => 'show_on_homepage',
            'value'   => '1',
            'compare' => '='
        ]
    ]
];
$homepage_posts = new WP_Query($args);

if ($homepage_posts->have_posts()) :
?>
<div class="blog content-area-2">
    <div class="container">
        <div class="main-title">
            <h1>Latest Blog</h1>
            <p>Check out our latest updates and insights.</p>
        </div>
        <div class="row slick-carousel" data-slick='{"slidesToShow": 3, "responsive":[{"breakpoint": 1024,"settings":{"slidesToShow": 2}}, {"breakpoint": 768,"settings":{"slidesToShow": 1}}]}'>
            <?php while ($homepage_posts->have_posts()) : $homepage_posts->the_post(); ?>
                <div class="slick-slide-item">
                    <div class="blog-2">
                        <div class="blog-photo">
                            <?php if (has_post_thumbnail()) : ?>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('medium_large', ['class' => 'img-fluid']); ?>
                                </a>
                            <?php endif; ?>
                            <div class="overlay-icon">
                                <a href="<?php the_permalink(); ?>"><span><i class="flaticon-add"></i></span></a>
                            </div>
                        </div>
                        <div class="blog-one__single-text-box detail">
                            <h3 class="title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>
                            <p class="text"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                            <ul class="post-meta">
                                <li><i class="fa fa-calendar"></i> <?php echo get_the_date(); ?></li>
                                <li><i class="fa fa-comments"></i> <?php comments_number('No Comments', '1 Comment', '% Comments'); ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </div>
</div>
<?php endif; ?>
