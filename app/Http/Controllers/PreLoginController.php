<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Auth\Register;
use App\Coach;
use App\Athlete;
use App\Team;
use App\User;
use App\RosterSpot;
use App\Season;

class PreLoginController extends Controller
{
    public function showAccountSuccessful($message, $team_password = null) {
        session()->flush();
        return view('register/account-successful', ['message' => $message, 'team_password' => $team_password]);
    }

    public function completePreRegistration(Request $request) {
        $this->validate($request, [
            'username' => 'max:255|unique:users',
            'password' => 'min:6|confirmed',
        ]);

        $user = User::find($request->user_id);
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->save();

        $team = Team::find(session('pr_team_id'));
        return $this->showAccountSuccessful('You joined the ' . $team->school . ' ' . $team->name);
    }

    public function chooseSeason(Request $request) {
        $spot = new RosterSpot;
        $spot->season_id = $request->season;
        $spot->athlete_id =  $request->session()->get('athlete_id');
        $spot->save();

        $team = Team::find($request->session()->get('team_id'));

        return $this->showAccountSuccessful('You joined the ' . $team->school . ' ' . $team->name);
    }

    public function prChooseSeason(Request $request) {
        $request->session()->put('pr_season_id', $request->season);
        return view('register/complete-pr', ['team' => Team::find(session('pr_team_id'))]);
    }

    public function preRegisteredTeamID(Request $request) {
        $this->validate($request, [
            'team_id' => 'exists:team,id'
        ]);

        $request->session()->put('pr_team_id', $request->team_id);
        return view('register/choose-season', ['team' => Team::find($request->team_id), 'route' => 'pr-choose-season']);
    }

    public function showPreRegistered() {
        return view('register/pre-registered');
    }

    public function showLoginSuccessful() {
        return view('register/account-successful');
    }

    public function toSetupCoachOrAthlete(Request $request) {
        $this->validate($request, [
            'first_name' => 'max:255',
            'last_name' => 'max:255',
            'username' => 'max:255|unique:users',
            'password' => 'min:6|confirmed',
        ]);

        // save all user info in session
        $request->session()->put('first_name', $request->first_name);
        $request->session()->put('last_name', $request->last_name);
        $request->session()->put('username', $request->username);
        $request->session()->put('coach_or_athlete', $request->coach_or_athlete);
        $request->session()->put('gender', $request->gender);
        $request->session()->put('password', $request->password); 

        if ($request->coach_or_athlete)
            return redirect()->route('create-coach');
        else
            return redirect()->route('join-team');
    }

    public function showCreateCoach() {
        return view('register/create-coach');
    }

    public function createTeam(Request $request) {

        // register user
        $user_data = $request->session()->all();
        $user_id = $this->register($user_data);

        // validate team
        $this->validate($request, [
            'name' => 'max:255',
            'school' => 'max:255',
            'password' => 'min:6',
            'season_year' => 'regex:/(\d){4}/'
        ]);

        // register team
        $team = new Team;
        $team->name = $request->name;
        $team->school = $request->school;
        $team->password = bcrypt($request->password);
        $team->save();

        // register first season for team
        $season = new Season;
        $season->year = $request->season_year;
        $season->name = $request->season_name;
        $season->team_id = $team->id;
        $season->current = 1;
        $season->save();

        // register coach
        $coach = new Coach;
        $coach->title = $request->session()->get('coach-title');
        $coach->user_id = $user_id;
        $coach->head_coach_of = $team->id;
        $coach->save();

        return $this->showAccountSuccessful('Your team ID is: ' . $team->id, 'Your team password is: ' . $request->password);
    }
    
    public function joinTeam(Request $request) {
        $this->validate($request, [
            'team_id' => 'exists:team,id|integer',
            'grad_year' => 'nullable|regex:/(\d){4}/'
        ]);

        $team = Team::find($request->team_id);

        // register user
        $user_data = $request->session()->all();
        $user_id = $this->register($user_data);

        if ($request->session()->get('coach_or_athlete')) {
            if (!password_verify($request->password, $team->password)) return view('register/join-team', ['password_incorrect' => True]);
            $coach = new Coach;
            $coach->title = $request->session()->get('coach-title');
            $coach->user_id = $user_id;
            $coach->asst_coach_of = $team->id;
            $coach->save();
        } else {
            $athlete = new Athlete;
            
            $athlete->user_id = $user_id;
            $athlete->team_id = $team->id;
            $athlete->grad_year = $request->grad_year;
            $athlete->save();

            $request->session()->flash('team_id', $team->id);
            $request->session()->flash('athlete_id', $athlete->id);
            return view('register/choose-season', ['team' => $team, 'route' => 'choose-season']);
        }

        return $this->showAccountSuccessful('You joined the ' . $team->school . ' ' . $team->name);
    }

    public function showCreateTeam() {
        return view('register/create-team');
    }

    public function showJoinTeam() {
        return view('register/join-team', ['password_incorrect' => False]);
    }

    public function showRegistrationPage() {
        return view('register/register');
    }

    public function toSetupTeam(Request $request) {
        // only coaches will go here
        $request->session()->put('coach-title', $request->title);
		return view('register/register-team');
        
    }

    public function register(array $data) {
        // register user (both coaches and athletes)
        return (new Register)->registerArray($data);
    }
}
