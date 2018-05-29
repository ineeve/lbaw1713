'use strict';

jQuery(document).ready(function () {
    let offset = 0; 
    jQuery('#scroll_advanced_search_users').click(function (e) {
        e.preventDefault();
        let searchText = $('input#user_advanced_search')[0].value;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: "/api/advanced_search/users/" + searchText + "/scroll",
            method: 'post',
            data: {
                offset: offset
            },
            success: function (result) {
                if(result.next == 0){
                    $('#users_item_preview_list').append("<div style=\"width: 100%\" class=\"alert alert-dismissible alert-secondary\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>Sorry!</strong> No more comments at the moment!</div>");
                } else {
                    console.log(result.users);
                    result.users.forEach(function(element) {
                        $('#users_item_preview_list').append(element);
                      });
                }
                
                offset += result.next;
            }
        });
    });
});