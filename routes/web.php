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

Route::get('coach/view-athlete/{athlete}', 'CoachController@showViewAthlete')->name('coach-view-athlete');

Route::get('coach/schedule', 'CoachController@showSchedule')->name('coach-schedule');

Route::post('coach/schedule', 'CoachController@changeEvent');

Route::get('coach/add-schedule-event', 'CoachController@showAddScheduleEvent')->name('add-schedule-event');

Route::post('coach/add-schedule-event', 'CoachController@addScheduleEvent');

Route::get('coach/announcements', 'CoachController@showAnnouncements')->name('coach-announcements');

Route::get('coach/add-announcement', 'CoachController@showAddAnnouncement')->name('add-announcement');

Route::post('coach/add-announcement', 'CoachController@addAnnouncement');

Route::get('coach/delete-announcement/{announcement}', 'CoachController@deleteAnnouncement')->name('delete-announcement');

Route::get('coach/results', 'CoachController@showResults')->name('coach-results');

Route::get('coach/add-results/{meet}', 'CoachController@showAddResults')->name('add-results');

Route::post('coach/add-results/{meet}', 'CoachController@addResults');

Route::get('coach/results', 'CoachController@showResults')->name('coach-results');

Route::post('coach/results', 'CoachController@showTeamBests');

Route::get('coach/view-meet/{meet}', 'CoachController@showViewMeet')->name('coach-view-meet');


// athlete routes
Route::get('athlete/home', 'AthleteController@showHome')->name('athlete-home');

Route::get('athlete/my-profile', 'AthleteController@showMyProfile')->name('my-profile');

Route::get('athlete/roster', 'AthleteController@showRoster')->name('athlete-roster');

Route::get('athlete/schedule', 'AthleteController@showSchedule')->name('athlete-schedule');

Route::get('athlete/results', 'AthleteController@showResults')->name('athlete-results');

Route::get('athlete/announcements', 'AthleteController@showAnnouncements')->name('athlete-announcements');