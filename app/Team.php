<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Athlete;


class Team extends Model
{
    //
    protected $table = 'team';

    public function roster() {
       	return DB::select("select a.*, concat(u.first_name, ' ', u.last_name) as name
       	    from athlete a left join users u on a.user_id = u.id where a.team = ? order by a.events", [$this->id]);
    }

    public function schedule() {
    	return DB::select('select *, date_format(date, "%m/%d/%Y") as date_formatted from schedule_event where team_id = ? order by date', [$this->id]);
    }

    public function scheduleComplete() {
        return DB::select('select * from schedule_event where team_id = ? and complete = 1', [$this->id]);
    }

    public function scheduleHome() {
    	return DB::select('select *, date_format(date, "%m/%d/%Y") as date_formatted from schedule_event where team_id = ? and complete = 0 order by date limit 3', [$this->id]);
    }

    public function announcements() {
    	return DB::select("select a.id, date_format(a.date, '%m/%d/%Y') as date, time_format(time(a.date), '%l:%i %p') as time, a.text, concat(u.first_name, ' ', u.last_name) as coach
    		from announcement a left join team t on a.team_id = t.id
    		left join coach c on c.id = a.coach_id
    		left join users u on u.id = c.user_id");
    }

    public function announcementsHome() {
    	return DB::select("select date_format(a.date, '%m/%d/%Y') as date, time_format(time(a.date), '%l:%i %p') as time, a.text, concat(u.first_name, ' ', u.last_name) as coach
    		from announcement a left join team t on a.team_id = t.id
    		left join coach c on c.id = a.coach_id
    		left join users u on u.id = c.user_id order by date desc limit 3");
    }

    public function teamBestsBoys($event) {
        return DB::select("select concat(u.first_name, ' ', u.last_name) as athlete_name, min(p.result) as result
            from performance p left join athlete a on p.athlete_id = a.id
            left join users u on a.user_id = u.id
            where p.event_id = ? and p.team_id = ?
            and u.gender = 1
            group by u.id
            order by result", [$event, $this->id]);
    }

    public function teamBestsGirls($event) {
        return DB::select("select concat(u.first_name, ' ', u.last_name) as athlete_name, min(p.result) as result
            from performance p left join athlete a on p.athlete_id = a.id
            left join users u on a.user_id = u.id
            where p.event_id = ? and p.team_id = ?
            and u.gender = 0
            group by u.id
            order by result", [$event, $this->id]);
    }

    // roster without athlete logged in
    public function teammates($athlete_id) {
        return DB::select("select a.*, concat(u.first_name, ' ', u.last_name) as name
            from athlete a left join users u on a.user_id = u.id where a.team = ? 
            and a.id != ?
            order by a.events", [$this->id, $athlete_id]);
    }
}
