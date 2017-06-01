<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
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

class CoachController extends Controller
{
    public function showManageTeam() {
        return view('coach/manage-team');
    }

    public function showSplits(Athlete $athlete, Performance $performance) {
        return view('coach/splits', ['athlete' => $athlete, 'performance' => $performance]);
    }

    public function deleteResultRelay(ScheduleEvent $meet, Relay $relay) {
        $relay->delete();
        return view('coach/view-meet', ['meet' => $meet]);
    }

    public function deleteResultIndividual(ScheduleEvent $meet, Performance $performance) {
        $performance->delete();
        return view('coach/view-meet', ['meet' => $meet]);
    }

    public function deleteAnnouncement(Announcement $announcement) {
        $announcement->delete();
        return view('coach/announcements');
    }

    public function showViewMeet(ScheduleEvent $meet) {
        return view('coach/view-meet', ['meet' => $meet]);
    }

    public function showTeamBests(Event $event, $include_relays = False) {
        return view('coach/results', ['event' => $event, 'include_relays' => $include_relays]);
    }

    public function showResults() {
        return view('coach/results', ['event' => null]);
    }

    public function changeEvent(Request $request) {
        if (isset($request->delete)) {
            ScheduleEvent::find($request->entry_id)->delete();
            return view('coach/schedule');
        }

        $schedule_event = ScheduleEvent::find($request->entry_id);

        if ($request->complete) {
            $schedule_event->complete = 1;
        } else {
            // delete all results for this event
            $schedule_event->complete = 0;
            DB::delete("delete from performance where performance.team_id = ? and performance.meet_id = ?", [$request->team_id, $request->entry_id]);
        }
        $schedule_event->save();
        return view('coach/schedule');
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
            $performance->team_id = $request->team_id;
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

        return view('coach/add-results-individual', ['successful' => 1, 'meet' => $meet]);
    }

    public function showAddResultsIndividual(ScheduleEvent $meet) {
        return view('coach/add-results-individual', ['successful' => 0, 'meet' => $meet]);
    }

    public function addResultsRelay(Request $request, ScheduleEvent $meet) {
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

        return view('coach/add-results-relay', ['successful' => 1, 'gender' => $gender, 'meet' => $meet, 'relay' => null]);
    }

    public function showAddResultsRelay(ScheduleEvent $meet, $relay = null, $gender = 1) {
        if ($relay == 0) $relay = null;
        return view('coach/add-results-relay', ['successful' => 0, 'gender' => $gender, 'meet' => $meet, 'relay' => Event::find($relay)]);
    }

    public function addAnnouncement(Request $request) {
        $announcement = new Announcement;

        $announcement->team_id = $request->team_id;
        $announcement->coach_id = $request->coach_id;
        $announcement->text = $request->text;

        $announcement->save();

        return view('coach/add-announcement', ['successful' => 1]);
    }

    public function showAddAnnouncement() {
        return view('coach/add-announcement', ['successful' => 0]);
    }

    public function showAnnouncements() {
        return view('coach/announcements');
    }

    public function addScheduleEvent(Request $request) {
        $this->validate($request, [
            'date' => 'date_format:n/j/Y'
        ]);

        $schedule_event = new ScheduleEvent;
        $schedule_event->name = $request->name;
        $schedule_event->location = $request->location;
        $schedule_event->date = date_format(date_create($request->date), 'Y-m-d H:i:s');
        $schedule_event->importance = $request->importance;
        $schedule_event->team_id = $request->team_id;
        $schedule_event->save();

        return view('coach/add-schedule-event', ['successful' => 1]);
    }

    public function showAddScheduleEvent() {
        return view('coach/add-schedule-event', ['successful' => 0]);
    }

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

    public function timeRegex($event_type) {
        if ($event_type == 0)
            return '((\d:)?(\d))?\d(\.\d{1,2})?';
        elseif ($event_type == 1) 
            return '\d{1,2}:\d{2}(\.\d{1,2})?';
        elseif ($event_type == 2)
            return '\d{1,2}-\d{1,2}(\.\d{1,2})?';
    }

    public function ordinal($i) {
        if ($i == 0) return 'first';
        else if ($i == 1) return 'second';
        else if ($i == 2) return 'third';
        else if ($i == 3) return 'anchor';
        else return null;
    }
}
