<?php
/**
 * Template part for displaying single blog posts
 */
if (!defined('ABSPATH')) exit;

// Breadcrumb image
$breadcrumb_image = function_exists('get_field') ? get_field('breadcrumb_image') : '';
if (is_array($breadcrumb_image) && isset($breadcrumb_image['url'])) {
    $breadcrumb_bg = esc_url($breadcrumb_image['url']);
} elseif (is_string($breadcrumb_image)) {
    $breadcrumb_bg = esc_url($breadcrumb_image);
} else {
    $breadcrumb_bg = get_template_directory_uri() . '/assets/img/default-banner.jpg';
}
?>

<!-- Sub banner start -->
<div class="sub-banner" style="background: url('<?php echo $breadcrumb_bg; ?>') center center / cover no-repeat;">
    <div class="container">
        <div class="breadcrumb-area text-center">
            <h1><?php the_title(); ?></h1>
            <ul class="breadcrumbs">
                <li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
                <li class="active"><?php the_title(); ?></li>
            </ul>
        </div>
    </div>
</div>
<!-- Sub banner end -->

<!-- Blog section start -->
<div class="blog-section content-area-7">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                <!-- Blog grid box start -->
                <div class="blog-2 mb-50 blog-big">
                    <!-- Post Thumbnail -->
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="blog-photo">
                            <?php the_post_thumbnail('full', ['class' => 'img-fluid']); ?>
                        </div>
                    <?php endif; ?>

                    <!-- Post Content -->
                    <div class="blog-one__single-text-box detail">
                        <h3 class="title"><?php the_title(); ?></h3>
                        <div class="post-content">
                            <?php the_content(); ?>
                        </div>

                        <!-- Tags & Social Share -->
                        <div class="row clearfix tags-socal-box">
                            <div class="col-lg-7 col-md-7 col-sm-7">
                                <div class="tags">
    <h2>Tags</h2>
    <?php
    $tags = get_the_terms(get_the_ID(), 'post_tag'); // standard WP post tags
    if (!empty($tags) && !is_wp_error($tags)) {
        echo '<ul>';
        foreach ($tags as $tag) {
            echo '<li><a href="' . esc_url(get_tag_link($tag->term_id)) . '">' . esc_html($tag->name) . '</a></li>';
        }
        echo '</ul>';
    } else {
        echo '<p>No tags</p>';
    }
    ?>
</div>

                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-5">
                                <div class="social-list">
                                    <h2>Share</h2>
                                    <ul>
                                        <li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                                        <li><a href="<?php the_permalink(); ?>/#comments"><i class="fa fa-rss"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- Blog grid box end -->

                <!-- Comments section start -->
                <div class="comments-section">
                    <h3 class="heading-3">Comments Section</h3>
                    <ul class="list-unstyled" id="comment-list">
                        <?php
                        $comments = get_comments([
                            'post_id' => get_the_ID(),
                            'status'  => 'approve',
                        ]);

                        if ($comments) {
                            wp_list_comments([
                                'style'       => 'ul',
                                'short_ping'  => true,
                                'avatar_size' => 50,
                                'callback'    => 'custom_comment_layout'
                            ], $comments);
                        } else {
                            echo '<p>No comments yet. Be the first to comment!</p>';
                        }
                        ?>
                    </ul>
                </div>
                <!-- Leave a comment -->
                
                <!-- AJAX Comment Form -->
                <div class="contact-3">
                    <h3 class="heading-3">Leave a Comment</h3>
                    <form id="ajax-comment-form" method="post">
                        <input type="hidden" name="comment_post_ID" value="<?php the_ID(); ?>">
                        <input type="hidden" name="nonce" value="<?php echo wp_create_nonce('ajax-comment-nonce'); ?>">

                        <div class="row">
                            <div class="col-lg-6"><input type="text" name="author" class="form-control" placeholder="Name" required></div>
                            <div class="col-lg-6"><input type="email" name="email" class="form-control" placeholder="Email" required></div>
                            <div class="col-lg-12"><textarea name="comment" class="form-control" placeholder="Write message" required></textarea></div>
                            <div class="col-lg-6"><button type="submit" class="btn btn-4">Send Message</button></div>
                        </div>
                    </form>
                    <div id="comment-message" class="alert mt-3" style="display:none;"></div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Blog section end -->

<style>
/* .comments-section ul { list-style: none; padding: 0; } */
/* .comments-section li { margin-bottom: 20px; border-bottom: 1px solid #ddd; padding-bottom: 10px; } */
/* .comments-section .comment-author { font-weight: bold; margin-bottom:5px; display:flex; align-items:center; gap:10px;} */
/* .comments-section .comment-content { margin-top: 5px; } */
#ajax-comment-form .form-control { margin-bottom: 15px; border-radius:6px; }


/* .comment-item { margin-bottom: 25px; border-bottom: 1px solid #eee; padding-bottom: 20px; } */
/* .comment { display: flex; gap: 15px; } */
.comment-author img { width: 50px; height: 50px; border-radius: 50%; }
.comment-content { flex: 1; }
.comment-meta { font-size: 12px; color: #777; margin-bottom: 5px; }
.comment-meta-author { font-weight: bold; color: #333; }
.comment-meta-date { font-size: 10px; color: #aaa; }
.comment-body { font-size: 10px; margin: 5px 0; line-height: 1; }
.comment-meta-reply a { font-size: 10px; color: #0073aa; text-decoration: none; }
.comment-meta-reply a:hover { text-decoration: underline; }


</style>
