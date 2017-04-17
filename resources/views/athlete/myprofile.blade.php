@extends('layouts.athlete-home')

@section('content')
<div class="main">
	<div class="top-header-container">
		<h2 class="top-header">My Profile</h2>
	</div>

	<div class="content-container-lg">
		<div class="form-container">
			<h4 class="info">Level: {{ $athlete->level }}</h4>
			<h4 class="info">Events: {{ $athlete->events }}</h4>
			<h4 class="info">Performances: </h4>
			<div class="list-container">
				<ul class="list-group">
					@foreach ($athlete->performances() as $p)
						<li class="list-group-item">{{ $p->result . ', ' . $p->event . ' at ' . $p->name}}</li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
</div>
@endsection