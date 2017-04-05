@extends('layouts.coach-home')

@section('content')
<div class="main">
	<div class="top-header-container">
		<h2 class="top-header">Results: {{ $meet->name }}</h2>
	</div>

	<div class="half-page">
		<div class="half-header-container">
			<h3 class="top-header">Boys</h3>
		</div>

		@foreach ($meet->getEvents() as $e)
			<div class="list-container">
				<h4>{{ $e->name }}</h4>
				
				@if (count($meet->results($e->id, 1)) == 0)
					<h5>No Results</h5>
				@endif
				<ul class="list-group">
				@foreach ($meet->results($e->id, 1) as $result) 
					<li class="list-group-item">{{ $result->name . ' - ' . $result->result }}</li>
				@endforeach
				</ul>
			</div>
		@endforeach
	</div>

	<div class="half-page">
		<div class="half-header-container">
			<h3 class="top-header">Girls</h3>
		</div>

		@foreach ($meet->getEvents() as $e)
			<div class="list-container">
				<h4>{{ $e->name }}</h4>
				
				@if (count($meet->results($e->id, 0)) == 0)
					<h5>No Results</h5>
				@endif
				<ul class="list-group">
				@foreach ($meet->results($e->id, 0) as $result) 
					<li class="list-group-item">{{ $result->name . ' - ' . $result->result }}</li>
				@endforeach
				</ul>
			</div>
		@endforeach
	</div>
</div>
@endsection