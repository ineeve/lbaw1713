'use strict';
// TODO: put initialoffset dynamic
let offset = 5;

function getNextArticles(e) {
    e.preventDefault();
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
        }
    });
}
function getPreviousArticles(e) {
    e.preventDefault();
    jQuery.ajax({
        url: "/api/reports/news",
        method: 'get',
        data: {
            offset: (offset - 10)
        },
        success: function (result) {
            console.log("offset = " + result.offset);
            console.log("offset = " + offset);
            
            console.log(result);
            if (result.offset == 5) {
                $('#p').addClass("disabled");
            } else {
                $('#p').removeClass("disabled");
            }
            offset = result.offset;
            $('#n').removeClass("disabled");
            $('tbody').replaceWith(result.view);
        }
    });
}
