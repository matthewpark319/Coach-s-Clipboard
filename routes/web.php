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

Route::get('/', 'Auth\LoginController@showLoginForm');

// Copied over Authentication routes from Illuminate/Routing/Router.php instead of Auth::Routes
// Login routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
// end Auth routes

Route::get('home', 'HomeController@index');

Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// registration routes
Route::get('register', 'PreLoginController@showRegistrationPage')->name('register');

Route::post('register', 'PreLoginController@toSetupCoachOrAthlete');

Route::get('register/create-team', 'PreLoginController@showCreateTeam')->name('create-team');

Route::post('register/create-team', 'PreLoginController@createTeam');

Route::get('register/join-team', 'PreLoginController@showJoinTeam')->name('join-team');

Route::post('register/join-team', 'PreLoginController@joinTeam');

Route::get('register/create-coach', 'PreLoginController@showCreateCoach')->name('create-coach');

Route::post('register/create-coach', 'PreLoginController@toSetupTeam');

Route::get('register/create-athlete', 'PreLoginController@showCreateAthlete')->name('create-athlete');

Route::post('register/create-athlete', 'PreLoginController@toSetupTeam');

Route::get('register/account-successful', 'PreLoginController@showLoginSuccessful')->name('account-successful');

// coach routes
Route::get('coach/home', 'CoachController@showHome')->name('coach-home');

Route::get('coach/roster', 'CoachController@showRoster')->name('coach-roster');

// athlete routes
Route::get('athlete/home', 'AthleteController@showHome')->name('athlete-home');