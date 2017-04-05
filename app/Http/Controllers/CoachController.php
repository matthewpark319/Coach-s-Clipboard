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

class CoachController extends Controller
{
    //
    public function deleteAnnouncement(Announcement $announcement) {
        $announcement->delete();
        return view('coach/announcements');
    }

    public function showViewMeet(ScheduleEvent $meet) {
        return view('coach/view-meet', ['meet' => $meet]);
    }

    public function showTeamBests(Request $request) {
        return view('coach/results', ['event' => $request->event]);
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

    public function addResults(Request $request) {
        // regex to match correct result format
        $format = '';
        if (strcmp($request->event_type, 'sprints') == 0)
            $format = '([\d]:)?(\d){1,2}\.(\d){1,2}';
        elseif (strcmp($request->event_type, 'distance') == 0) 
            $format = '\d{1,2}:\d{2}(\.\d{1,2})?';
        elseif (strcmp($request->event_type, 'field') == 0)
            $format = '\d{1,2}-\d{1,2}(\.\d{1,2})?';

        Validator::make($request->all(), [
            'result.*' => 'regex:/' . $format . '/',
            'athlete.*' => 'distinct',
            'place.*' => 'nullable|integer|min:0'
        ])->validate();


        for ($i = 0; $i < sizeof($request->result); $i++) {
            $performance = new Performance;
            $performance->event = $request->event;
            $performance->event_type = $request->event_type;
            $performance->athlete_id = $request->athlete[$i];
            $performance->result = $request->result[$i];
            $performance->place = $request->place[$i];
            $performance->team_id = $request->team_id;
            $performance->meet_id = $request->meet_id;
            $performance->save();
        }
        return view('coach/add-results', ['successful' => 1, 'meet' => ScheduleEvent::find($request->meet_id)]);
    }

    public function showAddResults(ScheduleEvent $meet) {
        return view('coach/add-results', ['successful' => 0, 'meet' => $meet]);
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
}
