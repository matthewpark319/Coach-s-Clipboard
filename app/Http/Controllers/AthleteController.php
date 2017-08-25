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
use App\Season;
use App\Course;

class AthleteController extends Controller
{
    //
    public function showSplits(Performance $performance) {
        return view('athlete/splits', ['tab' => 4, 'performance' => $performance]);
    }

    public function showTeamBests(Event $event, $include_relays = False) {
        return view('athlete/results', ['tab' => 4, 'event' => $event, 'include_relays' => $include_relays]);
    }

    public function showTeamBestsXC(Event $event, Course $course = null) {
        return view('athlete/results-xc', ['tab' => 4, 'event' => $event, 'course' => $course]);
    }

    public function showResults($season = null) {
        if (!is_null($season)) {
            session(['season' => $season]);
            if (strcmp(Season::find($season)->name, 'Cross Country') == 0) {
                return view('athlete/results-xc', ['tab' => 4, 'event' => null]);
            }
        } elseif (strcmp(Season::find(session('season'))->name, 'Cross Country') == 0) return view('athlete/results-xc', ['tab' => 4, 'event' => null]);
        
        return view('athlete/results', ['tab' => 4, 'event' => null]);        
    }

    public function showViewMeet(ScheduleEvent $meet) {
        return view('athlete/view-meet', ['tab' => 3, 'meet' => $meet]);
    }

    public function showViewMeetXC(ScheduleEvent $meet) {
        return view('athlete/view-meet-xc', ['tab' => 3, 'meet' => $meet]);
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
