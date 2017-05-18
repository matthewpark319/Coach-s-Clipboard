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
    	return DB::select("select * from event where open = 0");
    }

    public static function getRelayLegs($relay_id) {
    	$leg = null;
    	if ($relay_id == 17) $leg = parent::find(1);
		else if ($relay_id == 18) $leg = parent::find(2);
		else if ($relay_id == 19) $leg = parent::find(3);
		else if ($relay_id == 20) $leg = parent::find(4);
		else if ($relay_id == 21) $leg = parent::find(5);
		else if ($relay_id == 22) return (array(parent::find(24), parent::find(3), parent::find(4), parent::find(6)));
		else if ($relay_id == 23) return (array(parent::find(3), parent::find(2), parent::find(2), parent::find(4)));
			
		return array($leg, $leg, $leg, $leg);
    }
}
