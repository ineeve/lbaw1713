'use strict';

jQuery(document).ready(function () {
    let order = 'POPULAR';
    // Order changed dropdown
    jQuery('.order-criteria').click(function (e) {
        e.preventDefault();
        $("#sort-option").html($(this).text());
        let section = $('#sections_list a.active').attr('name');
        order = $(this).attr('name');
        $('#sort-option').attr('name',order);
        let searchedText = $("input[name=searchText]")[0].innerText.trim();
        if (section != null){
            jQuery.ajax({
                url: "/api/news/section/" + section + "/order/" + order + "/offset/0",
                method: 'get',
                success: function (view) {
                    $('#news_item_preview_list').empty();
                    $('#news_item_preview_list').append(view);
                },
                error: function (xhr) {
                    console.log(xhr);
                }
            });
        } else {
            jQuery.ajax({
                url: "/api/news/order/" + order + "/offset/0",
                method: 'get',
                data: {
                    searchText: searchedText
                },
                success: function (view) {
                    $('#news_item_preview_list').empty();
                    $('#news_item_preview_list').append(view);
                },
                error: function (xhr) {
                    console.log(xhr);
                }
            })
        }
        
    });

    // Section changed pills
    jQuery('.section_item').click(function (e) {
        $('.current_section').html(e.currentTarget.innerHTML);
        jQuery.ajax({
            url: "/api/news/section/" + $(this).attr('name') + "/order/" + order + "/offset/0",
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