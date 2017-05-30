<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relay extends Model
{
    //
    protected $table = 'relay';

    public function getRelayLegPerformances() {
    	echo(":dagsd");
    	return \DB::select('select p.id from performance p
			left join relay r on p.id in (r.first_leg, r.second_leg, r.third_leg, r.fourth_leg)
			where r.id = ?', [$this->id]);
    }
}
