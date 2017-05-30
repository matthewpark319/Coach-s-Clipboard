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
       	    from athlete a left join users u on a.user_id = u.id where a.team = ? order by u.first_name, u.last_name", [$this->id]);
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
    		left join users u on u.id = c.user_id
            where t.id = ?", [$this->id]);
    }

    public function announcementsHome() {
    	return DB::select("select date_format(a.date, '%m/%d/%Y') as date, time_format(time(a.date), '%l:%i %p') as time, a.text, concat(u.first_name, ' ', u.last_name) as coach
    		from announcement a left join team t on a.team_id = t.id
    		left join coach c on c.id = a.coach_id
    		left join users u on u.id = c.user_id where t.id = ? 
            order by date desc limit 3", [$this->id]);
    }

    public function teamBests($event_id, $gender) {
        $event = \App\Event::find($event_id);
        if ($event->open) {
            return DB::select("select concat(min(p.result), ' - ', u.first_name, ' ', u.last_name) as result
                from performance p left join athlete a on p.athlete_id = a.id
                left join users u on a.user_id = u.id
                where p.event_id = ? and p.team_id = ?
                and p.relay_leg is null
                and u.gender = ?
                group by u.id
                order by result", [$event_id, $this->id, $gender]); 
        } 

        return DB::select("select concat(result, ' - ', group_concat(name order by performance_id separator ', ')) as result from 
            (select r.result, u.name, r.id as relay_id, p.id as performance_id from relay r 
            left join performance p on p.id in (r.first_leg, r.second_leg, r.third_leg, r.fourth_leg)
            left join athlete a on p.athlete_id = a.id
            left join (select id, concat(first_name, ' ', last_name) as name, gender from users) as u on a.user_id = u.id 
            where r.event_id = ?
            and r.team_id = ?
            and u.gender = ?) as result
            group by result.relay_id
            order by result", [$event_id, $this->id, $gender]);

        
    }
    
    // roster without athlete logged in
    public function teammates($athlete_id) {
        return DB::select("select a.*, concat(u.first_name, ' ', u.last_name) as name
            from athlete a left join users u on a.user_id = u.id where a.team = ? 
            and a.id != ?
            order by u.first_name, u.last_name", [$this->id, $athlete_id]);
    }
}
