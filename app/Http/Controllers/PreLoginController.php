<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PreLoginController extends Controller
{
    //
    public function toSetupTeam(Request $request) {
    	$this->validate($request, [
            'email' => 'email|max:255|unique:users',
            'password' => 'min:6|confirmed',
		]);

    	if ($request->coach_or_athlete) 
			return view('Auth\register_team', ['registered' => $request]);
		else 
			return view('Auth\join_team', ['registered' => $request]);
    }
}
