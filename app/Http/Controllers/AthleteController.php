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
    public function showSchedule() {
        return view('athlete/schedule');
    }

    public function showHome() {
    	return view('athlete/home');
    }

    public function showRoster() {
        return view('athlete/roster');
    }

    public function showAnnouncements() {
        return view('athlete/announcements');
    }
}
