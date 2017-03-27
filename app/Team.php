<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Athlete;


class Team extends Model
{
    //
    protected $table = 'team';

    public function roster() {
       	return DB::select("select a.*, concat(u.first_name, ' ', u.last_name) as name
       	from athlete a left join users u on a.user_id = u.id where a.team = ? order by a.events", [$this->id]);
    }

    public function schedule() {
    	
    }
}
