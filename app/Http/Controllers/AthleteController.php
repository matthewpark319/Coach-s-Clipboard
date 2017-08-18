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
        return view('athlete/splits', ['tab' => 4, 'performance' => $performance]);
    }

    public function showTeamBests(Event $event, $include_relays = False) {
        return view('athlete/results', ['tab' => 4, 'event' => $event, 'include_relays' => $include_relays]);
    }

    public function showResults($season = null) {
        if (!is_null($season)) session(['season' => $season]);
        return view('athlete/results', ['tab' => 4, 'event' => null]);
    }

    public function showViewMeet(ScheduleEvent $meet) {
        return view('athlete/view-meet', ['tab' => 3, 'meet' => $meet]);
    }

    public function showViewAthlete(Athlete $teammate) {
        return view('athlete/view-athlete', ['tab' => 2, 'teammate' => $teammate]);
    }

    public function showMyProfile() {
        return view('athlete/myprofile', ['tab' => 1]);
    }

    public function showSchedule($season = null) {
        if (!is_null($season)) session(['season' => $season]);
        return view('athlete/schedule', ['tab' => 3]);
    }

    public function showHome($season = null) {
        if (!is_null($season)) session(['season' => $season]);
    	return view('athlete/home', ['tab' => 0]);
    }

    public function showRoster() {
        return view('athlete/roster', ['tab' => 2]);
    }

    public function showAnnouncements() {
        return view('athlete/announcements', ['tab' => 5]);
    }
}
