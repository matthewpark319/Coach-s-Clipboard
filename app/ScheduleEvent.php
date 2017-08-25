<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Event;

class ScheduleEvent extends Model
{
    //
    protected $table = 'schedule_event';

    public function resultsIndividual($event, $gender) {
    	return DB::select("select p.id, p.result, concat(u.first_name, ' ', u.last_name) as name, p.relay_leg, p.has_splits 
			from performance p left join athlete a on p.athlete_id = a.id
			left join users u on a.user_id = u.id
			where meet_id = ?
			and p.event_id = ?
			and p.relay_leg is null
			and u.gender = ?", [$this->id, $event, $gender]);
    }

    public function resultsRelay($event, $gender) {
    	return DB::select("select p.id as performance_id, r.id as relay_id, concat(p.relay_leg, ' leg (', e.name, ') - ', u.first_name, ' ', u.last_name, ', ', p.result) as result, 
    		p.relay_leg, r.result as total_time, p.has_splits from performance p
			left join relay r on p.id in (r.first_leg, r.second_leg, r.third_leg, r.fourth_leg)
			left join athlete a on p.athlete_id = a.id
			left join users u on a.user_id = u.id
			left join event e on p.event_id = e.id
			where p.meet_id = ?
			and p.relay_leg is not null
			and r.event_id = ?
			and u.gender = ?
			order by r.id", [$this->id, $event, $gender]);
    }

    public function resultsXC($event, $gender) {
    	return DB::select("select p.id, p.result, concat(u.first_name, ' ', u.last_name) as name
			from performance p left join athlete a on p.athlete_id = a.id
			left join users u on a.user_id = u.id
			where meet_id = ?
			and p.event_id = ?
			and p.relay_leg is null
			and u.gender = ?", [$this->id, $event, $gender]);
    }

    public function courseName() {
    	return DB::select("select x.name from schedule_event m
			left join xc_course x on m.xc_course_id = x.id
			where m.id = ?", [$this->id])[0]->name;
    }
}
