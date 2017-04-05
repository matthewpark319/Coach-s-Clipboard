@extends('layouts.coach-home')

@section('content')

<div class="main">
	<div class="top-header-container">
		<h2 class="top-header">Results</h2>
	</div>

	<div class="half-page">
		<div class="half-header-container">
			<h3 class="top-header">Team Bests</h3>
		</div>

		<div class="half-content">
			<div class="container">

				<form id="event" method="post">
					{{ csrf_field() }}
					<div class="col-md-2">
						<select name="event" class="form-control" onchange="document.getElementById('event').submit();">
							<option value="">-- Select Event --</option>

                            @foreach (\App\ScheduleEvent::getEvents() as $e)
                                <option id="{{ $e->id }}" value="{{ $e->id }}" class="{{ $e->type }}">{{ $e->name }}</option> 
                            @endforeach
						</select>
					</div>
				</form>
			</div>
			@if (isset($event))
				<div class="list-container" style="margin-top:30px">
					<h4>Boys</h4>
					@if (count($team->teamBestsBoys($event)) == 0)
						<h5>No Results</h5>
					@else
						<ul class="list-group">
						@foreach ($team->teamBestsBoys($event) as $p)
							<li class="list-group-item">{{ $p->result . ' - ' . $p->athlete_name}}
						@endforeach
						</ul>
					@endif
				</div>

				<div class="list-container" style="margin-top:30px">
					<h4>Girls</h4>
					@if (count($team->teamBestsGirls($event)) == 0)
						<h5>No Results</h5>
					@else
						<ul class="list-group">
						@foreach ($team->teamBestsGirls($event) as $p)
							<li class="list-group-item">{{ $p->result . ' - ' . $p->athlete_name}}
						@endforeach
						</ul>
					@endif
				</div>

			@else 
				<div class="list-container">
					<h4>Team leading performances will appear here after event is selected.</h4>
				</div>
			@endif

		</div>
	</div>

	<div class="half-page">
		<div class="half-header-container">
			<h3 class="top-header">Meet Results</h3>
		</div>

		<div class="half-content">
			<div class="list-container">
				<ul class="list-group">
					@foreach($team->scheduleComplete() as $s) 
						<a href="{{ route('coach-view-meet', ['meet' => $s->id]) }}" class="list-group-item">{{ $s->name }}</a>
					@endforeach
				</ul>
			</div>
			
		</div>
	</div>
	<h1>{{ old('event') }}</h1>
</div>

<script>
$(document).ready(function(){
	var selectedId = "#" + "{{ $event }}";
    $(selectedId).attr("selected", "selected");
});
</script>
@endsection