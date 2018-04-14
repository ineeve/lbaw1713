<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('news');
})->name('homepage');
Route::get('error/404', 'Controller@errorNotFound');

// // Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login'); 
// TODO: apagar GET LOGIN
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

//Create news
Route::get('news/create', 'NewsController@createArticle')->name('create_news'); 

Route::get('news', 'NewsController@list');
Route::post('news', 'NewsController@create')->name('news');

//Route::get('api/news/{section_id}', 'NewsController@list');

Route::get('news/{id}', 'NewsController@show');

//Edit news
// TODO: Alterar Editor
Route::get('news/{id}/edit', 'NewsController@editArticle');
Route::patch('news/{id}', 'NewsController@edit')->name('update_news');
//Delete News
Route::delete('news/{id}', 'NewsController@destroy')->name('delete_news');

Route::post('api/news/{news_id}/comments/scroll','AjaxController@scrollComments');

Route::post('api/news/{news_id}/vote','AjaxController@createVote');
Route::post('api/news/','AjaxController@changeToSectionAll');

Route::post('api/news/section/All','AjaxController@changeToSectionAll');
Route::post('api/news/section/{section_id}','AjaxController@changeSection');

Route::get('privacy_policy','PrivacyPolicy@show');
Route::post('api/news/section/All/scroll','AjaxController@showMorePreviewsOfAll');
Route::post('api/news/section/{section_id}/scroll','AjaxController@showMorePreviews');

// Comments - TODO: Add more methods once they're implemented
Route::resource('news/{id}/comments', 'CommentController')->only([
    'store'
]);