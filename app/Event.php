<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Event extends Model
{
    //
    protected $table = 'event';

    public static function getIndividualEvents() {
    	return DB::select("select * from event where open = 1");
    }

    public static function getRelayEvents() {
    	return DB::select("select * from event where type = 3");
    }

    public static function getRelayLegs($relay_id) {
        $legs = DB::select("select event_first_leg, event_second_leg, event_third_leg, event_fourth_leg from event where id = ?", [$relay_id])[0];
			
		return array(parent::find($legs->event_first_leg),
            parent::find($legs->event_second_leg),
            parent::find($legs->event_third_leg),
            parent::find($legs->event_fourth_leg));
    }
}
