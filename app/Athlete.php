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
    	return DB::select("select p.result, p.event, s.name
    		from performance p left join athlete a on p.athlete_id = a.id
    		left join schedule_event s on p.meet_id = s.id
    		where p.athlete_id = ?", [$this->id]);
    }
}
