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

// ERROR PAGES
    // not found
    Route::get('error/404', 'Controller@errorNotFound');
    // not autorized
    Route::get('error/403', 'Controller@errorUnauthorizedAction');

    // PAGINATION
    Route::get('/pagination','PaginationController@getPagination');

// REPORT PAGES
    // show reports
    Route::get('/reports', 'ReporteditemController@show');
    // get news reports
    Route::get('/api/reports/news', 'ReporteditemController@getReports');
    // get comments reports
    Route::get('/api/reports/comments', 'ReporteditemController@getReportsComments');
    // get specific report
    Route::get('/reports/{id}', 'ReporteditemController@showReport');


// USER PAGES
    // see a user
    Route::get('/users/{username}', 'UserController@show');
    // form to edit a user
    Route::get('/users/{username}/edit', 'UserController@edit');
    // action to edit a user
    Route::patch('/users/{username}/edit', 'UserController@update')->name('update_user');
    // get articles writen by user
    Route::get('api/users/{username}/articles/', 'UserController@getArticles');
    // get the users this one is following
    Route::get('api/users/{username}/following/', 'UserController@getFollowing');
    Route::post('api/users/{username}/start_following/', 'UserController@startFollowing');
    Route::post('api/users/{username}/stop_following/', 'UserController@stopFollowing');

    // Password Reset Routes...
    $this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    $this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    $this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    $this->post('password/reset', 'Auth\ResetPasswordController@reset');

// SETTINGS PAGES
Route::get('/settings', 'UserController@showSettings')->name('show_settings');
Route::post('/api/settings/notifications/{notification}', 'UserController@activateNotification'); // activate notification type
Route::delete('/api/settings/notifications/{notification}', 'UserController@deactivateNotification'); // deactivate notification type
Route::post('/api/settings/interests', 'UserController@addInterest')->name('add_interest');
Route::delete('/api/settings/interests', 'UserController@removeInterest')->name('remove_interest');

//ADMIN PAGES
Route::get('/adm','AdminController@show')->name('show_admin_page');
Route::get('/adm/users','AdminController@getUsersTab');
Route::get('/adm/categories','AdminController@getCategoriesTab');
Route::get('/adm/badges','AdminController@getBadgesTab');
Route::get('/adm/statistics', 'AdminController@getStatsTab');
Route::post('/adm/badges', 'BadgeController@create');
Route::get('/adm/badges/{id}', 'BadgeController@showAdmin');
Route::put('/adm/badges/{id}', 'BadgeController@update');
Route::get('/adm/users/table','AdminController@getUsersTableRoute');
Route::put('/adm/users/{username}/promote','AdminController@promoteUser');
Route::put('/adm/users/{username}/demote','AdminController@demoteUser');
Route::post('/adm/users/{username}/ban','AdminController@banUser');
Route::post('/adm/users/{username}/unban','AdminController@unbanUser');
Route::post('/adm/categories/', 'SectionController@addCategory')->name('add_category');
Route::patch('/adm/categories/{id}', 'SectionController@editCategory')->name('edit_category');


// // Authentication

/*Action of login*/
Route::post('login', 'Auth\LoginController@login');
/*Action of logout*/
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
/*Form to register*/
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
/*Action to register*/
Route::post('register', 'Auth\RegisterController@register');

//Search
Route::get('news/search','NewsController@getSearchPage')->name('search');
Route::get('advanced_search','AdvancedSearchController@getAdvancedSearchPage')->name('advanced_search');

/*Form to create one piece of news*/
Route::get('news/create', 'NewsController@createArticle')->name('create_news'); 
/*Page where all the news are listed (main page)*/
Route::get('api/news/section/{section_name}/order/{order_name}/offset/{offset}', 'NewsController@list');
/*Page where all the news are listed (main page)*/
Route::get('api/news/order/{order_name}/offset/{offset}', 'NewsController@listSearch');

Route::get('news', 'NewsController@getNewsHomepage');
Route::post('news', 'NewsController@create')->name('news');//NOT USING?

/*Page showing the selected news*/
Route::get('news/{id}', 'NewsController@show');
Route::get('/about', 'PrivacyPolicyController@about');
Route::get('/faq', 'PrivacyPolicyController@faq');

//Edit news
/*Form to edit one news*/
Route::get('news/{id}/edit', 'NewsController@editArticle');
/*Action to edit one news*/
Route::put('news/{id}/edit', 'NewsController@edit')->name('update_news');
//Delete News
Route::delete('news/{id}', 'NewsController@destroy')->name('delete_news');
/*Infinite scroll for news' comments */
Route::post('api/news/{news_id}/comments/scroll','AjaxController@scrollComments');
/*Infinite scroll for users advanced search*/
Route::post('api/advanced_search/users/{searchText}/scroll','AdvancedSearchController@scrollAdvancedSearchUsers');
/*Action of voting on a news*/
Route::post('api/news/{news_id}/vote','AjaxController@createVote');
/*Get news' previous votes*/
Route::get('api/news/{news_id}/vote','AjaxController@getUserVote');

/*Page that informs the user of our privacy policies*/
Route::get('privacy_policy','PrivacyPolicyController@show');

Route::resource('news/{id}/comments', 'CommentController')->only([
    'store', 'update'
]);

Route::delete('api/news/{news_id}/comments/{id}', 'CommentController@delete');


// Click on a notification
Route::get('notifications/{id}', 'NotificationController@process');

//Report news
Route::post('news/{id}/report', 'NewsController@reportItem');
//Report comment
Route::post('news/{news_id}/comments/{comment_id}/report','NewsController@reportItem');
       
Route::post('/api/news/{news_id}/comments/{comment_id}/mod/create_comment','ModeratorcommentController@createcomments');
Route::post('/api/news/{news_id}/mod/create_comment','ModeratorcommentController@createnews');