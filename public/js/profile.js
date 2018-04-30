let offset = 0;

function getPreviousArticles(username) {
    if ($('#previous_articles').hasClass("clickable")) {
        offset -= 5;
        jQuery.ajax({
            url: "/api/users/" + username + "/articles",
            method: 'get',
            data: {
                offset: offset
            },
            success: function (result) {
                console.log("offset = "+result.offset);
                console.log("count = "+result.count);
                if (result.offset == 0) {
                    $('#previous_articles').removeClass("clickable");
                }
                if (result.count > 0) {
                    $('#next_articles').addClass("clickable");
                }
                $('#my_articles').empty();
                $('#my_articles').append(result.view);
                $('#articles_pagination').empty();
                $('#articles_pagination').append(result.view_pagination);
            }
        });
    }

}

function getNextArticles(username) {
    if ($('#next_articles').hasClass("clickable")) {
        offset += 5;
        jQuery.ajax({
            url: "/api/users/" + username + "/articles",
            method: 'get',
            data: {
                offset: offset
            },
            success: function (result) {
                console.log("offset = "+result.offset);
                console.log("count = "+result.count);
                if (result.offset == 0) {
                    $('#previous_articles').removeClass("clickable");
                } else {
                    $('#previous_articles').addClass("clickable");
                }
                if (result.count > 0) {
                    $('#next_articles').removeClass("clickable");
                } else {
                    $('#next_articles').addClass("clickable");
                }
                $('#my_articles').empty();
                $('#my_articles').append(result.view);

            }
        });
    }

}