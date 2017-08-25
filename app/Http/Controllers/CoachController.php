<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Coach;
use App\Athlete;
use App\Team;
use App\User;
use App\Announcement;
use App\ScheduleEvent;
use App\Performance;
use App\Event;
use App\Split;
use App\Relay;
use App\RosterSpot;
use App\Season;
use App\Course;

class CoachController extends Controller
{
    public function editAthlete(Request $request, Athlete $athlete) {
        $athlete->level = $request->level;
        $athlete->events = $request->events;
        $athlete->save();

        return view('coach.manage-team', ['tab' => 1, 'successful' => True, 'athlete' => $athlete]);
    }

    public function showEditAthlete(Athlete $athlete) {
        return view('coach/manage-team', ['tab' => 1, 'athlete' => $athlete]);
    }

    public function nsAddAthlete(Request $request) {

        $this->validate($request, [
            'grad_year' => 'regex:/(\d){4}/'
        ]);

        $user = new User;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->coach_or_athlete = 0;
        $user->gender = $request->gender;
        $user->save();

        $athlete = new Athlete;
        $athlete->user_id = $user->id;
        $athlete->team_id = $request->team_id;
        $athlete->grad_year = $request->grad_year;
        $athlete->level = $request->level;
        $athlete->events = $request->events;
        $athlete->save();

        $new_roster = session('new-roster');
        array_push($new_roster, $athlete->id);
        $request->session()->put('new-roster', $new_roster);

        return view('coach/new-season-roster', ['tab' => 0]);
    }

    public function nsShowAddAthlete(Request $request) {
        $old_roster = is_null($request->old) ? array() : $request->old;
        $request->session()->put('old-roster', $old_roster);

        $new_roster = is_null($request->new) ? array() : $request->new;
        $request->session()->put('new-roster', $new_roster);

        return view('coach/add-athlete', ['tab' => 0, 'route' => 'ns-athlete-submit', 'back_route' => 'new-season-roster']);
    }

    public function submitNewRoster(Request $request) {
        $season = new Season;
        $season->team_id = Auth::user()->getTeamID();
        $season->year = $request->session()->pull('ns_year');
        $season->name = $request->session()->pull('ns_name');
        $season->current = 0;
        $season->save();

        $athlete_list = $request->new;
        $season_id = $season->id;
        for ($i = 0; $i < count($athlete_list); $i++) {
            $spot = new RosterSpot;
            $spot->athlete_id = $athlete_list[$i];
            $spot->season_id = $season_id;
            $spot->save();
        }

        $team = Team::find($request->team_id);

        

        if ($request->session()->pull('ns_current', null)) {
            $team->setSeasonCurrent($season_id);
            $request->session()->put('season', $season_id);
        }

        $request->session()->forget('new-roster');
        $request->session()->forget('old-roster');
        $request->session()->forget('ns_current');

        return view('coach/home', ['tab' => 0]);
    }

    public function showNewSeasonRoster() {
        return view('coach/new-season-roster', ['tab' => 0]);
    }

    public function newSeason(Request $request) {
        $this->validate($request, [
            'year' => 'regex:/(\d){4}/'
        ]);

        $request->session()->put('ns_year', $request->year);
        $request->session()->put('ns_name', $request->name);

        $request->session()->put('ns_current', strcmp($request->current, 'on') == 0 ? 1 : 0);
        return redirect()->route('new-season-roster');
    }

    public function showNewSeason() {
        return view('coach/new-season', ['tab' => 0]);
    }

    public function addAthlete(Request $request) {
        $this->validate($request, [
            'grad_year' => 'regex:/(\d){4}/'
        ]);

        $user = new User;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->coach_or_athlete = 0;
        $user->gender = $request->gender;
        $user->save();

        $athlete = new Athlete;
        $athlete->user_id = $user->id;
        $athlete->team_id = $request->team_id;
        $athlete->grad_year = $request->grad_year;
        $athlete->level = $request->level;
        $athlete->events = $request->events;
        $athlete->save();

        $spot = new RosterSpot;
        $spot->athlete_id = $athlete->id;
        $spot->season_id = session('season');
        $spot->save();

        return view('coach/add-athlete', ['tab' => 1, 'route' => 'add-athlete', 'back_route' => 'coach-roster', 'successful' => True]);
    }

    public function showAddAthlete() {
        return view('coach/add-athlete', ['tab' => 1, 'route' => 'add-athlete', 'back_route' => 'coach-roster']);
    }

