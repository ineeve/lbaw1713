let offset = 0;

function getNextArticles() {
        jQuery.ajax({
            url: "/api/reports/news",
            method: 'get',
            data: {
                offset: offset
            },
            success: function (result) {
                console.log("offset = " + result.offset);
                console.log("offset = " + offset);
                
                console.log(result);
                if (result.offset == 0) {
                    $('#p').addClass("disabled");
                } else {
                    $('#p').removeClass("disabled");
                }
                if ((result.offset-offset) >= 5) {
                    offset = result.offset;
                    $('#n').removeClass("disabled");
                } else {
                    $('#n').addClass("disabled");
                }
                $('tbody').replaceWith(result.view);
                // $('tbody').append(result.view);
            }
        });
}
