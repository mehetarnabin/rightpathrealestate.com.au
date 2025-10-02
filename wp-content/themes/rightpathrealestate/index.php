<?php
/**
 * Main Template File
 * Fallback for posts, pages, and archives.
 */

get_header();

if ( have_posts() ) : 
    while ( have_posts() ) : the_post();
        get_template_part('template-parts/content', get_post_type());
    endwhile;

    the_posts_pagination([
        'mid_size'  => 2,
        'prev_text' => '« Previous',
        'next_text' => 'Next »',
    ]);

else : 
    // If page requested but not found, show 404
    if ( is_page() ) {
        global $wp_query;
        $wp_query->set_404();
        status_header(404);
        nocache_headers();
    }
    get_template_part('template-parts/404'); 
endif;


get_footer(); 

?>