    public function showManageTeam($set_current = null) {
        if (!is_null($set_current)) {
            Team::find(Auth::user()->getTeamID())->setSeasonCurrent($set_current);
            if (strcmp(Season::find($set_current)->name, 'Cross Country') == 0) session(['xc' => true]);
            else session(['xc' => false]);
        }
        return view('coach/manage-team', ['tab' => 1]);
    }

    public function showSplits(Athlete $athlete, Performance $performance) {
        return view('coach/splits', ['tab' => 3, 'athlete' => $athlete, 'performance' => $performance]);
    }

    public function deleteResultIndividual(ScheduleEvent $meet, Performance $performance) {
        $performance->delete();
        return view('coach/view-meet', ['tab' => 3, 'meet' => $meet]);
    }

    public function deleteResultRelay(ScheduleEvent $meet, Relay $relay) {
        $relay->delete();
        return view('coach/view-meet', ['tab' => 3, 'meet' => $meet]);
    }

    public function deleteResultXC(ScheduleEvent $meet, Performance $performance) {
        $performance->delete();
        return view('coach/view-meet-xc', ['tab' => 3, 'meet' => $meet]);
    }

    public function deleteAnnouncement(Announcement $announcement) {
        $announcement->delete();
        return view('coach/announcements', ['tab' => 4]);
    }

    public function showViewMeet(ScheduleEvent $meet) {
        return view('coach/view-meet', ['tab' => 3, 'meet' => $meet]);
    }

    public function showViewMeetXC(ScheduleEvent $meet) {
        return view('coach/view-meet-xc', ['tab' => 3, 'meet' => $meet]);
    }

    public function showTeamBests(Event $event, $include_relays = False) {
        return view('coach/results', ['tab' => 3, 'event' => $event, 'include_relays' => $include_relays]);
    }

    public function showTeamBestsXC(Event $event, Course $course = null) {
        return view('coach/results-xc', ['tab' => 3, 'event' => $event, 'course' => $course]);
    }

    public function showResults($season = null) {
        if (!is_null($season)) {
            session(['season' => $season]);
            if (strcmp(Season::find($season)->name, 'Cross Country') == 0) {
                return view('coach/results-xc', ['tab' => 3, 'event' => null]);
            }
        } elseif (strcmp(Season::find(session('season'))->name, 'Cross Country') == 0) return view('coach/results-xc', ['tab' => 3, 'event' => null]);
        
        return view('coach/results', ['tab' => 3, 'event' => null]);        
    }

    public function showAddResultsIndividual(ScheduleEvent $meet) {
        return view('coach/add-results-individual', ['tab' => 2, 'successful' => 0, 'meet' => $meet]);
    }

    public function showAddResultsRelay(ScheduleEvent $meet, $relay = null, $gender = 1) {
        if ($relay == 0) $relay = null;
        return view('coach/add-results-relay', ['tab' => 2, 'successful' => 0, 'gender' => $gender, 'meet' => $meet, 'relay' => Event::find($relay)]);
    }

    public function showAddResultsXC(ScheduleEvent $meet) {
        return view('coach/add-results-xc', ['tab' => 2, 'successful' => 0, 'meet' => $meet]);
    }

    public function addResultsIndividual(Request $request, ScheduleEvent $meet) {
        
        Validator::make($request->all(), [
            'result.*' => 'regex:/' . $this->timeRegex(Event::find($request->event)->type) . '/',
            'athlete.*' => 'distinct',
            'place.*' => 'nullable|integer|min:1',
            'lap_1.*' => 'nullable|regex:/((\d:)?(\d))?\d(\.\d{1,2})?/',
            'lab_2.*' => 'nullable|regex:/((\d:)?(\d))?\d(\.\d{1,2})?/',
            'lap_3.*' => 'nullable|regex:/((\d:)?(\d))?\d(\.\d{1,2})?/',
            'lab_4.*' => 'nullable|regex:/((\d:)?(\d))?\d(\.\d{1,2})?/',
            'lap_5.*' => 'nullable|regex:/((\d:)?(\d))?\d(\.\d{1,2})?/',
            'lab_6.*' => 'nullable|regex:/((\d:)?(\d))?\d(\.\d{1,2})?/',
            'lap_7.*' => 'nullable|regex:/((\d:)?(\d))?\d(\.\d{1,2})?/',
            'lab_8.*' => 'nullable|regex:/((\d:)?(\d))?\d(\.\d{1,2})?/'
        ])->validate();

        $LAPS = array('lap_1', 'lap_2', 'lap_3', 'lap_4', 'lap_5', 'lap_6', 'lap_7', 'lap_8');

        for ($i = 0; $i < sizeof($request->result); $i++) {
            $performance = new Performance;
            $performance->event_id = $request->event;
            $performance->athlete_id = $request->athlete[$i];
            $performance->result = $request->result[$i];
            $performance->place = $request->place[$i];
            $performance->team_id = Auth::user()->getTeamID();
            $performance->meet_id = $meet->id;
            $performance->save();

            $has_splits = False;
            for ($j = 0; $j < 8; $j++) {
                $lap = $LAPS[$j];
                $splits = $request->$lap;

                if (count($splits) == 0) continue;
                
                $has_splits = True;
                $split = new Split;
                $split->performance_id = $performance->id;
                $split->time = $splits[$i];
                $split->lap = $j + 1; 
                $split->save();
            }
            if ($has_splits) {
                $performance->has_splits = 1;
                $performance->save();
            }
        }

        return view('coach/add-results-individual', ['tab' => 2, 'successful' => 1, 'meet' => $meet]);
    }

