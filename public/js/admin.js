let users_tab = document.getElementById("users_tab")
let last_row_selected = null;
let csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

function createUserActionHandlers(){
    let banItems = [...document.querySelectorAll('.ban')];
    let promoteItems = [...document.querySelectorAll('.promote')];
    let demoteItems = [...document.querySelectorAll('.demote')];
    if(banItems != null){
        banItems.forEach(i=>i.addEventListener('click',banUser))
    }
    if(promoteItems != null){
        promoteItems.forEach(i=>i.addEventListener('click',promoteUser))
    }
    if(demoteItems != null){
        demoteItems.forEach(i=>i.addEventListener('click',demoteUser))
    }
}
function updateUserRow(){
    if(this.status == 200){
        last_row_selected.innerHTML = this.responseText;
    }
}

function sendRequest(method,url,handler){
    let request = new XMLHttpRequest();
    request.open(method,url);
    request.setRequestHeader('Content-Type','application/x-www-form-urlencoded')
    request.setRequestHeader("X-CSRF-TOKEN", csrf);
    request.onload = handler;
    request.send();
}

function banUser(){
    last_row_selected = event.target.parentNode.parentNode;
    let id = last_row_selected.id;
    console.log('banning user:' + id);
    sendRequest('put','/adm/users/'+id+'/ban',updateUserRow)
}
function promoteUser(){
    last_row_selected = event.target.parentNode.parentNode;
    let id = last_row_selected.id;
    console.log('promoting user:' + id);
    sendRequest('put','/adm/users/'+id+'/promote',updateUserRow)

}
function demoteUser(){
    last_row_selected = event.target.parentNode.parentNode;
    id = event.target.parentNode.parentNode.id;
    console.log('demoting user' + id);
    sendRequest('put','/adm/users/'+id+'/demote',updateUserRow)
}



function createPaginationItems(){
    let usersPaginationItems = [...document.querySelectorAll('.page-link')]
    if(usersPaginationItems!=null){
        usersPaginationItems.forEach(pagItem=>{
            pagItem.addEventListener('click',usersChangePage)
        })
    }
}

function usersChangePage(e){
    let pageNumber = e.target.parentNode.value;
    if(pageNumber != NaN){
        if(pageNumber<=0)return;
        let request = new XMLHttpRequest()
        request.onload = replaceUsersTab
        request.open("get","/adm/users?pageNumber="+pageNumber+"&itemsPerPage="+10)
        request.send()
    }
}

function replaceUsersTab(){
    console.log(this)
    if(this.responseText==null || this.status!=200)return;
    users_tab.innerHTML = this.responseText;
    createPaginationItems();
    createUserActionHandlers();
}

createPaginationItems();
createUserActionHandlers();