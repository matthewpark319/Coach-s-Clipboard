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
    	return DB::select("select p.result, concat(u.first_name, ' ', u.last_name) as name 
			from performance p left join athlete a on p.athlete_id = a.id
			left join users u on a.user_id = u.id
			where meet_id = ?
			and p.event_id = ?
			and p.relay_leg is null
			and u.gender = ?", [$this->id, $event, $gender]);
    }

    public function resultsRelay($event, $gender) {
    	return DB::select("select p.result, concat(u.first_name, ' ', u.last_name) as name, e.name as distance, p.relay_leg, r.result as total_time from performance p
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
}
