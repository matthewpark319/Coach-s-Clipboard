@extends('layouts.coach-home')

@section('content')
<div class="main">
	<div class="top-header-container">
		<h2 class="top-header">Athlete Profile: {{ $athlete->name() }}</h2>
	</div>

	<div class="content-container-lg">
		<div class="form-container">
			<h4 class="info">Level: {{ $athlete->level }}</h4>
			<h4 class="info">Events: {{ $athlete->events }}</h4>
			<h4 class="info">Performances: </h4>
			<div class="list-container">
				<ul class="list-group">
					@foreach ($athlete->performances() as $p)
						@if ($p->relay_leg == null)
							<li class="list-group-item">{{ $p->result . ', ' . $p->event . ' at ' . $p->meet . $p->relay_leg}}</li>
						@else
							<li class="list-group-item">{{ $p->result . ', ' . $p->event . ', ' . $p->relay_leg . ' leg of ' . $p->relay_name . ' at ' . $p->meet}}
						@endif
					@endforeach
				</ul>
			</div>
			<a class="btn btn-default add-button" href="{{ route('coach-roster') }}">Back</a>
		</div>


	</div>
</div>
@endsection