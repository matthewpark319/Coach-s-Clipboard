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
			                <option value="100m" class="sprints">100m</option>
			                <option value="200m" class="sprints">200m</option>
			                <option value="400m" class="sprints">400m</option>
			                <option value="800m" class="distance">800m</option>
			                <option value="1600m" class="distance">1600m</option>
			                <option value="3200m" class="distance">3200m</option>
			                <option value="400 Hurdles" class="sprints">400 Hurdles</option>
			                <option value="110 Hurdles" class="sprints">110 Hurdles</option>
			                <option value="100 Hurdles" class="sprints">100 Hurdles</option>
			                <option value="Shotput" class="field">Shotput</option>
			                <option value="Javelin" class="field">Javelin</option>
			                <option value="Discus" class="field">Discus</option>
			                <option value="Long Jump" class="field">Long Jump</option>
			                <option value="High Jump" class="field">High Jump</option>
			                <option value="Triple Jump" class="field">Triple Jump</option>
			                <option value="Pole Vault" class="field">Pole Vault</option>
						</select>
					</div>
				</form>
			</div>
			@if (isset($event))
				<div class="list-container" style="margin-top:30px">
					<ul class="list-group">
					@foreach ($team->teamBestsBoys($event) as $p)
						<li class="list-group-item">{{ $p->result . ' - ' . $p->athlete_name}}
					@endforeach
					</ul>
				</div>

				<div class="list-container" style="margin-top:30px">
					<ul class="list-group">
					@foreach ($team->teamBestsGirls($event) as $p)
						<li class="list-group-item">{{ $p->result . ' - ' . $p->athlete_name}}
					@endforeach
					</ul>
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
</div>

@endsection