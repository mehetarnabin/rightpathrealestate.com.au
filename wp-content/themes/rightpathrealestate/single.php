<?php
// single.php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();

if ( have_posts() ) :
    while ( have_posts() ) : the_post();
        // Load the template part from template-parts/content-single.php
        get_template_part( 'template-parts/content', 'single' );
    endwhile;
else:
    echo '<div class="container"><p>No content found.</p></div>';
endif;

get_footer();
