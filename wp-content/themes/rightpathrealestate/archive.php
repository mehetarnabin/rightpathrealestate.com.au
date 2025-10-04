<?php
/**
 * The template for displaying archive pages (categories, tags, author, date, etc.)
 *
 * @package RightPathRealEstate
 */

get_header();
?>

<main id="site-main" class="site-main container py-5">

    <!-- Page Title -->
    <header class="archive-header mb-5 text-center">
        <?php if ( is_category() ) : ?>
            <h1 class="archive-title">Category: <?php single_cat_title(); ?></h1>
        <?php elseif ( is_tag() ) : ?>
            <h1 class="archive-title">Tag: <?php single_tag_title(); ?></h1>
        <?php elseif ( is_author() ) : ?>
            <h1 class="archive-title">Author: <?php the_author(); ?></h1>
        <?php elseif ( is_date() ) : ?>
            <h1 class="archive-title">Archive: <?php the_time('F Y'); ?></h1>
        <?php else : ?>
            <h1 class="archive-title">Blog</h1>
        <?php endif; ?>

        <?php if ( term_description() ) : ?>
            <div class="archive-description text-muted">
                <?php echo term_description(); ?>
            </div>
        <?php endif; ?>
    </header>

    <!-- Posts Grid -->
    <?php if ( have_posts() ) : ?>
        <div class="row g-4">

            <?php while ( have_posts() ) : the_post(); ?>
                <div class="col-lg-4 col-md-6">
                    <article id="post-<?php the_ID(); ?>" <?php post_class('card h-100 shadow-sm'); ?>>

                        <?php if ( has_post_thumbnail() ) : ?>
                            <a href="<?php the_permalink(); ?>" class="post-thumbnail">
                                <?php the_post_thumbnail('medium', ['class' => 'card-img-top']); ?>
                            </a>
                        <?php endif; ?>

                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h5>
                            <p class="card-text text-muted small mb-2">
                                <i class="fa fa-calendar"></i> <?php echo get_the_date(); ?>
                            </p>
                            <p class="card-text"><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
                        </div>

                        <div class="card-footer bg-white border-0">
                            <a href="<?php the_permalink(); ?>" class="btn btn-sm btn-primary">Read More</a>
                        </div>

                    </article>
                </div>
            <?php endwhile; ?>

        </div>

        <!-- Pagination -->
        <div class="pagination mt-5">
            <?php
            the_posts_pagination([
                'prev_text' => '« Previous',
                'next_text' => 'Next »',
            ]);
            ?>
        </div>

    <?php else : ?>
        <p class="text-center">No posts found.</p>
    <?php endif; ?>

</main>

<?php get_footer(); ?>
