<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        View::composer('coach/home', function($view) {
            $user = \Auth::user();

            $coach = \App\Coach::where('user_id', $user->id)->first();
            $team = \App\Team::find($coach->head_coach_of);
            $announcements = \App\Announcement::where('team_id', $team->id);
            $schedule = \App\ScheduleEvent::where('team_id', $team->id);


            $view->with('user', $user);
            $view->with('coach', $coach);
            $view->with('team', $team);
            $view->with('announcements', $announcements);
            $view->with('schedule', $schedule);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
