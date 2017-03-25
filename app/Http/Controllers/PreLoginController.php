<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Auth\Register;
use App\Coach;
use App\Athlete;
use App\Team;

class PreLoginController extends Controller
{
    public function toSetupCoachOrAthlete(Request $request) {
        $this->validate($request, [
            'email' => 'email|max:255|unique:users',
            'password' => 'min:6|confirmed',
        ]);

        // save all user info in session
        $request->session()->put('first_name', $request->first_name);
        $request->session()->put('last_name', $request->last_name);
        $request->session()->put('email', $request->email);
        $request->session()->put('coach_or_athlete', $request->coach_or_athlete);
        $request->session()->put('password', $request->password); 

        if ($request->coach_or_athlete)
            return redirect()->route('create-coach');
        else
            return redirect()->route('create-athlete');
    }

    public function showCreateCoach() {
        return view('create-coach');
    }

    public function showCreateAthlete() {
        return view('create-athlete');
    }

    public function createCoach(Request $request) {
        $coach = new Coach;
    }

    public function createTeam(Request $request) {

        // register user
        $user_data = $request->session()->all();
        $user_id = $this->register($user_data);

        // validate team
        $this->validate($request, [
            'name' => 'max:255',
            'school' => 'max:255|unique:team,school',
        ]);

        // register team
        $team = new Team;
        $team->name = $request->name;
        $team->school = $request->school;
        $team->save();

        $coach = new Coach;
        $coach->title = $request->session()->get('coach-title');
        $coach->user_id = $user_id;
        $coach->head_coach_of = $team->id;
        $coach->save();

        $request->session()->flush();
        return view('account-successful', ['message' => 'Your team ID is: ' . $team->id]);
    }
    
    public function joinTeam(Request $request) {
        $this->validate($request, [
            'team_id' => 'exists:team,id'
        ]);

        $team = Team::find($request->team_id);

        // register user
        $user_data = $request->session()->all();
        $user_id = $this->register($user_data);

        $athlete = new Athlete;
        $athlete->events = $request->session()->get('athlete-events');
        $athlete->user_id = $user_id;
        $athlete->team = $team->id;

        $request->session()->flush();
        return view('account-successful', ['message' => 'You joined the ' . $team->school . ' ' . $team->name]);

    }

    public function showCreateTeam() {
        return view('create-team');
    }

    public function showJoinTeam() {
        return view('join-team');
    }

    public function showRegistrationPage() {
        return view('register');
    }

    public function toSetupTeam(Request $request) {
        // 1 = coach, 0 = athlete
        $coach_or_athlete = $request->session()->get('coach_or_athlete');

    	if ($coach_or_athlete) {
            $request->session()->put('coach-title', $request->title);
			return view('register-team');
        }
		else {
            $request->session()->put('athlete-events', $request->events);
			return redirect()->route('join-team');
        }
    }

    public function register(array $data) {
        // register user (both coaches and athletes)
        return (new Register)->registerArray($data);
    }
}
