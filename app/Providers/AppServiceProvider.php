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
        View::composer('coach/*', function($view) {
            $user = \Auth::user();
            $coach = \App\Coach::where('user_id', $user->id)->first();

            // For now, a coach can only be part of 1 team. 
            // In the future, a coach will be able to join multiple teams.
            if ($coach->asst_coach_of == null) $team = \App\Team::find($coach->head_coach_of);
            else $team = \App\Team::find($coach->asst_coach_of);
        
            $view->with('user', $user);
            $view->with('coach', $coach);
            $view->with('team', $team);
        });

        View::composer('athlete/*', function($view) {
            $user = \Auth::user();
            $athlete = \App\Athlete::where('user_id', $user->id)->first();
            $team = \App\Team::find($athlete->team_id);
        
            $view->with('user', $user);
            $view->with('athlete', $athlete);
            $view->with('team', $team);
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
