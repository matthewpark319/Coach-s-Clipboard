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

    public function performances($season_id = null) {
        if (!is_null($season_id)) {
            return DB::select("select n.current, p.id, p.has_splits, s.season_id from athlete a left join performance p on a.id = p.athlete_id
                left join schedule_event s on p.meet_id = s.id
                left join season n on n.id = s.season_id
                where a.id = ?
                and s.season_id = ?
                order by n.current desc, s.season_id, s.date", [$this->id, $season_id]);
        } return DB::select("select n.current, p.id, p.has_splits, s.season_id from athlete a left join performance p on a.id = p.athlete_id
            left join schedule_event s on p.meet_id = s.id
            left join season n on n.id = s.season_id
            where a.id = ?
            order by n.current desc, s.season_id, s.date", [$this->id]);
    }
}
