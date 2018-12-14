$("#comment-btn").click(function (e) {
    e.preventDefault();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('#_token1').val()
        }
    });
    var formData = {
        content: $('#content').val(),
        event_id: $('#event_id').val()
    }
    // alert('Thank for feedback!!');
    console.log(formData);
    alert('Thank for feedback!!');
    $.ajax({
        type: "POST",
        url: 'comment_event',
        data: formData,
        dataType: 'json',
        success: function (data) {
            alert('Thank for feedback!!');
            console.log(data);
            var comment = '<div class="comment-wrap">'
                    + '<div class="photo">'
                    + '<img src="http://placehold.it/400x400" width="50px" height="50px" style="border-radius:50%;-moz-border-radius:50%;border-radius:50%;">'
                    + $('#email').attr("value")
                    + '</div>' + '<div class="comment-block">' + '<p class="comment-text">' + data.content + '</p>'
                    + '<div class="bottom-comment">' + '<div class="comment-date">' + 'Posted:'
                    + diffForHumans(data.created_at) + '</div>' + '<ul class="comment-actions">' 
                    + '<i class="material-icons" style="font-size:20px">&#xe8dc; &nbsp;</i>'
                    + '<li class="complain">' + 'Like' + '</li>'
                    + '<div class="form-group">'
                    + '<button class="btn btn-primary reply" data-id="' + data.id + '" value="Reply">Reply</button>'
                    + '</div>'
                    + '</form>'
                    + '</div>'

                    + '</div>';
            $('#show_comment').append(comment);
            $('#content').val('');
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
});






