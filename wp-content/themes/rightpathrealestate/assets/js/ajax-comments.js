jQuery(document).ready(function($){
    $('#ajax-comment-form').on('submit', function(e){
        e.preventDefault();
        var form = $(this);
        var messageBox = $('#comment-message');
        messageBox.hide().removeClass('alert-success alert-danger');

        $.ajax({
            type: 'POST',
            url: ajax_comments.ajax_url,
            data: form.serialize() + '&action=rightpath_ajax_comment',
            dataType: 'json',
            success: function(response){
                if(response.success){
                    // Replace the entire comment list HTML
                    $('#comment-list').html(response.data.comments_html);

                    // Show success message
                    messageBox.addClass('alert-success').html(response.data.message).fadeIn();

                    // Reset form
                    form.trigger('reset');

                    // Reset reply parent
                    $('input[name="comment_parent"]').val(0);

                    // Scroll to the newly added comment section
                    $('html, body').animate({
                        scrollTop: $('#comment-list').offset().top
                    }, 500);
                } else {
                    messageBox.addClass('alert-danger').html(response.data).fadeIn();
                }
            },
            error: function(){
                messageBox.addClass('alert-danger').html('❌ Something went wrong!').fadeIn();
            }
        });
    });

    // Reply link click
    $(document).on('click', '.comment-reply-link', function(e){
        e.preventDefault();
        var commentID = $(this).data('commentid');
        $('input[name="comment_parent"]').val(commentID);
        $('html, body').animate({scrollTop: $('#ajax-comment-form').offset().top}, 500);
    });
});
