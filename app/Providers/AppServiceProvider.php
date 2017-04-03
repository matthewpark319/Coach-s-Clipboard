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
            $team = \App\Team::find($coach->head_coach_of);
        
            $view->with('user', $user);
            $view->with('coach', $coach);
            $view->with('team', $team);
            $view->with('view', $view->name());
        });

        View::composer('athlete/*', function($view) {
            $user = \Auth::user();
            $athlete = \App\Athlete::where('user_id', $user->id)->first();
            $team = \App\Team::find($athlete->team);
        
            $view->with('user', $user);
            $view->with('athlete', $athlete);
            $view->with('team', $team);
            $view->with('view', $view->name());
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
