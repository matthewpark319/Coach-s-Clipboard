<?php

use Illuminate\Database\Seeder;

class RosterSpotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        echo('hello');
        foreach (\DB::select('select * from athlete where team_id = 5') as $athlete) {
        	\DB::table('roster_spot')->insert([
	            'athlete_id' => $athlete->id,
	            'season_id' => 1,
	        ]);
        }
        
    }
}
