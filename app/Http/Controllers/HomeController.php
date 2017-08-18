<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Coach;
use App\Athlete;
use App\Team;
use App\User;
use App\Announcement;
use App\ScheduleEvent;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->coach_or_athlete) {
            $coach = Coach::where('user_id', $user->id)->first();
            if ($coach->asst_coach_of == null) $team = Team::find($coach->head_coach_of);
            else $team = Team::find($coach->asst_coach_of);

            $season = $team->currentSeason();

            session(['season' => $season->id]);
            session(['xc' => strcmp($season->name, 'Cross Country') == 0]);
            return redirect()->route('coach-home');
        } else {
            $athlete = Athlete::where('user_id', $user->id)->first();
            $team = Team::find($athlete->team_id);

            $season = $team->currentSeason();

            session(['season' => $team->id]);
            session(['xc' => strcmp($season->name, 'Cross Country') == 0]);
            return redirect()->route('athlete-home');   
        }
    }
}
