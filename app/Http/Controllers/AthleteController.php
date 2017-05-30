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
use App\Event;
use App\Performance;

class AthleteController extends Controller
{
    //
    public function showSplits(Performance $performance) {
        return view('athlete/splits', ['performance' => $performance]);
    }

    public function showTeamBests(Event $event) {
        return view('athlete/results', ['event' => $event]);
    }

    public function showResults() {
        return view('athlete/results', ['event' => null]);
    }

    public function showViewMeet(ScheduleEvent $meet) {
        return view('athlete/view-meet', ['meet' => $meet]);
    }

    public function showViewAthlete(Athlete $teammate) {
        return view('athlete/view-athlete', ['teammate' => $teammate]);
    }

    public function showMyProfile() {
        return view('athlete/myprofile');
    }

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
