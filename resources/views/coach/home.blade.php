@extends('layouts.home')

@section('content')

<div class="main">
	<div class="top-header-container">
		<h2 class="top-header">Team: {{ $team->school . " " . $team->name }}</h2>
	</div>

	<div class="home-section-container">
		<h3 class="home-section-header">Latest Announcements</h3>
	</div>

	<div class="home-section-container">
		<h3 class="home-section-header">Upcoming Schedule</h3>
	</div>
</div>
@endsection