    public function addResultsRelay(Request $request, ScheduleEvent $meet, $gender) {
        $legs = Event::getRelayLegs($request->event);

        Validator::make($request->all(), [
            'legs.*' => 'distinct',
            'splits.0' => 'regex:/' . $this->timeRegex($legs[0]->type) . '/',
            'splits.1' => 'regex:/' . $this->timeRegex($legs[1]->type) . '/',
            'splits.2' => 'regex:/' . $this->timeRegex($legs[2]->type) . '/',
            'splits.3' => 'regex:/' . $this->timeRegex($legs[3]->type) . '/',
            'place' => 'nullable|integer|min:1',
            'time' => 'regex:/\d{1,2}:\d{2}(\.\d{1,2})?/',
            'lap_1.*' => 'nullable|regex:/((\d:)?(\d))?\d(\.\d{1,2})?/',
            'lab_2.*' => 'nullable|regex:/((\d:)?(\d))?\d(\.\d{1,2})?/',
            'lap_3.*' => 'nullable|regex:/((\d:)?(\d))?\d(\.\d{1,2})?/',
            'lab_4.*' => 'nullable|regex:/((\d:)?(\d))?\d(\.\d{1,2})?/'
        ])->validate();

        $LAPS = array('lap_1', 'lap_2', 'lap_3', 'lap_4');

        $relay = new Relay;
        $relay->event_id = $request->event;
        $relay->result = $request->time;
        $relay->place = $request->place;
        $relay->meet_id = $meet->id;
        $relay->team_id = $request->team_id;
        
        $has_splits = False;
        for ($i = 0; $i < sizeof($request->splits); $i++) {
            $leg = new Performance;
            $leg->event_id = $legs[$i]->id;
            $leg->result = $request->splits[$i];
            $leg->athlete_id = $request->legs[$i];
            $leg->team_id = $request->team_id;
            $leg->meet_id = $meet->id;
            $leg->relay_leg = $this->ordinal($i);

            $leg->save();

            if ($i == 0) $relay->first_leg = $leg->id;
            else if ($i == 1) $relay->second_leg = $leg->id;
            else if ($i == 2) $relay->third_leg = $leg->id;
            else $relay->fourth_leg = $leg->id;

            for ($j = 0; $j < 4; $j++) {
                $lap = $LAPS[$j];
                $splits = $request->$lap;

                if (count($splits) == 0) continue;
                
                $has_splits = True;
                $split = new Split;
                $split->performance_id = $leg->id;
                $split->time = $splits[$i];
                $split->lap = $j + 1; 
                $split->save();
            }
            if ($has_splits) {
                $leg->has_splits = 1;
                $leg->save();
            }
        }

        $relay->save();

        return view('coach/add-results-relay', ['tab' => 2, 'successful' => 1, 'gender' => $gender, 'meet' => $meet, 'relay' => null]);
    }

    public function addResultsXC(Request $request, ScheduleEvent $meet) {
        Validator::make($request->all(), [
            // only XC results, type = 4
            'result.*' => ['regex:/' . $this->timeRegex(4) . '/'],
            'athlete.*' => 'distinct',
            'place.*' => 'nullable|integer|min:1',
        ])->validate();

        for ($i = 0; $i < sizeof($request->result); $i++) {
            $performance = new Performance;
            $performance->event_id = $request->event;
            $performance->athlete_id = $request->athlete[$i];
            $performance->result = $request->result[$i];
            $performance->place = $request->place[$i];
            $performance->team_id = Auth::user()->getTeamID();
            $performance->meet_id = $meet->id;
            $performance->save();
        }

        return view('coach/add-results-xc', ['tab' => 2, 'successful' => 1, 'meet' => $meet]);
    }

