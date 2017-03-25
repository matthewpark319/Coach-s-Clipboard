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

Route::get('logout', 'Auth\LoginController@logout');

// registration routes
Route::get('register', 'PreLoginController@showRegistrationPage')->name('register');

Route::post('register', 'PreLoginController@toSetupCoachOrAthlete');

Route::get('create-team', 'PreLoginController@showCreateTeam')->name('create-team');

Route::post('create-team', 'PreLoginController@createTeam');

Route::get('join-team', 'PreLoginController@showJoinTeam')->name('join-team');

Route::post('join-team', 'PreLoginController@joinTeam');

Route::get('create-coach', 'PreLoginController@showCreateCoach')->name('create-coach');

Route::post('create-coach', 'PreLoginController@toSetupTeam');

Route::get('create-athlete', 'PreLoginController@showCreateAthlete')->name('create-athlete');

Route::post('create-athlete', 'PreLoginController@toSetupTeam');