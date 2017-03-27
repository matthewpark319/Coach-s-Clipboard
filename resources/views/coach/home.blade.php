@extends('layouts.home')

@section('content')
<div class="navbar-wrapper">
    <div class="navbar-container">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="{{ route('coach-roster') }}">Roster</a></li>
            <li><a href="#">Schedule</a></li>
            <li><a href="#">Results</a></li>
            <li><a href="#">Announcements</a></li>
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