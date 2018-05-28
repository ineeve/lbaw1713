console.log('app.js included');

let previews_offset = 10;
let comment_id;
function addEventListeners() {
  let scrollNews = document.querySelector('.previews #scroll')
  if (scrollNews != null) {
    document.querySelector('.previews #scroll').addEventListener('click', sendShowMorePreviews);
  }
  let reportModalForm = document.querySelector('#reportModalForm');
  if (reportModalForm != null){
    reportModalForm.addEventListener('submit', submitReportForm);
  }
}

function selectComment(id){
  comment_id = id;
}

function submitReportForm(e){
  e.preventDefault();
  console.log(`submiting report for news:${news_id}; comment:${comment_id}`);
  let parameters = {brief: document.querySelector('#report-description-area').value};
  let csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  let reasonsGroup = document.querySelector('#reasonsGroup');
  parameters.reasons = Array.from(reasonsGroup.querySelectorAll('.active')).map(button => button.innerText.trim()).join(",");
  let url = `/news/${news_id}`;
  if (comment_id != null){
    url += `/comments/${comment_id}`;
  }
  url += "/report";
  console.log('url:' + url);
  let request = new XMLHttpRequest;
  request.onload = handleReportSubmit;
  request.open("POST",url);
  request.setRequestHeader('Content-type','application/x-www-form-urlencoded');
  request.setRequestHeader('X-CSRF-TOKEN', csrf);
  request.send(encodeForAjax(parameters));
  comment_id = null;
}

function handleReportSubmit(e){
  let text = e.target.responseText;
  let parameters = {brief: document.querySelector('#report-description-area').value};
  let reasonsGroup = document.querySelector('#reasonsGroup');
  parameters.reasons = Array.from(reasonsGroup.querySelectorAll('.active')).forEach(btn => {
    btn.classList.remove('active');
  });
  let briefTextarea = document.getElementById("report-description-area");
  briefTextarea != null ? briefTextarea.value = '' : null;
  if (text != null){
    let response = JSON.parse(text);
    if (response){
      let closeBtn = document.querySelector("#closeReportModal");
      closeBtn.click();
    } else {
      alert('error');
    }
  }
}

function encodeForAjax(data) {
  if (data == null) return null;
  return Object.keys(data).map(function (k) {
    return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
  }).join('&');
}

function sendAjaxRequest(method, url, data, handler) {
  let request = new XMLHttpRequest();
  request.open(method, url, true);
  request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  request.addEventListener('load', handler);
  request.send(encodeForAjax(data));
}

function sendShowMorePreviews(event) {
  let section_name = document.querySelector('.current_section');
  let order = document.querySelector("#sort-option").getAttribute('data-name');
  if (section_name != null){
    section_name = section_name.innerText.trim();
    sendAjaxRequest('GET', '/api/news/section/' + section_name + '/order/' + order + "/offset/" + previews_offset, null, showMorePreviewsHandler);
  } else {
    searchText = document.querySelector("#searchedText").innerText.trim();
    sendAjaxRequest('GET','/api/news/order/' + order + '/offset/' + previews_offset + "?searchText=" + searchText, null, showMorePreviewsHandler)
  }
  
  console.log("offset = " + previews_offset);
}

function showMorePreviewsHandler() {
  if (this.responseText != null && this.status == 200){
    console.log(this);
    if (this.responseText.length == 0) {
      $('#allNews').append("<div class=\"alert alert-dismissible alert-secondary\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>Sorry!</strong> No more news at the moment!</div>");
    }
    previews_offset += 10;
    document.getElementById('news_item_preview_list').innerHTML += this.responseText;
  }
}

function getUserVote() {
  let meta_tag = document.querySelector('meta[name="news_id"]');
  if (meta_tag != null) {
    let news_id = meta_tag.content;
    if (news_id != null) {
      sendAjaxRequest("get", "/api/news/" + news_id + "/vote", null, getVoteHandler);
    }
  }
}

function getVoteHandler(e) {
  let highlight_color = '#428bca';
  if (e.target != null) {
    if (e.target.responseText != null) {
      let response = JSON.parse(e.target.responseText);
      console.log(response);
      if (response['value'] != 'null') {
        if (response['value'] == 'up') {
          document.getElementById('upvote').style.color = highlight_color;
        } else {
          document.getElementById('downvote').style.color = highlight_color;
        }
      }
    }
  }
}

