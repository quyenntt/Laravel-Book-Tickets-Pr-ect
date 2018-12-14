function deleteImages(id_imge) {
    var image = 'image_delete' + id_imge;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    $.ajax({
        type: "post",
        url: GlobleVariable.app_url + '/edit/' + id_imge,
        dataType: "json",
        data: {id: id_imge},
        success: function (data) {
            var $images = data.images;
            var show_image = "";
            for (var i = 0; i < $images.length; i++) {
                var $image = $images[i];

                show_image += '<div class="col-md-3">'
                        + '<div class="form-group" style="width: 200px">'
                        + '<input type="hidden" id="image_id" value="' + $image.id + '">'
                        + '<input type="hidden" id="product_id" value="' + $image.product_id + '">'
                        + '<input type="hidden" name="_method" value="delete">'
                        + '<img style="width: 300px; height: 250px" src="' + GlobleVariable.app_url + '/' + $image.link_image + '" height="300" class="img-responsive img-rounded">'
                        + '<div class="space-4"></div>'
                        + '<button type="button" class="btn btn-success" id="image_delete' + $image.id + '" value="' + $image.id + '" onclick="deleteImages(' + $image.id + ')">Delete</button>'
                        + '</div>'
                        + '</div>'
                        ;
            }
            ;
            $('#show_image_delete').html(show_image);
        }
    })
}