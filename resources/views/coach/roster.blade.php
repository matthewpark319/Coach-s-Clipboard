@extends('layouts.coach-home')

@section('content')
<div class="main">
	<div class="top-header-container">
		<div class="header-center">
            <h2 class="top-header">Team</h2>
        </div>

        <div class="select-right">
            <select id="season" onchange="changeSeason('roster')">
                <option value="{{ $team->selectedSeason()->id }}">{{ $team->selectedSeason()->info }}</option>
                @foreach ($team->seasonsNotSelected() as $season) 
                    <option value="{{ $season->id }}">{{ $season->info }}</option>
                @endforeach
            </select>
        </div>
	</div>

	<div class="half-page">
        <div class="half-header-container">
            @if (session('season') == $team->currentSeason()->id)
                <div class="header-link float-left" style="left:10%">
                    <a href="{{ route('manage-team') }}" class="btn-default btn vertical-align-center">Manage Team</a>
                </div>
            
                <div class="header-center" style="left:10%">
                    <h3 class="top-header" style="top:20%">Roster</h3>
                </div>
            
                <div class="header-link float-right" style="right:10%">
                    <a href="{{ route('add-athlete') }}" class="btn-default btn vertical-align-center">Add Athlete</a>
                </div>
            @else 
                <div class="header-center" style="left:30%">
                    <h3 class="top-header" style="top:20%">Roster</h3>
                </div>
                <h5 class="margin-left" style="text-align:center">Choose current season to manage roster</h5>
            @endif
        </div>
        <div class="half-content">
            <div class="list-container-scroll">
                @if (count($team->roster()) > 0)
                    <table class="table table-bordered table-hover">
                        <col style="width:33%">
                        <col style="width:33%">
                        <col style="width:34%">
                        <thead>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Class Of</th>
                        </thead>
                        <tbody>
                            @foreach ($team->roster() as $athlete)                               
                                @if (is_null($athlete->username))
                                    <tr class="danger">
                                        <td><a href="{{ route('coach-view-athlete', ['athlete' => $athlete->id]) }}">{{ $athlete->name }}</a></td>
                                        <td>Not Registered</td>
                                        <td>{{ $athlete->grad_year }}</td>
                                    </tr>
                                @else 
                                    <tr>
                                        <td><a href="{{ route('coach-view-athlete', ['athlete' => $athlete->id]) }}">{{ $athlete->name }}</a></td>
                                        <td>{{ $athlete->username }}</td>
                                        <td>{{ $athlete->grad_year }}</td>
                                    </tr>
                                @endif                
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <h4>No athletes on roster</h4>
                @endif
            </div>
        </div>
        
	</div>

    <div class="half-page">
        <div class="half-header-container">
            <div class="header-center">
                <h3 class="top-header">Team Info</h3>
            </div>
        </div>

        <div class="half-content">
            <h4 class="info">School: {{ $team->school }}</h4>
            <h4 class="info">Team Name: {{ $team->name }}</h4>
            <h4 class="info">Head Coach: {{ $team->headCoachName() }}</h4>
            @foreach ($team->nonHeadCoaches() as $c)
                <h4 class="info">Assistant Coach: {{ $c->name }}</h4>
            @endforeach
            <h4 class="info">Team ID: {{ $team->id }}</h4>
            <h4 class="info">Team Password: {{ $team->password }}</h4>
        </div>
        
    </div>
</div>
@endsection