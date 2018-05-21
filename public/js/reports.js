'use strict';
let offset = 5;
let offsetComments = 5;
function createPaginationHandlers(){
    let usersPaginationItems = [...document.querySelectorAll('.page-link')]
    if(usersPaginationItems!=null){
        usersPaginationItems.forEach(pagItem=>{
            pagItem.addEventListener('click',usersChangePage)
        })
    }
}
createPaginationHandlers();
function usersChangePage(e){
    let pageNumber = e.target.parentNode.value;
    if(pageNumber != NaN){
        if(pageNumber<=0)return;
        if($('#TAB_news').hasClass('active')){
            offset = 5*(pageNumber-1);
            
            getNextArticles(e);
          
        }else {
           
            offsetComments = 5*(pageNumber-1);

            getNextComments(e);
        }
        
    }
}
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
            
           $('#navNews').replaceWith(result.nav_news);
            $('#tbodyNews').replaceWith(result.view);
            createPaginationHandlers();
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
            
            $('#navComments').replaceWith(result.nav_comments);
            $('#tbodyComments').replaceWith(result.view);
            createPaginationHandlers();
        }
    });
}