function voteHandler(e) {
  let highlight_color = '#428bca';
  let upvoteElement = document.getElementById('upvote');
  let downvoteElement = document.getElementById('downvote');
  let votesCounter = document.getElementById('votesCounter');
  if (e.target != null) {
    if (e.target.responseText != null) {
      console.log(e.target.responseText);
      let response = JSON.parse(e.target.responseText);
      let selectedElement = upvoteElement;
      let notSelectedElement = downvoteElement;
      let action = response['action'];
      votesCounter.innerHTML = response['votes'];
      if (response['value'] == 'down') {
        selectedElement = downvoteElement;
        notSelectedElement = upvoteElement;
      }
      if (action == 'insert') {
        selectedElement.style.color = highlight_color;
      } else if (action == 'update') {
        selectedElement.style.color = highlight_color;
        notSelectedElement.style.color = 'inherit';
      } else if (action == 'delete') {
        selectedElement.style.color = 'inherit';
      } else if (action == 'none') {
        alert('You cannot vote on your own news');
      }
    }
  }
}

function downvote(newsId) {
  let data = {
    type: 'false'
  }
  sendAjaxRequest("post", "/api/news/" + newsId + "/vote", data, voteHandler);
}

function upvote(newsId) {
  let data = {
    type: 'true'
  }
  sendAjaxRequest("post", "/api/news/" + newsId + "/vote", data, voteHandler);
}

addEventListeners();
getUserVote();


function createEditCommentForm(comment_body) {
  let form = document.createElement('form');
  form.onsubmit = editComment;
  form.className = '';
  form.innerHTML = '<div class="form-group">';
  form.innerHTML += '<textarea name="text" class="form-control">'+comment_body+'</textarea>';
  form.innerHTML += '</div>';
  form.innerHTML += '<button name="cancel" class="btn btn-secondary">Cancel</button>';
  form.innerHTML += '<button type="submit" class="btn btn-primary editComment">Edit</button>';

  return form;
}

/**
   * Submits edit form, replacing it with the new comment body.
   * e.target is the edit form.
   * Request returns object with new comment's ID and body.
   */
function editComment(e) {
  e.preventDefault();
  
  let comment_id = e.target.parentElement.getAttribute('comm-id');
  let news_id = e.target.parentElement.getAttribute('news-id');
  let comment_body = e.target[0].value;

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  jQuery.ajax({
    url: '/news/'+news_id+'/comments/'+comment_id,
    method: 'patch',
    data: {
      text: comment_body
    },
    success: function (newComm) {
      console.log('Edited '+"commentNo"+newComm.id);
      $("#commentNo"+newComm.id + " .commentBody")[0].innerHTML = newComm.body;
    },
    error: function(xhr) {
      console.log('Failed to edit comment');
      $("#commentNo"+newComm.id + " .commentBody")[0].innerHTML = "";
    }
  });
}

function onScrollComments() {
  // Replaces comment body by the edit form.
  jQuery('.editCommentForm').click(function (e) {
    e.preventDefault();
    let commentBody = $("#commentNo" + e.target.name + " .commentBody").text();
    let form = createEditCommentForm(commentBody);
    $("#commentNo"+e.target.name + " .commentBody").empty();
    $("#commentNo"+e.target.name + " .commentBody").append(form);
  });

  /**
   * Submits edit form, replacing it with the new comment body.
   * Request returns object with new comment's ID and body.
   */
  /*jQuery('.editComment').click(function (e) {
    e.preventDefault();
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    jQuery.ajax({
      url: e.target.href,
      method: 'patch',
      success: function (newComm) {
        console.log('Edited '+"commentNo"+newComm.id);
        $("#commentNo"+newComm.id + " .commentBody").outerHTML = newComm.body;
      }
    });
  });*/

  jQuery('.deleteComment').click(function (e) {
    e.preventDefault();
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    jQuery.ajax({
      url: e.target.href,
      method: 'delete',
      success: function (result) {
        console.log('Deleted '+"commentNo"+result);
        document.getElementById("commentNo"+result).remove();
      }
    });
  });
}