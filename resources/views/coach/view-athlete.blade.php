@extends('layouts.coach-home')

@section('content')
<div class="main">
	<div class="top-header-container">
		<h2 class="top-header">Athlete Profile: {{ $athlete->name() }}</h2>
	</div>

	<div class="content-container-lg">
		<h4 class="info">Level: {{ $athlete->level }}</h4>
		<h4 class="info">Events: {{ $athlete->events }}</h4>
	</div>
</div>
@endsection