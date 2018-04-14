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

// // Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login'); 
// TODO: apagar GET LOGIN
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

//Create news
Route::get('news/create', 'CreateNewsController@show')->name('create_news'); 

Route::get('news', 'NewsController@list');
Route::post('news', 'NewsController@create')->name('news');

//Route::get('api/news/{section_id}', 'NewsController@list');

Route::get('news/{id}', 'NewsController@show');

Route::post('api/news/{news_id}/comments/scroll','AjaxController@scrollComments');


Route::post('api/news/','AjaxController@changeToSectionAll');

Route::post('api/news/section/{section_id}','AjaxController@changeSection');

// // Cards
// Route::get('cards', 'CardController@list');
// Route::get('cards/{id}', 'CardController@show');
//
// // API
// Route::put('api/cards', 'CardController@create');
// Route::delete('api/cards/{card_id}', 'CardController@delete');
// Route::put('api/cards/{card_id}/', 'ItemController@create');
// Route::post('api/item/{id}', 'ItemController@update');
// Route::delete('api/item/{id}', 'ItemController@delete');
//