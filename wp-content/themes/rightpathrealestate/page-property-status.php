<?php
/**
 * Template Name: Property Status Page
 */

get_header();

// Get current page slug
$page_slug = get_post_field('post_name', get_the_ID());

// Get all choices from the ACF field
$field = get_field_object('status', 'option') ?: get_field_object('status'); // adjust if needed
$status_choices = $field['choices'] ?? [];

// Build dynamic map: slug => label
// Dynamic status map (slug => label)
$dynamic_status_map = [];
$property_field = get_field_object('status', 'property'); // just to be safe
if (!$property_field) {
    // fallback: hardcode
    $choices = ['For Sale','For Lease','Recently Sold','Invest'];
    foreach ($choices as $value) {
        $slug = sanitize_title($value);
        $dynamic_status_map[$slug] = $value;
    }
}

// Get current page status
$status = $dynamic_status_map[$page_slug] ?? '';

// Properties per page
$posts_per_page = 6;

// Query first page of properties
$args = [
    'post_type'      => 'property',
    'posts_per_page' => $posts_per_page,
    'meta_query'     => [
        [
            'key'     => 'status',
            'value'   => $status,
            'compare' => '='
        ]
    ]
];

$properties = new WP_Query($args);

// Count total matching properties
$total_properties = new WP_Query([
    'post_type'  => 'property',
    'meta_query' => [
        [
            'key'     => 'status',
            'value'   => $status,
            'compare' => '='
        ]
    ],
    'fields' => 'ids',
]);
$total_count = $total_properties->found_posts;
?>


<!-- Sub Banner -->
<div class="sub-banner">
    <div class="container">
        <div class="breadcrumb-area">
            <h1><?php the_title(); ?></h1>
            <ul class="breadcrumbs">
                <li><a href="<?php echo home_url(); ?>">Home</a></li>
                <li class="active"><?php the_title(); ?></li>
            </ul>
        </div>
    </div>
</div>

<!-- Properties List -->
<div class="properties-list-fullwidth content-area-2">
    <div class="container">
        <div class="row" id="properties-row">
            <?php if ($properties->have_posts()): ?>
                <?php while ($properties->have_posts()): $properties->the_post(); ?>
                    <?php get_template_part('template-parts/content', 'property'); ?>
                <?php endwhile; wp_reset_postdata(); ?>
            <?php else: ?>
                <div class="col-12 text-center py-5">
                    <p class="fw-bold text-muted">No properties found for "<?php echo esc_html($status ?: 'this status'); ?>".</p>
                </div>
            <?php endif; ?>
        </div>

        <?php if ($total_count > $posts_per_page): ?>
            <div class="text-center mt-4" id="load-more-container">
                <button id="load-more-properties" class="btn btn-primary"
                        data-page="1"
                        data-status="<?php echo esc_attr($status); ?>">
                    Load More Properties
                </button>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>
