<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Athlete extends Model
{
    //
    protected $table = 'athlete';

    public function name() {
    	$user = \App\User::find($this->user_id);
    	return $user->first_name . ' ' . $user->last_name;
    }
}
