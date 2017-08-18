<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'username', 'coach_or_athlete', 'gender', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getTeamID() {
        if ($this->coach_or_athlete) {
            $coach = \App\Coach::where('user_id', $this->id)->first();

            if ($coach->asst_coach_of == null) return $coach->head_coach_of;
            return $coach->asst_coach_of;
        } else {
            $athlete = \App\Athlete::where('user_id', $this->id)->first();
            return $athlete->team_id;
        }
    }
}
