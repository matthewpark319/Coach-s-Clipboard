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
Route::group(['prefix' => 'register'], function() {

	Route::get('/', 'PreLoginController@showRegistrationPage')->name('register');

	Route::post('/', 'PreLoginController@toSetupCoachOrAthlete');

	Route::get('create-team', 'PreLoginController@showCreateTeam')->name('create-team');

	Route::post('create-team', 'PreLoginController@createTeam');

	Route::get('join-team', 'PreLoginController@showJoinTeam')->name('join-team');

	Route::post('join-team', 'PreLoginController@joinTeam');

	Route::get('create-coach', 'PreLoginController@showCreateCoach')->name('create-coach');

	Route::post('create-coach', 'PreLoginController@toSetupTeam');

	Route::get('create-athlete', 'PreLoginController@showCreateAthlete')->name('create-athlete');

	Route::post('create-athlete', 'PreLoginController@toSetupTeam');

	Route::get('account-successful', 'PreLoginController@showLoginSuccessful')->name('account-successful');
});

// coach routes
Route::group(['prefix' => 'coach'], function() {

	Route::get('home', 'CoachController@showHome')->name('coach-home');

	Route::get('roster', 'CoachController@showRoster')->name('coach-roster');

	Route::get('view-athlete/{athlete}', 'CoachController@showViewAthlete')->name('coach-view-athlete');

	Route::get('splits/{performance}', 'CoachController@showSplits')->name('coach-splits');

	Route::get('schedule', 'CoachController@showSchedule')->name('coach-schedule');

	Route::post('schedule', 'CoachController@changeEvent');

	Route::get('add-schedule-event', 'CoachController@showAddScheduleEvent')->name('add-schedule-event');

	Route::post('add-schedule-event', 'CoachController@addScheduleEvent');

	Route::get('announcements', 'CoachController@showAnnouncements')->name('coach-announcements');

	Route::get('add-announcement', 'CoachController@showAddAnnouncement')->name('add-announcement');

	Route::post('add-announcement', 'CoachController@addAnnouncement');

	Route::get('delete-announcement/{announcement}', 'CoachController@deleteAnnouncement')->name('delete-announcement');

	Route::get('add-results/individual/{meet}', 'CoachController@showAddResultsIndividual')->name('add-results-individual');

	Route::post('add-results/individual/{meet}', 'CoachController@addResultsIndividual');

	Route::get('add-results/relay/{meet}/{relay?}/{gender?}', 'CoachController@showAddResultsRelay')->name('add-results-relay');

	Route::post('add-results/relay/{meet}', 'CoachController@addResultsRelay');

	Route::get('results', 'CoachController@showResults')->name('coach-results');

	Route::get('results/team-bests/{event}/{include_relays?}', 'CoachController@showTeamBests')->name('coach-team-bests');

	Route::get('view-meet/{meet}', 'CoachController@showViewMeet')->name('coach-view-meet');

	Route::get('view-meet/{meet}/delete-individual/{performance}', 'CoachController@deleteResultIndividual')->name('delete-individual');

	Route::get('view-meet/{meet}/delete-relay/{relay}', 'CoachController@deleteResultRelay')->name('delete-relay');

	Route::get('manage-team', 'CoachController@showManageTeam')->name('manage-team');
});

// athlete routes
Route::group(['prefix' => 'athlete'], function() {

	Route::get('home', 'AthleteController@showHome')->name('athlete-home');

	Route::get('my-profile', 'AthleteController@showMyProfile')->name('my-profile');

	Route::get('roster', 'AthleteController@showRoster')->name('athlete-roster');

	Route::get('schedule', 'AthleteController@showSchedule')->name('athlete-schedule');

	Route::get('announcements', 'AthleteController@showAnnouncements')->name('athlete-announcements');

	Route::get('view-athlete/{teammate}', 'AthleteController@showViewAthlete')->name('athlete-view-athlete');

	Route::get('view-meet/{meet}', 'AthleteController@showViewMeet')->name('athlete-view-meet');

	Route::post('results', 'AthleteController@showTeamBests');

	Route::get('results', 'AthleteController@showResults')->name('athlete-results');

	Route::get('results/team-bests/{event}', 'AthleteController@showTeamBests')->name('athlete-team-bests');

	Route::get('splits/{performance}', 'AthleteController@showSplits')->name('athlete-splits');
});
