@extends('layouts.home')

@section('content')
<div class="navbar-wrapper">
    <div class="navbar-container">
        <ul class="nav nav-tabs">
            <li><a href="../home">Home</a></li>
            <li class="active"><a href="roster">Roster</a></li>
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
		
	</div>
</div>
@endsection