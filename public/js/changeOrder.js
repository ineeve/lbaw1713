'use strict';

jQuery(document).ready(function () {
    jQuery('.order-criteria').click(function (e) {
        e.preventDefault();
        jQuery.ajax({
            url: "/api/news/order/" + $(this).attr('name'),
            method: 'get',
            success: function (result) {
                $('#news_item_preview_list').empty();
                $('#news_item_preview_list').append(result.view);
            },
            error: function (xhr) {
                //console.log(xhr);
            }
        });
    });
});