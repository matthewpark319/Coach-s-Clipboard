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

class CoachController extends Controller
{
    //
	public function showHome() {
		// $user = Auth::user();

		// $coach = Coach::where('user_id', $user->id)->first();
  //       $team = Team::find($coach->head_coach_of);
  //       $announcements = Announcement::where('team_id', $team->id);
  //       $schedule = ScheduleEvent::where('team_id', $team->id);
  //       return view('coach/home', [
  //           'user' => $user,
  //           'coach' => $coach, 
  //           'team' => $team, 
  //           'announcements' => $announcements,
  //           'schedule' => $schedule
  //       ]);

		return view('coach/home');
	}

    public function showRoster() {
    	$user = Auth::user();
    	return view('coach/roster', ['user' => $user]);
    }
}
