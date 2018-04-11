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
});

// // Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login'); 
// TODO: apagar GET LOGIN
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// News


Route::get('news', 'NewsController@list');

Route::get('news/{id}', 'NewsController@show');

Route::get('api/news/{news_id}/comments/scroll','AjaxController@scrollOfComments');

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