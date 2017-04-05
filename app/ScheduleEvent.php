<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Event;

class ScheduleEvent extends Model
{
    //
    protected $table = 'schedule_event';

    public function results($event, $gender) {
    	return DB::select("select p.result, concat(u.first_name, ' ', u.last_name) as name 
			from performance p left join athlete a on p.athlete_id = a.id
			left join users u on a.user_id = u.id
			where meet_id = ?
			and p.event_id = ?
			and u.gender = ?", [$this->id, $event, $gender]);
    }

    public static function getEvents() {
    	return Event::all();
    }
}
