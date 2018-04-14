console.log('app.js included');

function addEventListeners() {
  let availableSections = document.querySelectorAll('.section_specific');
  [].forEach.call(availableSections, function(section) {
    section.addEventListener('click', sendSelectSpecificSection);
  });

  let sectionAll = document.querySelector('.section_all');
  sectionAll.addEventListener('click', sendSelectSectionAll);
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

function sendSelectSpecificSection(event) {

/*
  let section_name = this.innerText.trim();
  console.log("section name = "+section_name)
*/
  let section_name = event.target.name;
  document.querySelector('.current_section').innerHTML = event.target.innerHTML;
  sendAjaxRequest('post', '/api/news/section/' + section_name, null, listSpecificSectionHandler);
}

function sendSelectSectionAll(event) {

  /*
    let section_name = this.innerText.trim();
    console.log("section name = "+section_name)
  */
    let section_name = event.target.name;
    document.querySelector('.current_section').innerHTML = event.target.innerHTML;
    sendAjaxRequest('post', '/api/news/section', null, listAllSectionsHandler);
}


function listSpecificSectionHandler() {
  let response = JSON.parse(this.responseText);
  let news_preview_div = document.getElementById('news_item_preview_list');
  while (news_preview_div.hasChildNodes()) {
    news_preview_div.removeChild(news_preview_div.lastChild);
  }
  news_preview_div.innerHTML = response['news'];
  }

  function listAllSectionsHandler() {
    let response = JSON.parse(this.responseText);
    let news_preview_div = document.getElementById('news_item_preview_list');
    while (news_preview_div.hasChildNodes()) {
      news_preview_div.removeChild(news_preview_div.lastChild);
    }
    news_preview_div.innerHTML = response['news'];
    }

addEventListeners();
