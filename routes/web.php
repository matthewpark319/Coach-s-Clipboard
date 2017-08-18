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

	Route::get('account-successful', 'PreLoginController@showLoginSuccessful')->name('account-successful');

	Route::get('pre-registered/choose-team', 'PreLoginController@showPreRegistered')->name('pre-registered');

	Route::post('pre-registered/choose-team', 'PreLoginController@preRegisteredTeamID');

	Route::post('choose-season', 'PreLoginController@chooseSeason')->name('choose-season');

	Route::post('pre-registered/choose-season', 'PreLoginController@prChooseSeason')->name('pr-choose-season');

	Route::get('pre-registered/complete', 'PreLoginController@completePreRegistration')->name('complete-pre-registration');

	Route::post('pre-registered/complete', 'PreLoginController@completePreRegistration');

});

// coach routes
Route::group(['prefix' => 'coach'], function() {

	Route::get('home/{season?}', 'CoachController@showHome')->name('coach-home');

	Route::get('roster/{season?}', 'CoachController@showRoster')->name('coach-roster');

	Route::get('view-athlete/{athlete}', 'CoachController@showViewAthlete')->name('coach-view-athlete');

	Route::get('splits/{performance}', 'CoachController@showSplits')->name('coach-splits');

	Route::get('schedule/{season?}', 'CoachController@showSchedule')->name('coach-schedule');

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

	Route::post('add-results/relay/{meet}/{relay?}/{gender?}', 'CoachController@addResultsRelay');

	Route::get('results/{season?}', 'CoachController@showResults')->name('coach-results');

	Route::get('results/team-bests/{event}/{include_relays?}', 'CoachController@showTeamBests')->name('coach-team-bests');

	Route::get('view-meet/{meet}', 'CoachController@showViewMeet')->name('coach-view-meet');

	Route::get('view-meet/{meet}/delete-individual/{performance}', 'CoachController@deleteResultIndividual')->name('delete-individual');

	Route::get('view-meet/{meet}/delete-relay/{relay}', 'CoachController@deleteResultRelay')->name('delete-relay');

	Route::get('manage-team/{set_current?}', 'CoachController@showManageTeam')->name('manage-team');

	Route::get('manage-team/edit-athlete/{athlete}', 'CoachController@showEditAthlete')->name('edit-athlete');

	Route::post('manage-team/edit-athlete/{athlete}', 'CoachController@editAthlete');

	Route::get('add-athlete', 'CoachController@showAddAthlete')->name('add-athlete');

	Route::post('add-athlete', 'CoachController@addAthlete');

	Route::get('new-season', 'CoachController@showNewSeason')->name('new-season');

	Route::post('new-season', 'CoachController@newSeason');

	Route::get('new-season/roster', 'CoachController@showNewSeasonRoster')->name('new-season-roster');

	Route::post('new-season/submit', 'CoachController@submitNewRoster')->name('submit-new-roster');

	Route::post('new-season/add-athlete', 'CoachController@nsShowAddAthlete')->name('ns-add-athlete');

	Route::post('new-season/add-athlete/submit', 'CoachController@nsAddAthlete')->name('ns-athlete-submit');
});

// athlete routes
Route::group(['prefix' => 'athlete', 'middleware' => ['athlete.reset-season']], function() {

	Route::get('home/{season?}', 'AthleteController@showHome')->name('athlete-home');

	Route::get('my-profile', 'AthleteController@showMyProfile')->name('my-profile');

	Route::get('roster', 'AthleteController@showRoster')->name('athlete-roster');

	Route::get('schedule/{season?}', 'AthleteController@showSchedule')->name('athlete-schedule');

	Route::get('announcements', 'AthleteController@showAnnouncements')->name('athlete-announcements');

	Route::get('view-athlete/{teammate}', 'AthleteController@showViewAthlete')->name('athlete-view-athlete');

	Route::get('view-meet/{meet}', 'AthleteController@showViewMeet')->name('athlete-view-meet');

	Route::get('results/{season?}', 'AthleteController@showResults')->name('athlete-results');

	Route::get('results/team-bests/{event}/{include_relays?}', 'AthleteController@showTeamBests')->name('athlete-team-bests');

	Route::get('splits/{performance}', 'AthleteController@showSplits')->name('athlete-splits');
});