    public function addAnnouncement(Request $request) {
        $this->validate($request, [
            'text' => 'required'
        ]);
        $announcement = new Announcement;

        $announcement->team_id = $request->team_id;
        $announcement->coach_id = $request->coach_id;
        $announcement->season_id = $request->session()->get('season');
        $announcement->text = $request->text;

        $announcement->save();

        return view('coach/add-announcement', ['tab' => 4, 'successful' => 1]);
    }

    public function showAddAnnouncement() {
        return view('coach/add-announcement', ['tab' => 4, 'successful' => 0]);
    }

    public function showAnnouncements() {
        return view('coach/announcements', ['tab' => 4]);
    }

    public function addScheduleEvent(Request $request) {
        $this->validate($request, [
            'meet_name' => 'required',
            'course_id' => 'nullable',
            'location' => 'required',
            'date' => 'date_format:n/j/Y|required',
            'importance' => 'required',
        ]);

        $schedule_event = new ScheduleEvent;
        $schedule_event->name = $request->meet_name;
        $schedule_event->location = $request->location;
        $schedule_event->date = date_format(date_create($request->date), 'Y-m-d H:i:s');
        $schedule_event->importance = $request->importance;
        $schedule_event->team_id = Auth::user()->getTeamID();
        $schedule_event->season_id = $request->session()->get('season');
        $schedule_event->xc_course_id = $request->course_id;
        $schedule_event->save();

        return view('coach/add-meet', ['tab' => 2, 'successful' => 1]);
    }

    public function showAddScheduleEvent() {
        return view('coach/add-meet', ['tab' => 2, 'successful' => 0]);
    }

    public function showAddScheduleEventXC() {
        return view('coach/add-meet-xc', ['tab' => 2, 'successful' => 0]);
    }

    public function addCourseXC(Request $request) {
        $this->validate($request, [
            'name' => Rule::unique('xc_course')->where(function($query) {
                $query->where('team_id', Auth::user()->getTeamID());
            })
            
        ]);

        $course = new Course;
        $course->name = $request->name;
        $course->team_id = Auth::user()->getTeamID();
        $course->save();

        return redirect()->route('add-meet-xc');
    }

	public function showSchedule($season = null) {
        if (!is_null($season)) session(['season' => $season]);
		return view('coach/schedule', ['tab' => 2]);
	}

    public function deleteScheduleEvent(ScheduleEvent $meet) {
        $meet->delete();
        return view('coach/schedule', ['tab' => 2]);
    }

    public function completeScheduleEvent(ScheduleEvent $meet) {
        $meet->complete = 1;
        $meet->save();
        return view('coach/schedule', ['tab' => 2]);
    }

    public function uncompleteScheduleEvent(ScheduleEvent $meet) {
        $meet->complete = 0;
        $meet->save();

        DB::delete("delete from performance where performance.team_id = ? and performance.meet_id = ?", [Auth::user()->getTeamID(), $meet->id]);

        return view('coach/schedule', ['tab' => 2]);
    }

	public function showHome($season = null) {    
        if (!is_null($season)) session(['season' => $season]);
		return view('coach/home', ['tab' => 0]);
	}

    public function showRoster($season = null) {
        if (!is_null($season)) session(['season' => $season]);
    	return view('coach/roster', ['tab' => 1]);
    }

    public function showViewAthlete(Athlete $athlete) {
    	return view('coach/view-athlete', ['tab' => 1, 'athlete' => $athlete]);
    }

    public function timeRegex($event_type) {
        if ($event_type == 0)
            return '((\d:)?(\d))?\d(\.\d{1,2})?';
        elseif ($event_type == 1) 
            return '\d{1,2}:[0-5]\d(\.\d{1,2})?';
        elseif ($event_type == 2)
            return '\d{1,2}-\d{1,2}(\.\d{1,2})?';
        // type == 3 events are relays, which have each leg validated individually
        elseif ($event_type == 4)
            return '([1-3]\d|[5-9]):([0-5]\d)';
    }

    public function ordinal($i) {
        if ($i == 0) return 'first';
        else if ($i == 1) return 'second';
        else if ($i == 2) return 'third';
        else if ($i == 3) return 'anchor';
        else return null;
    }
}
