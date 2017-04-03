@extends('layouts.coach-home')

@section('content')

<div class="main">
	<div class="top-header-container">
		<h2 class="top-header">Team: {{ $team->school . " " . $team->name }}</h2>
	</div>

	<div class="home-section-container">
		<h3 class="home-section-header">Latest Announcements</h3>
		<div class="container-lg">
			<table class="table table-bordered table-hover roster-table">
	            <col style="width:10%">
	            <col style="width:10%">
	            <col style="width:10%">
	            <col style="width:70%">
	            <thead>
	                <th>Date</th>
	                <th>Time</th>
	                <th>Coach</th>
	                <th>Announcement</th>
	            </thead>
	            <tbody>
	                @foreach ($team->announcementsHome() as $announcement)
	                    <tr>
	                        <td>{{ $announcement->date }}</td>
	                        <td>{{ $announcement->time }}</td>
	                        <td>{{ $announcement->coach }}</td>
	                        <td>{{ $announcement->text }}</td>
	                    </tr>
	                @endforeach
	            </tbody>
	        </table>
		</div>
		
	</div>

	<div class="home-section-container">
		<h3 class="home-section-header">Upcoming Schedule</h3>
		<div class="container-lg">
			<table class="table table-bordered table-hover roster-table">
	            <col style="width:25%">
	            <col style="width:25%">
	            <col style="width:25%">
	            <col style="width:25%">
	            <thead>
	                <th>Name</th>
	                <th>Date</th>
	                <th>Location</th>
	                <th>Importance</th>
	            </thead>
	            <tbody>
	                @foreach ($team->scheduleHome() as $entry)
	                    @if ($entry->importance == 0)
	                        <tr class="success">
	                            <td>{{ $entry->name }}</td>
	                            <td>{{ $entry->date_formatted }}</td>
	                            <td>{{ $entry->location }}</td>
	                            <td>Low</td>
	                        </tr>
	                    @elseif ($entry->importance == 1)
	                        <tr class="warning">
	                            <td>{{ $entry->name }}</td>
	                            <td>{{ $entry->date_formatted }}</td>
	                            <td>{{ $entry->location }}</td>
	                            <td>Medium</td>
	                        </tr>
	                    @else 
	                        <tr class="danger">
	                            <td>{{ $entry->name }}</td>
	                            <td>{{ $entry->date_formatted }}</td>
	                            <td>{{ $entry->location }}</td>
	                            <td>High</td>
	                        </tr>
	                    @endif
	                @endforeach
	            </tbody>
            </table>
        </div>
	</div>
</div>
@endsection