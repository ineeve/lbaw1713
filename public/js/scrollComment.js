'use strict';

jQuery(document).ready(function () {
<<<<<<< HEAD
    let offset = 0;
    jQuery('#scrollComment').click(function (e) {
=======
    let offset = 0; 
    jQuery('.comment #scroll').click(function (e) {
>>>>>>> dc3051397884632a3213a9c6af27095e4dcf971a
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: "/api/news/" + news_id + "/comments/scroll",
            method: 'post',
            data: {
                next_comment: offset
            },
            success: function (result) {
                if (result.next == 0) {
                    $('#placeComments').append("<div class=\"alert alert-dismissible alert-secondary\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>Sorry!</strong> No more comments at the moment!</div>");
                } else {
                    $('#placeComments').append(result.view);
                    offset += result.next;
                    onScrollComments();
                }

            }
        });
    });
    jQuery('.comment #scroll').trigger('click');
});