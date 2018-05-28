
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
            
            var btn = "<button type=\"button\" class=\"btn btn-primary\" onclick=\"startFollowing( '" + username + "' )\">Follow</button>";
            document.querySelector("div#following_btn").innerHTML = btn;
        }
    });

}

function createPaginationHandlers(){
    let articlesPaginationItems = [...document.querySelectorAll('ul#profile_articles_pag li .page-link')]
    if(articlesPaginationItems!=null){
        articlesPaginationItems.forEach(pagItem=>{
            pagItem.addEventListener('click',articlesChangePage)
        })
    }

    let followingPaginationItems = [...document.querySelectorAll('ul#profile_following_pag li .page-link')]
    if(followingPaginationItems!=null){
        followingPaginationItems.forEach(pagItem=>{
            pagItem.addEventListener('click',followingChangePage)
        })
    }
}

function articlesChangePage(e){

    let pageNumber = e.target.parentNode.getAttribute("data-value");
    if(pageNumber != NaN){
        if(pageNumber<=0)return;
        
        let username = $('input#user')[0].getAttribute("value");
        jQuery.ajax({
            url: "/api/users/" + username + "/articles",
            method: 'get',
            data: {
                offset: Math.floor((pageNumber - 1) * 5)
            },
            success: function (result) {
                $('#my_articles').empty();
                $('#my_articles').append(result.view);
                let elem = e.target.parentNode;

                let pag = document.querySelectorAll("#profile_articles_pag li");
                for (let i=0; i<pag.length; i++) {
                    pag[i].classList.remove("active");
                }

                if(e.target.getAttribute('data-value') == 'first') {
                    elem.nextElementSibling.classList.add('active');
                } else if(e.target.getAttribute('data-value') == 'last') {
                    elem.previousElementSibling.classList.add('active');
                } else {
                    elem.classList.add('active');
                }
                
                createPaginationHandlers();
            }
        });
    }
}

function followingChangePage(e){
    
    let pageNumber = e.target.parentNode.getAttribute("data-value");
    
    if(pageNumber != NaN){
        if(pageNumber<=0)return;
        
        let username = $('input#user')[0].getAttribute("value");
        console.log("ok");
        jQuery.ajax({
            url: "/api/users/" + username + "/following",
            method: 'get',
            data: {
                offset: Math.floor((pageNumber - 1) * 5)
            },
            success: function (result) {
                $('#my_following_users').empty();
                $('#my_following_users').append(result.view);
                let elem = e.target.parentNode;

                let pag = document.querySelectorAll("#profile_following_pag li");
                for (let i=0; i<pag.length; i++) {
                    pag[i].classList.remove("active");
                }

                if(e.target.getAttribute('data-value') == 'first') {
                    elem.nextElementSibling.classList.add('active');
                } else if(e.target.getAttribute('data-value') == 'last') {
                    elem.previousElementSibling.classList.add('active');
                } else {
                    elem.classList.add('active');
                }
                
                createPaginationHandlers();
            }
        });
    }
}

createPaginationHandlers();