@extends('layouts.home')

@section('content')
<div class="navbar-wrapper">
    <div class="navbar-container">
        <ul class="nav nav-tabs">
            <li><a href="{{ route('coach-home') }}">Home</a></li>
            <li class="active"><a href="{{ route('coach-roster') }}">Roster</a></li>
            <li><a href="#">Schedule</a></li>
            <li><a href="#">Results</a></li>
            <li><a href="#">Announcements</a></li>
        </ul>
    </div>
    <div class="navbar-filler"></div>
</div>

<div class="main">
	<div class="team-header-container">
		<h2 class="team-header">Roster</h2>
	</div>

	<div class="roster-container">
        <table class="table table-bordered table-hover roster-table">
            <col style="width:50%">
            <col style="width:50%">
            <thead>
                <th>Name</th>
                <th>Events</th>
            </thead>
            <tbody>
                @foreach ($team->roster() as $athlete)
                    <tr>
                        <td><a href="{{ route('coach-view-athlete', ['athlete' => $athlete->id]) }}">{{ $athlete->name }}</a></td>
                        <td><a>{{ $athlete->events }}</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
	</div>
</div>
@endsection