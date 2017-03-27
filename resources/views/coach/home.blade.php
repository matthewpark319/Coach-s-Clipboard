@extends('layouts.home')

@section('content')
<div class="navbar-wrapper">
    <div class="navbar-container">
        <ul class="nav nav-tabs">
            <li id="home" class="active"><a href="{{ route('coach-home') }}">Home</a></li>
            <li id="roster"><a href="{{ route('coach-roster') }}">Roster</a></li>
            <li id="schedule"><a href="#">Schedule</a></li>
            <li id="results"><a href="#">Results</a></li>
            <li id="announcements"><a href="#">Announcements</a></li>
        </ul>
    </div>
    <div class="navbar-filler"></div>
</div>

<div class="main">
	<div class="team-header-container">
		<h2 class="team-header">Team: {{ $team->school . " " . $team->name }}</h2>
	</div>

	<div class="home-section-container">
		<h3 class="home-section-header">Latest Announcements</h3>
	</div>

	<div class="home-section-container">
		<h3 class="home-section-header">Upcoming Schedule</h3>
	</div>
</div>
@endsection