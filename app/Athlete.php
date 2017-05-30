<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Athlete extends Model
{
    //
    protected $table = 'athlete';

    public function name() {
    	$user = \App\User::find($this->user_id);
    	return $user->first_name . ' ' . $user->last_name;
    }

    public function performances() {
        return DB::select("select p.id, p.has_splits from athlete a left join performance p on a.id = p.athlete_id
            left join schedule_event s on p.meet_id = s.id
            where a.id = ?
            order by s.date", [$this->id]);
    	// return DB::select("select p.id, p.result, p.relay_leg, p.has_splits, e.name as event, e.type as event_type, s.name as meet, e2.name as relay_name
     //        from performance p left join athlete a on p.athlete_id = a.id
     //        left join schedule_event s on p.meet_id = s.id
     //        left join event e on p.event_id = e.id
     //        left join relay r on (r.first_leg = p.id or r.second_leg = p.id or r.third_leg = p.id or r.fourth_leg = p.id)
     //        left join event e2 on r.event_id = e2.id
     //        where p.athlete_id = ?", [$this->id]);
    }
}
