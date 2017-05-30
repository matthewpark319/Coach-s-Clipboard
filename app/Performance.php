<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Performance extends Model
{
    //
    protected $table = 'performance';

    public function getRaceInfo() {
    	return DB::select("select concat(event, ' at ' , meet_name, if(relay_leg is null, '', concat(', ', relay_leg, ' leg'))) as info from

			(select s.name as meet_name, p.relay_leg, e.name as event from performance p
			left join schedule_event s on p.meet_id = s.id
			left join event e on if(p.relay_leg is null, p.event_id, 
			(select event_id from relay where p.id in (first_leg, second_leg, third_leg, fourth_leg))) = e.id
			where p.id = ?) as info", [$this->id])[0]->info;
    }

    public function getRaceResult() {
    	return DB::select("select result from performance where id = ?", [$this->id])[0]->result;
    }

    public function splits() {
    	return DB::select("select s.time from performance p 
			left join split s on p.id = s.performance_id
			where p.id = ?", [$this->id]);
    }

    public function athleteName() {
    	return DB::select("select concat(u.first_name, ' ', u.last_name) as name
			from performance p left join athlete a on p.athlete_id = a.id
			left join users u on u.id = a.user_id 
			where p.id = ?", [$this->id])[0]->name;
    }
}
