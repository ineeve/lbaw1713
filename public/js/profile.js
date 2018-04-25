let offset = 0;

function getPreviousArticles(username) {
    if ($('#previous_articles').hasClass("clickable")) {
        offset -= 2;
        jQuery.ajax({
            url: "/api/users/" + username + "/articles",
            method: 'get',
            data: {
                offset: offset
            },
            success: function (result) {
                if (result.offset == 0) {
                    $('#previous_articles').removeClass("clickable");
                }
                if (result.count != 0) {
                    $('#next_articles').addClass("clickable");
                }
                $('#my_articles').empty();
                $('#my_articles').append(result.view);

            }
        });
    }

}

function getNextArticles(username) {
    console.log("ofset = "+offset);
    if ($('#next_articles').hasClass("clickable")) {
        offset += 2;
        jQuery.ajax({
            url: "/api/users/" + username + "/articles",
            method: 'get',
            data: {
                offset: offset
            },
            success: function (result) {
                console.log("sucesso");
                if (result.offset == 0) {
                    $('#previous_articles').removeClass("clickable");
                } else {
                    $('#previous_articles').addClass("clickable");
                }
                if (result.count == 0) {
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