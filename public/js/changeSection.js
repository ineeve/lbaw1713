'use strict';

jQuery(document).ready(function () {
    let offset = 0; 
    jQuery('.section_all').click(function (e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: "/api/news",
            method: 'post',
            data: {},
            success: function (result) {
                
            }
        });
    });

    jQuery('.section_specific').click(function (e) {
        e.preventDefault();
            $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });
        jQuery.ajax({
            url: "/api/news/"+section_id,
            method: 'post',
            data: {
                next_comment: offset
            },
            success: function (result) {
                $('content').add(result.view);
            }
        });
    });
});