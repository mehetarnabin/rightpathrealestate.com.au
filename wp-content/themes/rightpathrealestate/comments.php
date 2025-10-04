<?php
/**
 * Template for displaying comments
 *
 * @package RightPathRealEstate
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Don't display comments if post is password protected
if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php if ( have_comments() ) : ?>
        <h3 class="comments-title">
            <?php
            $comments_number = get_comments_number();
            if ( 1 === $comments_number ) {
                printf( _x( 'One Comment', 'comments title', 'rightpathrealestate' ) );
            } else {
                printf(
                    _nx(
                        '%1$s Comment',
                        '%1$s Comments',
                        $comments_number,
                        'comments title',
                        'rightpathrealestate'
                    ),
                    number_format_i18n( $comments_number )
                );
            }
            ?>
        </h3>

        <ul class="comment-list">
            <?php
            wp_list_comments( array(
                'style'      => 'ul',
                'short_ping' => true,
                'avatar_size'=> 50,
            ) );
            ?>
        </ul>

    <?php endif; // have_comments() ?>

    <?php
    // Comment form is handled via AJAX in content-single.php
    // This ensures backward compatibility if someone disables JS
    comment_form( array(
        'title_reply' => 'Leave a Comment',
        'label_submit'=> 'Send Message',
    ) );
    ?>

</div><!-- #comments -->
