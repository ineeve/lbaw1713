let users_table = document.getElementById("usersTable")
let last_row_selected = null;
let csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
let modalCloseBtn = document.querySelector('#banModal .close');
let itemsPerPage = 10;
let currentPage = 1;
let searchToken = "";
let filterBy = [];
const USERS_TABLE_ROUTE = "/adm/users/table";

function sendRequest(method,url,handler,body=null){
    let request = new XMLHttpRequest();
    request.open(method,url);
    request.setRequestHeader('Content-Type','application/x-www-form-urlencoded')
    request.setRequestHeader("X-CSRF-TOKEN", csrf);
    request.onload = handler;
    request.send(body);
}

function createAllListeners(){
    createPaginationListeners();
    createUserActionListeners();
    createModalBanFormListener();
    createSearchByUsernameListener();
    createLeftSectionsListeners();
}

function createUserActionListeners(){
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
function createModalBanFormListener(){
    let modal = document.querySelector('#banDescriptionForm');
    if (modal){
        modal.addEventListener('submit',banSubmitHandler)
    }
}
function createSearchByUsernameListener(){
    let searchInput = document.querySelector('#searchUsername');
    if(searchInput){
        searchInput.addEventListener('input',searchUsernameHandler);
    }
}

function createPaginationListeners(){
    let usersPaginationItems = [...document.querySelectorAll('.page-link')]
    if(usersPaginationItems!=null){
        usersPaginationItems.forEach(pagItem=>{
            pagItem.addEventListener('click',usersChangePage)
        })
    }
}

function createLeftSectionsListeners(){
    let sections_list = document.getElementById("sections_list");
    if (sections_list != null){
        let section_items = [...sections_list.querySelectorAll('.nav-item')];
        section_items.forEach(i => i.addEventListener('click',changeSectionHandler))
    }
}

function replaceTabContent(tabID, newContent){
    let tab = document.getElementById(tabID);
    tab.innerHTML = newContent;
}

function changeSectionHandler(e){
    console.log('changing section')
    let section_name = e.target.innerText.trim();
    if (section_name.length == 0){
        section_name = e.target.parentNode.innerText.trim();
    }
    console.log("Selected section: " + section_name);
    switch(section_name){
        case 'Categories':
        sendRequest('get',"/adm/categories", replaceCategoriesTab);
        break;
        case 'Badges':
        sendRequest('get',"/adm/badges", replaceBadgesTab);
        break;
        case 'Users':
        sendRequest('get',"/adm/users", replaceUsersTab);
        break;
    }
}


function replaceUsersTab(){
    if (this.responseText != null && this.status == 200){
        replaceTabContent('users_tab',this.responseText);
    }else{
        console.log(this.responseText)
    }
}
function replaceCategoriesTab(){
    if (this.responseText != null && this.status == 200){
        replaceTabContent('categories_tab',this.responseText);
    }else{
        console.log(this.responseText)
    }
}
function replaceBadgesTab(){
    if (this.responseText != null && this.status == 200){
        replaceTabContent('badges_tab',this.responseText);
    }else{
        console.log(this.responseText)
    }
}




function searchUsernameHandler(e){
    searchToken = e.target.value;
    let url = USERS_TABLE_ROUTE + "?pageNumber=" + currentPage + "&itemsPerPage=" + itemsPerPage;
    if (searchToken.length > 0){
        sendRequest('get',url + "&searchToken="+searchToken,replaceUsersTable);
    } else{
        sendRequest('get',url,replaceUsersTable);
    }
    currentPage=1;

}

function banSubmitHandler(e){
    e.preventDefault();
    let textarea = e.target.querySelector('#banDescriptionTextarea');
    let description = textarea.value;
    let username = last_row_selected.id;
    let body="reason="+description;
    textarea.value = '';
    modalCloseBtn.click();
    sendRequest('post','/adm/users/'+username+'/ban', banCallback, body);
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

/**
 * Change user row to the banned color and replace the ban button by the unban one.
 */
function banUserRow() {
    
    let userRow = last_row_selected;
    let banBtn = $('#'+last_row_selected.id + ' .ban')[0];

    userRow.classList.add('table-danger');
    banBtn.outerHTML = '<i class="text-danger fas fa-door-open fa-fw unban" data-toggle="tooltip" title="Unban user"></i>';
}

function banCallback() {
    banUserRow();
    if (this.status == 200) {
        let msg = JSON.parse(this.responseText).message;
        showSuccessMsg(msg);
    } else {
        showFailureMsg('Failed to ban user.');
    }
}

function updateUserRow(){
    if(this.status == 200){
        last_row_selected.innerHTML = this.responseText;
    }
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

function usersChangePage(e){
    currentPage = e.target.parentNode.getAttribute("data-value");
    let url = USERS_TABLE_ROUTE + "?pageNumber=" + currentPage + "&itemsPerPage=" + itemsPerPage;
    let numberOfPages = Math.ceil(total.getAttribute('value')/itemsPerPage);
    if(currentPage != NaN){
        if(currentPage<=0)return;
        if (searchToken.length > 0){
            url+="&searchToken="+searchToken
        }
        sendRequest('get',url, replaceUsersTable);
    }
}

function htmlToElement(html) {
    var template = document.createElement('template');
    html = html.trim(); // Never return a text node of whitespace as the result
    template.innerHTML = html;
    return template.content.firstChild;
}


function replacePagination(){
    let paginationNav = document.querySelector('#paginationNav');
    if(this.responseText == null || this.status != 200) return;
    paginationNav.innerHTML = this.responseText;
    createPaginationListeners();
}

function replaceUsersTable(){
    if(this.responseText==null || this.status!=200)return;
    let mainColumn = users_table.parentNode;
    mainColumn.removeChild(users_table);
    mainColumn.appendChild(htmlToElement(this.responseText));
    users_table = mainColumn.querySelector('#usersTable');
    createUserActionListeners();
    let total = document.querySelector('#total');
    let numberOfPages = Math.ceil(total.getAttribute('value')/itemsPerPage);
    sendRequest('get',"/pagination?pageNumber="+currentPage+"&numberOfPages=" + numberOfPages, replacePagination);
}

createAllListeners();

$(document).ready(function() {
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
    
    /**
     * Unban user.
     */
    $('body').on('click', '.unban', function(e) {
        updateLastRowSelected(e);
        let username = last_row_selected.id;
        let banBtn = e.target;
        let userRow = banBtn.parentNode.parentNode;
        console.log(e);
        $.ajax({
            url: '/adm/users/'+username+'/unban',
            method: 'post',
            success: function(msg) {
                userRow.classList.remove('table-danger');
                banBtn.outerHTML = '<i class="text-danger fas fa-ban fa-fw ban" data-toggle="modal" data-target="#banModal" title="Ban user"></i>';
                showSuccessMsg(msg);
            },
            error: function(xhr) {
                showFailureMsg('Failed to unban user.');
                console.log(xhr);
            }
        })
    })
})

function showSuccessMsg(msg) {
    showMsg(msg, 'success');
}

function showFailureMsg(msg) {
    showMsg(msg, 'danger');

}

/**
 * 
 * @param {*} msg Message to show.
 * @param {*} type One of Bootstrap's alert-* types.
 */
function showMsg(msg, type) {
    let alertDiv = document.getElementById('alert-messages');
    let divElement = document.createElement('div');
    let closeBtn = getCloseBtn();
    divElement.setAttribute('class','alert alert-'+type);
    divElement.innerText = msg;
    divElement.appendChild(closeBtn);
    alertDiv.appendChild(divElement);
}

/**
 * Sets route of category edition form for clicked category.
 * @param {number} categoryId 
 */
function setEdit(categoryId, categoryName, categoryIcon) {
    changeIconPreview(categoryIcon);
    let form = $('#editMenu form')[0];
    form.action = "/adm/categories/" + categoryId;
    form.name.value = categoryName;
    form.icon.value = categoryIcon;
}

function changeIconPreview(newIcon) {
    let iconPreview = $('#editMenu .icon-preview i')[0];
    iconPreview.style.color = '#373a3c';
    removeClassByPrefix(iconPreview, 'fa');
    let newIconClasses = newIcon.split(' ');
    for (let i = 0; i < newIconClasses.length; i++) {
        iconPreview.classList.add(newIconClasses[i]);
    }
}

function removeClassByPrefix(el, prefix) {
    for (let i = 0; i < el.classList.length; i++) {
        if (el.classList[i].substr(0, prefix.length) == prefix) {
            el.classList.remove(el.classList[i]);
            i--;
        }
    }
}