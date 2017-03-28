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
	public function showSchedule() {
		return view('coach/schedule');
	}

	public function showHome() {
		return view('coach/home');
	}

    public function showRoster() {
    	return view('coach/roster');
    }

    public function showViewAthlete(Athlete $athlete) {
    	return view('coach/view-athlete', ['athlete' => $athlete]);
    }
}
