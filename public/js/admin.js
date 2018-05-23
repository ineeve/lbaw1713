let users_tab = document.getElementById("users_tab")
let last_row_selected = null;
let csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
let modalCloseBtn = document.querySelector('#banModal .close');

function createUserActionHandlers(){
    let banItems = [...document.querySelectorAll('.ban')];
    let promoteItems = [...document.querySelectorAll('.promote')];
    let demoteItems = [...document.querySelectorAll('.demote')];
    if(banItems != null){
        banItems.forEach(i=>i.addEventListener('click',updateLastRowSelected))
    }
    if(promoteItems != null){
        promoteItems.forEach(i=>i.addEventListener('click',promoteUser))
    }
    if(demoteItems != null){
        demoteItems.forEach(i=>i.addEventListener('click',demoteUser))
    }
}
function createModalBanFormHandler(){
    let modal = document.querySelector('#banDescriptionForm');
    if (modal){
        modal.addEventListener('submit',banSubmitHandler)
    }
}

function banSubmitHandler(e){
    e.preventDefault();
    let textarea = e.target.querySelector('#banDescriptionTextarea');
    let description = textarea.value;
    let username = last_row_selected.id;
    let body="reason="+description;
    textarea.value = '';
    modalCloseBtn.click();
    sendRequest('post','/adm/users/'+username+'/ban', banCallback, body)
}

function getCloseBtn(){
    let closeBtn = document.createElement('button');
    closeBtn.setAttribute('type','button');
    closeBtn.setAttribute('class','close');
    closeBtn.setAttribute('data-dismiss','alert');
    closeBtn.setAttribute('aria-label','Close');
    let span = document.createElement('span');
    span.setAttribute('aria-hidden','true');
    span.innerHTML='&times;';
    closeBtn.appendChild(span);
    return closeBtn;
}

function banCallback(){
    let alertDiv = document.getElementById('alert-messages');
    let divElement = document.createElement('div');
    let closeBtn = getCloseBtn();
    
    if(this.status == 200){
        last_row_selected.innerHTML = '';
        let response = JSON.parse(this.responseText);
        if(response != null){
            divElement.setAttribute('class','alert alert-success');
            divElement.innerText = response.message;
            
        }
    }else{
        divElement.setAttribute('class','alert alert-danger');
        divElement.innerHTML = '<strong>Oh snap!</strong> Try again latter';
    }
    divElement.appendChild(closeBtn);
    alertDiv.appendChild(divElement);
}
function updateUserRow(){
    if(this.status == 200){
        last_row_selected.innerHTML = this.responseText;
    }
}

function sendRequest(method,url,handler,body=null){
    let request = new XMLHttpRequest();
    request.open(method,url);
    request.setRequestHeader('Content-Type','application/x-www-form-urlencoded')
    request.setRequestHeader("X-CSRF-TOKEN", csrf);
    request.onload = handler;
    request.send(body);
}

function updateLastRowSelected(event){
    last_row_selected = event.target.parentNode.parentNode;
}
function promoteUser(){
    updateLastRowSelected(event)
    let id = last_row_selected.id;
    console.log('promoting user:' + id);
    sendRequest('put','/adm/users/'+id+'/promote',updateUserRow)

}
function demoteUser(){
    updateLastRowSelected(event)
    id = last_row_selected.id;
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
createModalBanFormHandler();