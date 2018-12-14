$(".reply").click(function (e) {
    var comment_id = $(this).data('id');
    e.preventDefault();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('#token_reply').val()
        }
    });

    var dataReply = {
        title: 's',
        content: $('#reply_content_' + comment_id).val(),
        product_id: $('#pro_id_' + comment_id).val(),
        parent_id: $('#parent_id_' + comment_id).val()
    }

    console.log(dataReply);
    $.ajax({
        type: "POST",
        url: 'reply_product',
        data: dataReply,
        dataType: 'json',
        success: function (data) {
            alert('Thank for reply!!');
            console.log(data);

            var reply = '<div class="media" style="border: 1px solid #e3e3e3; margin-top: 10px; margin-left: 150px; margin-right: 150px;">'
                    + '<div class="col-md-3">' + '<img src="http://foodstore/' + $('#avata_image1').attr("value")
                    + '" width="50px" height="50px" style="border-radius:50%;-moz-border-radius:50%;border-radius:50%; margin: 5px;">'
                    + $('#username1').attr("value") + '<br>' + '</div>' + '<div class="col-md-6">' + data.content + '</div>' + '<div class="col-md-3">' + '<p>'
                    + '<span class="glyphicon glyphicon-time">' + '</span>' + 'Posted:' + diffForHumans(data.created_at) + '</p>' + '</div>' + '</div>';
            $('#show_reply_' + comment_id).append(reply);
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
});
