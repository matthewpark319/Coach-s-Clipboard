<?php

namespace App\Http\Middleware;

use Closure;

class AthleteResetSeason
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $current_season = \App\Team::find(\Auth::user()->getTeamID())->currentSeason()->id;
        $request->session()->put('season', $current_season);
        return $next($request);
    }
}
