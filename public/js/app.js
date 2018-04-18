console.log('app.js included');

let previews_offset = 0;
function addEventListeners() {
  let availableSections = document.querySelectorAll('.section_item');
  [].forEach.call(availableSections, function (section) {
    section.addEventListener('click', sendSelectSection);
  });
  let scrollNews = document.querySelector('#scrollNewsPreview')
  if (scrollNews != null) {
    document.querySelector('#scrollNewsPreview').addEventListener('click', sendShowMorePreviews);
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

function sendSelectSection(event) {
  previews_offset = 0;
  let section_name = event.currentTarget.name;
  console.log("section = "+ section_name);
  document.querySelector('.current_section').innerHTML = event.currentTarget.innerHTML;
  sendAjaxRequest('post', '/api/news/section/' + section_name, null, listSectionHandler);
  console.log("offset = " + previews_offset);
}

function listSectionHandler() {
  let response = JSON.parse(this.responseText);
  let news_preview_div = document.getElementById('news_item_preview_list');
  while (news_preview_div.hasChildNodes()) {
    news_preview_div.removeChild(news_preview_div.lastChild);
  }
  news_preview_div.innerHTML = response['news'];
}

function sendShowMorePreviews(event) {
  previews_offset += 10;
  let section_name = document.querySelector('.current_section').innerText.trim();
  if (section_name == "All") {
    sendAjaxRequest('post', '/api/news/section/All/scroll', { next_preview: previews_offset }, showMorePreviewsHandler);
  } else {
    sendAjaxRequest('post', '/api/news/section/' + section_name + '/scroll', { next_preview: previews_offset }, showMorePreviewsHandler);
  }
  console.log("offset = " + previews_offset);
}

function showMorePreviewsHandler() {
  let response = JSON.parse(this.responseText);

  if (response['news'].length == 0) {
    console.log("There's no more news to load.");
    // $('#placeComments').append("<div class=\"alert alert-dismissible alert-secondary\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>Sorry!</strong> No more comments at the moment!</div>");
  }
  document.getElementById('news_item_preview_list').innerHTML += response['news'];
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

function onScrollComments() {
  
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
        document.getElementById("commentNo"+result).outerHTML = "";
      }
    });
  });
}