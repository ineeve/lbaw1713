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
Route::get('error/403', 'Controller@errorUnauthorizedAction');

// // Authentication

/*Action of login*/
Route::post('login', 'Auth\LoginController@login');
/*Action of logout*/
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
/*Form to register*/
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
/*Action to register*/
Route::post('register', 'Auth\RegisterController@register');

/*Form to create one piece of news*/
Route::get('news/create', 'NewsController@createArticle')->name('create_news'); 
/*Page where all the news are listed (main page)*/
Route::get('api/news/section/{section_name}/order/{order_name}/offset/{offset}', 'NewsController@list');
Route::get('news', 'NewsController@getNewsHomepage');
Route::post('news', 'NewsController@create')->name('news');//NOT USING?

/*Page showing the selected news*/
Route::get('news/{id}', 'NewsController@show');

//Edit news
// TODO: Alterar Editor
/*Form to edit one news*/
Route::get('news/{id}/edit', 'NewsController@editArticle');
/*Action to edit one news*/
Route::put('news/{id}/edit', 'NewsController@edit')->name('update_news');
//Delete News
Route::delete('news/{id}', 'NewsController@destroy')->name('delete_news');
/*Infinite scroll for news' comments */
Route::post('api/news/{news_id}/comments/scroll','AjaxController@scrollComments');

/*Action of voting on a news*/
Route::post('api/news/{news_id}/vote','AjaxController@createVote');
/*Get news' previous votes*/
Route::get('api/news/{news_id}/vote','AjaxController@getUserVote');

/*Page that informs the user of our privacy policies*/
Route::get('privacy_policy','PrivacyPolicyController@show');
/*Infinite scroll for news of section 'All' */


// Comments - TODO: Add more methods once they're implemented
Route::resource('news/{id}/comments', 'CommentController')->only([
    'store'
]);

Route::delete('api/news/{news_id}/comments/{id}', 'CommentController@delete');


// Click on a notification
Route::get('notifications/{id}', 'NotificationController@process');