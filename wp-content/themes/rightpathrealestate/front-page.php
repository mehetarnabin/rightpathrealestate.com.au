<?php
/**
 * Front Page Template
 * Loads homepage content if user is on the front page.
 */

get_header();

if ( is_front_page() ) :

    // Load homepage sections
    get_template_part( 'template-parts/home/banner' );
    get_template_part( 'template-parts/home/featured-properties' );
    get_template_part( 'template-parts/home/services' );
    get_template_part( 'template-parts/home/testimonials' );
    get_template_part( 'template-parts/home/blog' );

else :

    // For any other URL, use index.php template
    // This ensures 404 works for non-existing pages
    get_template_part( 'index' );

endif;

get_footer();
