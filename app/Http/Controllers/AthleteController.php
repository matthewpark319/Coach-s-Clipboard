<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Coach;
use App\Athlete;
use App\Team;
use App\User;
use App\Announcement;
use App\ScheduleEvent;

class AthleteController extends Controller
{
    //
    public function showHome() {
    	$user = Auth::user();
    	
    	$athlete = Athlete::find($user->id)->first();
        $team = Team::find($athlete->team)->first();
        $announcements = Announcement::where('team_id', $team->id);
        $schedule = ScheduleEvent::where('team_id', $team->id);
        return view('home-athlete', [
            'user' => $user, 
            'athlete' => $athlete, 
            'team' => $team, 
            'announcements' => $announcements,
            'schedule' => $schedule
        ]);
    }
}
