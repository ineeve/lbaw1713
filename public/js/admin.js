let users_tab = document.getElementById("users_tab")

function createPaginationHandlers(){
    let usersPaginationItems = [...document.querySelectorAll('.page-link')]
    if(usersPaginationItems!=null){
        usersPaginationItems.forEach(pagItem=>{
            pagItem.addEventListener('click',usersChangePage)
        })
    }
}

function usersChangePage(e){
    let pageNumber = parseInt(e.target.text);
    if(pageNumber != NaN){
        if(pageNumber<=0)return;
        let request = new XMLHttpRequest()
        request.onload = replaceUsersTab
        request.open("get","/admin/users?pageNumber="+pageNumber+"&itemsPerPage="+10)
        request.send()
    }
}

function replaceUsersTab(){
    console.log(this)
    if(this.responseText==null || this.status!=200)return;
    users_tab.innerHTML = this.responseText;
    createPaginationHandlers();
}

createPaginationHandlers();