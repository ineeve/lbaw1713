'use strict';

jQuery(document).ready(function () {
    let order = 'POPULAR';
    // Order changed dropdown
    jQuery('.order-criteria').click(function (e) {
        e.preventDefault();
        let section = $('#sections_list a.active').attr('name');
        order = $(this).attr('name');
        jQuery.ajax({
            url: "/news/sections/" + section + "/order/" + order,
            method: 'get',
            success: function (view) {
                $('#news_item_preview_list').empty();
                $('#news_item_preview_list').append(view);
            },
            error: function (xhr) {
                console.log(xhr);
            }
        });
    });

    // Section changed pills
    jQuery('.section_item').click(function (e) {
        jQuery.ajax({
            url: "/news/sections/" + $(this).attr('name') + "/order/" + order,
            method: 'get',
            success: function (view) {
                $('#news_item_preview_list').empty();
                $('#news_item_preview_list').append(view);
            },
            error: function (xhr) {
                console.log(xhr);
            }
        });
    });
});