<?php
get_header();

if ( have_posts() ) :
    while ( have_posts() ) : the_post();
        ?>
        <main id="site-main" class="container">
            <h1><?php the_title(); ?></h1>
            <div><?php the_content(); ?></div>
        </main>
        <?php
    endwhile;
else :
    // Force 404
    global $wp_query;
    $wp_query->set_404();
    status_header(404);
    nocache_headers();
    get_template_part('template-parts/404'); 
endif;

get_footer();
