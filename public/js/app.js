console.log('app.js included');

function addEventListeners() {
  //NOSSO CODIGO
  let availableSections = document.querySelectorAll('.section_specific');
  [].forEach.call(availableSections, function(section) {
    section.addEventListener('click', sendSelectSpecificSection);
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

function sendSelectSpecificSection(event) {

/*
  let section_name = this.innerText.trim();
  console.log("section name = "+section_name)
*/
  let section_name = event.target.name;
  document.querySelector('.current_section').innerHTML = event.target.innerHTML;
  sendAjaxRequest('post', '/api/news/section/' + section_name, null, listSpecificSectiondHandler);
}


function listSpecificSectiondHandler() {
  console.log(this.responseText);
 // let item = JSON.parse(this.responseText);
 // let element = document.querySelector('li.item[data-id="' + item.id + '"]');
 // let input = element.querySelector('input[type=checkbox]');
 // element.checked = item.done == "true";
}

addEventListeners();
