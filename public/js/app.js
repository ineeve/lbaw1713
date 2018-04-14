console.log('app.js included');

let previews_offset = 0;
function addEventListeners() {
  let availableSections = document.querySelectorAll('.section_item');
  [].forEach.call(availableSections, function(section) {
    section.addEventListener('click', sendSelectSection);
  });

  document.querySelector('#scrollNewsPreview').addEventListener('click', sendShowMorePreviews);
}

function encodeForAjax(data) {
  if (data == null) return null;
  return Object.keys(data).map(function(k){
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
  let section_name = event.target.name;
  document.querySelector('.current_section').innerHTML = event.target.innerHTML;
  sendAjaxRequest('post', '/api/news/section/' + section_name, null, listSectionHandler);
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
    sendAjaxRequest('post', '/api/news/section/' + section_name + '/scroll', {next_preview: previews_offset}, showMorePreviewsHandler);
  }
  
  function showMorePreviewsHandler() {
    let response = JSON.parse(this.responseText);

    if(response['news'].length == 0){
      console.log("There's no more news to load.");
     // $('#placeComments').append("<div class=\"alert alert-dismissible alert-secondary\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>Sorry!</strong> No more comments at the moment!</div>");
    }
    document.getElementById('news_item_preview_list').append(response['news']);
    offset += 10;
    }
  
addEventListeners();
