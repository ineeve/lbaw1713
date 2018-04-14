console.log('app.js included');

function addEventListeners() {
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

function sendSelectSection(event) {

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

addEventListeners();


window.fbAsyncInit = function() {
  FB.init({
    appId      : '580346618990147',
    cookie     : true,
    xfbml      : true,
    version    : 'v1.0'
  });
    
  FB.AppEvents.logPageView();   
    
};

(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.12&appId=580346618990147&autoLogAppEvents=1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

function checkLoginState() {
  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });
}

function statusChangeCallback(response){
  console.log(response);
}