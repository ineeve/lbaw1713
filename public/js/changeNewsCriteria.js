'use strict';

jQuery(document).ready(function () {
    let order = 'POPULAR';
    let reversed = false;
    let previews_offset = 10;
    // Order changed dropdown
    jQuery('.order-criteria').click(function (e) {
        e.preventDefault();
        $("#sort-option").html($(this).text()+ " <i class=\"fas fa-chevron-down fa-fw ml-2 mt-1\"></i>");
        let section = $('#sections_list a.active').attr('data-name');
        order = $(this).attr('data-name');
        $('#sort-option').attr('data-name',order);
        let searchedText = $("input[name=searchText]")[0].innerText.trim();
        if (section != null){
            previews_offset=0;
            jQuery.ajax({
                url: "/api/news/section/" + section + "/order/" + order + "/offset/0",
                method: 'get',
                data: {
                    reversed: reversed
                },
                success: function (view) {
                    $('#news_item_preview_list').empty();
                    $('#news_item_preview_list').append(view);
                },
                error: function (xhr) {
                    console.log(xhr);
                }
            });
        } else {
            previews_offset = 0;
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
            url: "/api/news/section/" + $(this).attr('data-name') + "/order/" + order + "/offset/0",
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

     // Reverse clicked
     jQuery('#reverseOrderButton').click(function (e) {
        console.log('reversing');
        reversed = !reversed;
        let section = $('#sections_list a.active').attr('data-name');
        jQuery.ajax({
            url: "/api/news/section/" + section + "/order/" + order + "/offset/0",
            method: 'get',
            data: {
                reversed: reversed
            },
            success: function (view) {
                $('#news_item_preview_list').empty();
                $('#news_item_preview_list').append(view);
            },
            error: function (xhr) {
                console.log(xhr);
            }
        });
    });
    // load more
    jQuery('.previews #scroll').click(function (e) {
        console.log('loading more');
        let section = $('#sections_list a.active').attr('data-name');
        if (section != null){
            jQuery.ajax({
                url: "/api/news/section/" + section + "/order/" + order + "/offset/"+previews_offset,
                method: 'get',
                data: {
                    reversed: reversed
                },
                success: function (view) {
                    if(view.length == 0) {
                        $('#allNews').append("<div class=\"alert alert-dismissible alert-secondary\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>Sorry!</strong> No more news at the moment!</div>");
                    }
                    previews_offset+=10;
                    $('#news_item_preview_list').append(view);
                },
                error: function (xhr) {
                    console.log(xhr);
                }
            });
        } else{
            let searchedText = $("input[name=searchText]")[0].innerText.trim();
            jQuery.ajax({
                url: "/api/news/order/" + order + "/offset/"+previews_offset,
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
});