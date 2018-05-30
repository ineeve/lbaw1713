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
    if (method.toLowerCase() != 'get') {
        request.setRequestHeader('Content-Type','application/x-www-form-urlencoded')
        request.setRequestHeader("X-CSRF-TOKEN", csrf);
    }
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

    /**
     * Show 'add badge' form.
     */
    $('body').on('click', '#badges-list a', function(e) {
        e.preventDefault();
        showAddBadgeForm(e.currentTarget);
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

/**
 * Replaces badge card with an aesthetically similar badge edit form.
 * @param {*} badgeElem JS DOM element of a badge card.
 * @param {Object} badge Badge.
 */
function showBadgeEditForm(badgeElem, badge, submitHandler, cancelHandler) {
    let form = document.createElement('form');
    form.className = 'card mt-3 mr-3';
    form.style = 'width: 16rem;';
    form.id = badge.id;
    form.onsubmit = submitHandler;

    let cardHeader = createBadgeFormHeader(badge);
    form.appendChild(cardHeader);

    let briefDiv = createBadgeFormBrief(badge);
    form.appendChild(briefDiv);

    let reqsList = createBadgeFormReqsList(badge);
    form.appendChild(reqsList);

    let buttons = createBadgeFormButtons(cancelHandler);
    form.appendChild(buttons);

    badgeElem.parentNode.replaceChild(form, badgeElem);
}

function createBadgeFormHeader(badge) {
    let cardHeader = document.createElement('h3');
    cardHeader.className = 'card-header d-flex justify-content-between align-items-center';
    let nameInput = document.createElement('input');
    nameInput.type = 'text';
    nameInput.className = 'form-control';
    nameInput.placeholder = 'Name';
    nameInput.name = 'name';
    nameInput.value = badge.name;
    cardHeader.appendChild(nameInput);
    return cardHeader;
}

function createBadgeFormBrief(badge) {
    let briefDiv = document.createElement('div');
    briefDiv.className = 'card-body';
    let briefInput = document.createElement('input');
    briefInput.className = 'card-title m-0 form-control';
    briefInput.name = 'brief';
    briefInput.placeholder = 'Brief';
    briefInput.value = badge.brief;
    briefDiv.appendChild(briefInput);
    return briefDiv;
}

function createBadgeFormReqsList(badge) {
    let reqsList = document.createElement('ul');
    reqsList.className = 'list-group list-group-flush';

    let votesItem = document.createElement('li');
    votesItem.className = 'list-group-item d-flex align-items-center justify-content-between';
    votesItem.innerHTML = 'Votes <input class="form-control" style="max-width:4rem;" type="number" name="votes" value="'+badge.votes+'">';

    let commentsItem = document.createElement('li');
    commentsItem.className = 'list-group-item d-flex align-items-center justify-content-between';
    commentsItem.innerHTML = 'Comments <input class="form-control" style="max-width:4rem;" type="number" name="comments" value="'+badge.comments+'">';

    let articlesItem = document.createElement('li');
    articlesItem.className = 'list-group-item d-flex align-items-center justify-content-between';
    articlesItem.innerHTML = 'Articles <input class="form-control" style="max-width:4rem;" type="number" name="articles" value="'+badge.articles+'">';

    reqsList.appendChild(votesItem);
    reqsList.appendChild(commentsItem);
    reqsList.appendChild(articlesItem);
    return reqsList;
}

function createBadgeFormButtons(cancelHandler) {
    let btnsDiv = document.createElement('div');
    btnsDiv.className = 'card-body d-flex justify-content-end';

    let saveBtn = document.createElement('button');
    saveBtn.textContent = 'Save';
    saveBtn.type = 'submit';
    saveBtn.className = 'btn btn-primary ml-2';
    let cancelBtn = document.createElement('button');
    cancelBtn.textContent = 'Cancel';
    cancelBtn.onclick = cancelHandler;
    cancelBtn.className = 'btn btn-secondary';

    btnsDiv.appendChild(cancelBtn);
    btnsDiv.appendChild(saveBtn);
    return btnsDiv;
}

function submitAddBadgeForm(event) {
    event.preventDefault();
    let form = event.target;
    let badgeId = form.id;

    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    $.ajax({
        url: '/adm/badges',
        method: 'post',
        data: $('form#'+badgeId).serialize(),
        success: function(view) {
            let addBadgeElem = document.createElement('a');
            addBadgeElem.href='';
            addBadgeElem.className = 'd-flex flex-column align-items-center nounderline mt-3 mr-3';
            addBadgeElem.style="min-width:16rem;";
            addBadgeElem.innerHTML = '<i class="fas fa-plus-circle fa-fw medium-big-icon"></i>'
                                    + '<p class="m-0">Add Badge</p>'
            form.parentNode.appendChild(addBadgeElem);
            form.outerHTML = view;
        },
        error: function(xhr) {
            console.log(xhr);
        }
    })
}

function submitEditBadgeForm(event) {
    event.preventDefault();
    let form = event.target;
    let badgeId = form.id;

    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    $.ajax({
        url: '/adm/badges/'+badgeId,
        method: 'put',
        data: $('form#'+badgeId).serialize(),
        success: function(view) {
            form.outerHTML = view;
        },
        error: function(xhr) {
            console.log(xhr);
        }
    })
}

function cancelAddBadgeForm(e) {
    e.preventDefault();
    let form = e.target.parentNode.parentNode;
    let addBadgeElem = document.createElement('a');
    addBadgeElem.href='';
    addBadgeElem.className = 'd-flex flex-column align-items-center nounderline mt-3 mr-3';
    addBadgeElem.style="min-width:16rem;";
    addBadgeElem.innerHTML = '<i class="fas fa-plus-circle fa-fw medium-big-icon"></i>'
                            + '<p class="m-0">Add Badge</p>'
    form.parentNode.replaceChild(addBadgeElem, form);
}

function cancelEditBadgeForm(e) {
    e.preventDefault();
    let form = e.target.parentNode.parentNode;
    let badgeId = form.id;

    $.ajax({
        url: '/adm/badges/'+badgeId,
        method: 'get',
        success: function(view) {
            form.outerHTML = view;
        },
        error: function(xhr) {
            console.log(xhr);
        }
    })
}

function createEmptyBadge() {
    return {name: '', brief: '', votes: 0, articles: 0, comments: 0};
}

function showAddBadgeForm(addBadgeElem) {
    showBadgeEditForm(addBadgeElem, createEmptyBadge(), submitAddBadgeForm, cancelAddBadgeForm);
}

{/* <div class="card mt-3 mr-3" style="width:16rem;">
  <h3 class="card-header d-flex justify-content-between align-items-center">{{$badge->name}} <i class="fa fa-edit fa-fw float-right" onclick="showBadgeEditForm(this.parentNode.parentNode, {{json_encode($badge)}})"></i></h3>
  <div class="card-body">
    <h5 class="card-title m-0">{{$badge->brief}}</h5>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">Votes <span class="float-right">{{$badge->votes}}</span></li>
    <li class="list-group-item">Comments <span class="float-right">{{$badge->comments}}</span></li>
    <li class="list-group-item">News <span class="float-right">{{$badge->articles}}</span></li>
  </ul>
</div> */}