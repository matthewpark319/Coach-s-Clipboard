@extends('layouts.athlete-home')

@section('content')
<div class="main">
	<div class="top-header-container">
		<h2 class="top-header">Athlete Profile: {{ $teammate->name() }}</h2>
	</div>

	<div class="content-container-lg">
		<div class="form-container">
			<h4 class="info">Level: {{ $teammate->level }}</h4>
			<h4 class="info">Events: {{ $teammate->events }}</h4>
			<h4 class="info">Performances: </h4>
			<div class="list-container">
				<ul class="list-group">
					@foreach ($teammate->performances() as $p)
						<li class="list-group-item">{{ $p->result . ', ' . $p->event . ' at ' . $p->name}}</li>
					@endforeach
				</ul>
			</div>
			<a class="btn btn-default add-button" href="{{ route('athlete-roster') }}">Back</a>
		</div>


	</div>
</div>
@endsection