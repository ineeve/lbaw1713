console.log('app.js included');

function addEventListeners() {
  //NOSSO CODIGO
  let availableSections = document.querySelectorAll('.section_item');
  [].forEach.call(availableSections, function(section) {
    section.addEventListener('click', sendSelectSection);
  });
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

//NOSSO CODIGO

function sendSelectSection(event) {

  let section_name = event.target.name;
  sendAjaxRequest('post', '/api/news/section/' + section_name, null, listSectiondHandler);
}


function listSectiondHandler() {
  let response = JSON.parse(this.responseText);
  let news_preview_div = document.getElementById('news_item_preview_list');
  while (news_preview_div.hasChildNodes()) {
    news_preview_div.removeChild(news_preview_div.lastChild);
  }
  news_preview_div.innerHTML = response['news'];
  }



addEventListeners();
