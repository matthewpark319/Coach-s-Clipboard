<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Athlete;


class Team extends Model
{
    //
    protected $table = 'team';

    public function courses() {
        return DB::select("select * from xc_course where team_id = ?", [$this->id]);
    }

    public function returningAthletes($year, $season_name, $last_season) {
        $xc = strcmp($season_name, 'Cross Country') == 0;
        return DB::select("select a.id, grad_year, concat(u.first_name, ' ', u.last_name) as name
            from athlete a left join users u on a.user_id = u.id
            inner join roster_spot rs on rs.athlete_id = a.id
            where a.team_id = ? and rs.season_id = ?
            and grad_year >= if(?, ? + 1, ?)
            order by u.first_name, u.last_name", [$this->id, $last_season, $xc, $year, $year]);
    }

    public function setSeasonCurrent($season_id) {
        DB::table('season')->where('team_id', $this->id)->update(['current' => 0]);
        DB::update('update season set current = 1 where team_id = ? and id = ?', [$this->id, $season_id]);
        
        session(['season' => $season_id]);

        $currentSeason = DB::table('season')->where('id', $season_id)->first();
        session(['xc' => strcmp($currentSeason->name, 'Cross Country') == 0]);
    }

    public function allSeasons() {
        return DB::select("select * from season where team_id = ?", [$this->id]);
    }

    public function currentSeason() {
        return DB::select("select id, concat(name, ' ', year) as info, name from season where team_id = ? and current = 1", [$this->id])[0];
    }

    public function selectedSeason() {
        return DB::select("select id, concat(name, ' ', year) as info from season where id = ?", [session('season')])[0];
    }

    public function seasonsNotSelected() {
        return DB::select("select id, concat(name, ' ', year) as info from season where team_id = ? and id != ?", [$this->id, session('season')]);
    }

    public function headCoachName() {
        return DB::select("select concat(u.first_name, ' ', u.last_name) as name
            from coach c left join users u on c.user_id = u.id where head_coach_of = ?", [$this->id])[0]->name;
    }

    public function nonHeadCoaches() {
        return DB::select("select concat(u.first_name, ' ', u.last_name) as name
            from coach c left join users u on c.user_id = u.id where asst_coach_of = ?", [$this->id]);
    }

    public function rosterUnregistered($season) {
        return DB::select("select a.*, concat(u.first_name, ' ', u.last_name) as name, u.username
            from athlete a left join users u on a.user_id = u.id 
            inner join roster_spot rs on rs.athlete_id = a.id
            where a.team_id = ? and rs.season_id = ?
            and username is null
            order by u.first_name, u.last_name", [$this->id, $season]);
    }

    public function roster($gender = null) {
        if (!is_null($gender)) {
            return DB::select("select a.*, concat(u.first_name, ' ', u.last_name) as name, u.username
                from athlete a left join users u on a.user_id = u.id 
                inner join roster_spot rs on rs.athlete_id = a.id
                where a.team_id = ? and gender = ? and rs.season_id = ?
                order by u.first_name, u.last_name", [$this->id, $gender, session('season')]);
        } 
       	return DB::select("select a.*, concat(u.first_name, ' ', u.last_name) as name, u.username
            from athlete a left join users u on a.user_id = u.id 
            inner join roster_spot rs on rs.athlete_id = a.id
            where a.team_id = ? and rs.season_id = ?
            order by u.first_name, u.last_name", [$this->id, session('season')]);
    }

    public function schedule() {
    	return DB::select('select *, date_format(date, "%m/%d/%Y") as date_formatted from schedule_event 
            where team_id = ? and season_id = ? order by date', [$this->id, session('season')]);
    }

    public function scheduleComplete() {
        return DB::select('select * from schedule_event 
            where team_id = ? and complete = 1 and season_id = ?', [$this->id, session('season')]);
    }

    public function scheduleHome() {
    	return DB::select('select *, date_format(date, "%m/%d/%Y") as date_formatted from schedule_event 
            where team_id = ? and complete = 0 and season_id = ?
            order by date limit 3', [$this->id, session('season')]);
    }

    public function announcements() {
    	return DB::select("select a.id, date_format(a.date, '%m/%d/%Y') as date, time_format(time(a.date), '%l:%i %p') as time, a.text, concat(u.first_name, ' ', u.last_name) as coach
    		from announcement a left join team t on a.team_id = t.id
    		left join coach c on c.id = a.coach_id
    		left join users u on u.id = c.user_id
            where t.id = ?
            and season_id = ?", [$this->id, session('season')]);
    }

    public function announcementsHome() {
    	return DB::select("select date_format(a.date, '%m/%d/%Y') as date, time_format(time(a.date), '%l:%i %p') as time, a.text, concat(u.first_name, ' ', u.last_name) as coach
    		from announcement a left join team t on a.team_id = t.id
    		left join coach c on c.id = a.coach_id
    		left join users u on u.id = c.user_id 
            where t.id = ? 
            and season_id = ?
            order by date desc limit 3", [$this->id, session('season')]);
    }

    public function teamBestsXC($event_id, $gender, $course_id = null) {
        $season_id = session('season');

        if (is_null($course_id)) {            
            return DB::select("select concat(min(p.result), ' - ', u.first_name, ' ', u.last_name) as result
                from performance p left join athlete a on p.athlete_id = a.id
                left join schedule_event s on p.meet_id = s.id
                left join users u on a.user_id = u.id
                inner join roster_spot rs on rs.athlete_id = a.id
                where p.event_id = ? and p.team_id = ?
                and u.gender = ?
                and s.season_id = ?
                and rs.season_id = ?
                group by u.id
                order by result", [$event_id, $this->id, $gender, $season_id, $season_id]);
        }

        return DB::select("select concat(min(p.result), ' - ', u.first_name, ' ', u.last_name) as result
                from performance p left join athlete a on p.athlete_id = a.id
                left join schedule_event s on p.meet_id = s.id
                left join users u on a.user_id = u.id
                inner join roster_spot rs on rs.athlete_id = a.id
                where p.event_id = ? and p.team_id = ?
                and u.gender = ?
                and s.season_id = ?
                and rs.season_id = ?
                and s.xc_course_id = ?
                group by u.id
                order by result", [$event_id, $this->id, $gender, $season_id, $season_id, $course_id]);
    }

    public function teamBests($event_id, $gender, $include_relays = False) {
        $event = \App\Event::find($event_id);
        $season_id = session('season');

        if ($event->open) {
            if ($include_relays) {
                return DB::select("select concat(min(p.result), ' - ', u.first_name, ' ', u.last_name) as result
                    from performance p left join athlete a on p.athlete_id = a.id
                    left join schedule_event s on s.id = p.meet_id
                    left join users u on a.user_id = u.id
                    inner join roster_spot rs on rs.athlete_id = a.id
                    where p.event_id = ? and p.team_id = ?
                    and u.gender = ?
                    and s.season_id = ?
                    and rs.season_id = ?
                    group by u.id
                    order by result", [$event_id, $this->id, $gender, $season_id, $season_id]); 
            }
            return DB::select("select concat(min(p.result), ' - ', u.first_name, ' ', u.last_name) as result
                from performance p left join athlete a on p.athlete_id = a.id
                left join schedule_event s on p.meet_id = s.id
                left join users u on a.user_id = u.id
                inner join roster_spot rs on rs.athlete_id = a.id
                where p.event_id = ? and p.team_id = ?
                and p.relay_leg is null
                and u.gender = ?
                and s.season_id = ?
                and rs.season_id = ?
                group by u.id
                order by result", [$event_id, $this->id, $gender, $season_id, $season_id]); 
        } 

        return DB::select("select concat(result, ' - ', group_concat(name order by performance_id separator ', ')) as result from 
            (select r.result, u.name, r.id as relay_id, p.id as performance_id from relay r 
            left join performance p on p.id in (r.first_leg, r.second_leg, r.third_leg, r.fourth_leg)
            left join schedule_event s on s.id = p.meet_id
            left join athlete a on p.athlete_id = a.id
            left join (select id, concat(first_name, ' ', last_name) as name, gender from users) as u on a.user_id = u.id 
            inner join roster_spot rs on rs.athlete_id = a.id
            where r.event_id = ?
            and r.team_id = ?
            and u.gender = ?
            and s.season_id = ?
            and rs.season_id = ?) as result
            group by result.relay_id
            order by result", [$event_id, $this->id, $gender, $season_id, $season_id]);
    }
    
    // roster without athlete logged in
    public function teammates($athlete_id) {
        return DB::select("select a.*, concat(u.first_name, ' ', u.last_name) as name
            from athlete a left join users u on a.user_id = u.id 
            inner join roster_spot rs on rs.athlete_id = a.id
            where a.team_id = ? and a.id != ? 
            and rs.season_id = ?
            order by u.first_name, u.last_name", [$this->id, $athlete_id, session('season')]);
    }
}
