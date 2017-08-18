@extends('layouts.athlete-home')

@section('content')

<div class="main">
	<div class="top-header-container">
		<div class="header-center">
			<h2 class="top-header">Results</h2>
		</div>

		<div class="select-right">
			<select id="season" onchange="changeSeason('results')">
				<option value="{{ $team->selectedSeason()->id }}">{{ $team->selectedSeason()->info }}</option>
				@foreach ($team->seasonsNotSelected() as $season) 
					<option value="{{ $season->id }}">{{ $season->info }}</option>
				@endforeach
			</select>
		</div>
	</div>

	<div class="half-page">
		<div class="half-header-container">
			<div class="header-center">
				<h3 class="top-header">Team Bests</h3>
			</div>
		</div>

		<div class="half-content">
			<div class="container">
				<div class="col-md-2">
					<select id="event" name="event" class="form-control" onchange="showTeamBests()">
						<option value="">-- Select Event --</option>

                        @foreach (\App\Event::all() as $e)
                            <option id="{{ $e->id }}" value="{{ $e->id }}" class="{{ $e->type }}">{{ $e->name }}</option> 
                        @endforeach
					</select>
				</div>

				<p class="inline-block" for="include_relays" style="margin-top:7px">Include Relay Splits</p>
				<input id="include_relays" type="checkbox">
			</div>
			@if (isset($event))
				<div class="list-container" style="margin-top:30px">
					<h4>Boys</h4>
					@if (count($team->teamBests($event->id, 1, $include_relays)) == 0)
						<h5>No Results</h5>
					@else
						<ul class="list-group">
						@foreach ($team->teamBests($event->id, 1, $include_relays) as $p)
							<li class="list-group-item">{{ $p->result }}</li>
						@endforeach
						</ul>
					@endif
				</div>

				<div class="list-container" style="margin-top:30px">
					<h4>Girls</h4>
					@if (count($team->teamBests($event->id, 0, $include_relays)) == 0)
						<h5>No Results</h5>
					@else
						<ul class="list-group">
						@foreach ($team->teamBests($event->id, 0, $include_relays) as $p)
							<li class="list-group-item">{{ $p->result }}</li>
						@endforeach
						</ul>
					@endif
				</div>

				<script>
					$(document).ready(function(){
						var selectedId = "#" + "{{ $event->id }}";
					    $(selectedId).attr("selected", "selected");
					});
				</script>
			@else 
				<div class="list-container">
					<h4>Team leading performances (excluding relay splits) will appear here after event is selected.</h4>
				</div>
			@endif

		</div>
	</div>

	<div class="half-page">
		<div class="half-header-container">
			<div class="header-center">
				<h2 class="top-header">Meet Results</h2>
			</div>
		</div>

		<div class="half-content">
			<div class="list-container-scroll">
				<ul class="list-group">
					@foreach($team->scheduleComplete() as $s) 
						<a href="{{ route('athlete-view-meet', ['meet' => $s->id]) }}" class="list-group-item">{{ $s->name }}</a>
					@endforeach
				</ul>
			</div>
			
		</div>
	</div>
</div>

<script>
function showTeamBests() {
	if ($('#event').val()) {
		@if (isset($include_relays))
			window.location.href = "/athlete/results/team-bests/" + $("#event option:selected").val() + "/{{ $include_relays }}";
		@else
			window.location.href = "/athlete/results/team-bests/" + $("#event option:selected").val() + "/";
		@endif
	} else {
		window.location.href = "{{ route('athlete-results') }}"; 
	}
}

@if (isset($event))
$('#include_relays').change(function() {
	window.location.href = "{{ route('athlete-team-bests', ['event' => $event, 'include_relays' => !$include_relays ]) }}";
});
	@if ($include_relays)
	$(document).ready(function(){
		$('#include_relays').attr('checked', 'checked');
	});
	@endif
@endif
</script>
@endsection