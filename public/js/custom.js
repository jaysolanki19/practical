$(document).ready(function() {
    $(document).on('click', '.delete-post-btn', function() {
        var postId = $(this).data('post-id');
        $('#delete_post_model').modal('show');
        $('#confirm_delete_btn').data('post-id', postId);
    });

    $(document).on('click', '#confirm_delete_btn', function() {
        var postId = $(this).data('post-id');
        $.ajax({
            type: 'POST',
            url: '/delete/post/' + postId,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    $('#delete_post_model').modal('hide');
                    window.location.reload();
                } 
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});