'use strict';
// TODO: put initialoffset dynamic
let offset = 5;
let offsetComments = 5;

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
            $('#tbodyNews').replaceWith(result.view);
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
            $('#tbodyNews').replaceWith(result.view);
        }
    });
}
function getNextComments(e) {
    e.preventDefault();
    jQuery.ajax({
        url: "/api/reports/comments",
        method: 'get',
        data: {
            offset: offsetComments
        },
        success: function (result) {
            console.log("offset = " + result.offset);
            console.log("offset = " + offsetComments);
            
            console.log(result);
            if (result.offset == 0) {
                $('#pComments').addClass("disabled");
            } else {
                $('#pComments').removeClass("disabled");
            }
            if ((result.offset-offsetComments) >= 5) {
                offsetComments = result.offset;
                $('#nComments').removeClass("disabled");
            } else {
                $('#nComments').addClass("disabled");
            }
            $('#tbodyComments').replaceWith(result.view);
        }
    });
}
function getPreviousComments(e) {
    e.preventDefault();
    jQuery.ajax({
        url: "/api/reports/comments",
        method: 'get',
        data: {
            offset: (offsetComments - 10)
        },
        success: function (result) {
            console.log("offset = " + result.offset);
            console.log("offset = " + offsetComments);
            
            console.log(result);
            if (result.offset == 5) {
                $('#pComments').addClass("disabled");
            } else {
                $('#pComments').removeClass("disabled");
            }
            offsetComments = result.offset;
            $('#nComments').removeClass("disabled");
            $('#tbodyComments').replaceWith(result.view);
        }
    });
}
