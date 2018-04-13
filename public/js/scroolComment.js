'use strict';

jQuery(document).ready(function () {
    let offset = 0; 
    jQuery('#scroolComment').click(function (e) {
        e.preventDefault();
            $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });
        jQuery.ajax({
            url: "/api/news/"+news_id+"/comments/scroll", //TODO: change
            method: 'post',
            data: {
                next_comment: offset
            },
            success: function (result) {
                console.log(result);
                //console.log(response.view);
                $('#placeComments').append(result.view);
                offset += result.next;
            }
        });
    });
});