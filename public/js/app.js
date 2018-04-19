console.log('app.js included');

let previews_offset = 10;
function addEventListeners() {
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

function sendShowMorePreviews(event) {
  let section_name = document.querySelector('.current_section').innerText.trim();
  let order = document.querySelector("#sort-option").getAttribute('name');
  console.log("Getting news for section: " + section_name + "; order:" + order + " ;offset:" + previews_offset);
  sendAjaxRequest('GET', '/api/news/section/' + section_name + '/order/' + order + "/offset/" + previews_offset, null, showMorePreviewsHandler);
  console.log("offset = " + previews_offset);
}

function showMorePreviewsHandler() {
  if (this.responseText != null && this.status == 200){
    console.log(this);
    if (this.responseText.length == 0) {
      console.log("There's no more news to load.");
      // $('#placeComments').append("<div class=\"alert alert-dismissible alert-secondary\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>Sorry!</strong> No more comments at the moment!</div>");
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