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
// Testing
Route::get('/test', 'DashboardController@test');
Route::get('/checkout', 'PublicController@checkout');

// Public site
Route::get('/', 'PublicController@index');
Route::get('/solutions', 'PublicController@solutions');
Route::get('/blog', 'PublicController@blog');
Route::get('/contact', 'PublicController@contact');
Route::get('/contact/thank-you', 'PublicController@contact_thank_you');
Route::post('/contact/submit', 'PublicController@submit_contact');
Route::get('/login', 'PublicController@login');

// Plans
Route::get('/plan/{plan_id}', 'PlansController@index');
Route::get('/start-trial', 'PublicController@trial');

// Check out
Route::post('/plan/register/{plan_id}', 'CheckoutController@checkout');
Route::post('/register/free-trial', 'UsersController@start_trial');

// Onboarding
Route::get('/onboarding/start', 'OnboardingController@index');
Route::post('/onboarding/create-idea', 'OnboardingController@createIdea');
Route::get('/onboarding/choose-template', 'OnboardingController@choose_template');
Route::get('/onboarding/edit-template/{template_id}', 'OnboardingController@edit_template');
Route::post('/onboarding/render-optin-page', 'OnboardingController@renderOptinPage');
Route::post('/onboarding/create-optin-page', 'OnboardingController@createOptinPage');
Route::get('/onboarding/share', 'OnboardingController@share');
Route::get('/onboarding/skip', 'OnboardingController@skip');

// Dashboard
Route::get('/dashboard/', 'DashboardController@index');
Route::get('/dashboard/optin-pages/', 'DashboardController@optin_pages');
Route::get('/dashboard/signups/', 'DashboardController@signups');
Route::get('/trial-ended', 'DashboardController@trial_ended');
Route::get('/dashboard/addons/', 'DashboardController@addons');

// Ideas
Route::get('/dashboard/idea/create', 'DashboardController@create_idea');
Route::get('/dashboard/idea/edit/{idea_id}', 'DashboardController@edit_idea');
Route::post('/idea/create', 'IdeasController@create');
Route::post('/idea/edit/{idea_id}', 'IdeasController@edit');
Route::post('/idea/delete', 'IdeasController@delete');

// Landing Pages
Route::get('/dashboard/lp/create/choose-template/', 'LandingPageController@choose_template');
Route::get('/dashboard/lp/create/customize/{template_id}', 'LandingPageController@customize');
Route::get('/dashboard/lp/edit/{landing_page_id}', 'LandingPageController@edit');
Route::post('/dashboard/lp/delete', 'LandingPageController@delete');
Route::post('/lp/render/{template_id}/{mode}', 'LandingPageController@render');
Route::post('/lp/publish/{template_id}', 'LandingPageController@publish');
Route::post('/lp/edit/{landing_page_id}', 'LandingPageController@edit_data');
Route::get('/lp/{user_id}/{landing_page_id}', 'LandingPageController@view');
Route::get('/dashboard/lp/test', 'LandingPageController@test');

// Signups
Route::post('/signups/create', 'SignupController@create');
Route::post('/signups/delete', 'SignupController@delete');

// User Control
Route::post('/login/attempt', 'UsersController@login');
Route::get('/logout', 'UsersController@logout');