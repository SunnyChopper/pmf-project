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

// Public site
Route::get('/', 'PublicController@index');
Route::get('/solutions', 'PublicController@solutions');
Route::get('/blog', 'PublicController@blog');
Route::get('/contact', 'PublicController@contact');
Route::get('/login', 'PublicController@login');
Route::get('/start-trial', 'PublicController@trial');

// User Control
Route::post('/login/attempt', 'UsersController@login');

// Check out
Route::post('/register/free-trial', 'UsersController@start_trial');

// Testing
Route::post('/test', 'CheckoutController@test');
Route::get('/checkout', 'PublicController@checkout');

// Dashboard
Route::get('/dashboard/', 'DashboardController@index');
Route::get('/dashboard/landing-pages/', 'DashboardController@landing_pages');
Route::get('/dashboard/signups/', 'DashboardController@signups');
Route::get('/trial-ended', 'DashboardController@trial_ended');

// Ideas
Route::get('/dashboard/idea/create', 'DashboardController@create_idea');
Route::get('/dashboard/idea/edit/{idea_id}', 'DashboardController@edit_idea');
Route::post('/idea/create', 'IdeasController@create');
Route::post('/idea/edit/{idea_id}', 'IdeasController@edit');

// Landing Pages
Route::get('/dashboard/lp/create/choose-template/', 'LandingPageController@choose_template');
Route::get('/dashboard/lp/create/customize/{template_id}', 'LandingPageController@customize');
Route::get('/dashboard/lp/edit/{landing_page_id}', 'LandingPageController@edit');
Route::post('/lp/render/{template_id}/{mode}', 'LandingPageController@render');
Route::post('/lp/publish/{template_id}', 'LandingPageController@publish');
Route::post('/lp/edit/{landing_page_id}', 'LandingPageController@edit_data');
Route::get('/lp/{user_id}/{landing_page_id}', 'LandingPageController@view');
Route::get('/dashboard/lp/test', 'LandingPageController@test');

// Signups
Route::post('/signups/create', 'SignupController@create');