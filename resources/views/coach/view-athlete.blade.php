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
			<ul style="margin-left:50px">
				@foreach ($athlete->performances() as $p)
					<li>{{ $p->result . ', ' . $p->event . ' at ' . $p->name}}</li>
				@endforeach
			</ul>
		</div>
	</div>
</div>
@endsection