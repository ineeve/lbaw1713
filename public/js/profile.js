let articles_offset = 0;
let following_offset = 0;

function getPreviousArticles(username) {
    if ($('#previous_articles').hasClass("clickable")) {
        articles_offset -= 5;
        jQuery.ajax({
            url: "/api/users/" + username + "/articles",
            method: 'get',
            data: {
                offset: articles_offset
            },
            success: function (result) {
                if (result.articles_offset == 0) {
                    $('#previous_articles').removeClass("clickable");
                }
                if (result.articles_count > 0) {
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
        articles_offset += 5;
        jQuery.ajax({
            url: "/api/users/" + username + "/articles",
            method: 'get',
            data: {
                offset: articles_offset
            },
            success: function (result) {
                if (result.articles_offset == 0) {
                    $('#previous_articles').removeClass("clickable");
                } else {
                    $('#previous_articles').addClass("clickable");
                }
                if (result.articles_count > 0) {
                    $('#next_articles').removeClass("clickable");
                } else {
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

function getNextFollowing(username) {
    if ($('#next_following').hasClass("clickable")) {
        following_offset += 5;
        jQuery.ajax({
            url: "/api/users/" + username + "/following",
            method: 'get',
            data: {
                offset: following_offset
            },
            success: function (result) {
                if (result.following_offset == 0) {
                    $('#previous_following').removeClass("clickable");
                } else {
                    $('#previous_following').addClass("clickable");
                }
                if (result.following_count > 0) {
                    $('#next_following').removeClass("clickable");
                } else {
                    $('#next_following').addClass("clickable");
                }
                $('#my_following_users').empty();
                $('#my_following_users').append(result.view);
                $('#following_pagination').empty();
                $('#following_pagination').append(result.view_pagination);

            }
        });
    }

}

function getPreviousFollowing(username) {
    if ($('#previous_following').hasClass("clickable")) {
        following_offset -= 5;
        jQuery.ajax({
            url: "/api/users/" + username + "/following",
            method: 'get',
            data: {
                offset: following_offset
            },
            success: function (result) {
                if (result.following_offset == 0) {
                    $('#previous_following').removeClass("clickable");
                }
                if (result.following_count > 0) {
                    $('#next_following').addClass("clickable");
                }
                $('#my_following_users').empty();
                $('#my_following_users').append(result.view);
                $('#following_pagination').empty();
                $('#following_pagination').append(result.view_pagination);
            }
        });
    }

}

function startFollowing(username) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/api/users/" + username + "/start_following",
        method: 'post',
        success: function (result) {
            console.log("sucesso");
            var btn = "<button type=\"button\" class=\"btn btn-outline-primary\" onclick=\"stopFollowing( '" + username + "' )\">Following</button>";
            document.querySelector("div#following_btn").innerHTML = btn;
        }
    });

}

function stopFollowing(username) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "/api/users/" + username + "/stop_following",
        method: 'post',
        success: function (result) {
            console.log("sucesso");
            
            var btn = "<button type=\"button\" class=\"btn btn-primary\" onclick=\"startFollowing( '" + username + "' )\">Follow</button>";
            document.querySelector("div#following_btn").innerHTML = btn;
        }
    });

}