@extends('layouts.athlete-home')

@section('content')
<div class="main">
	<div class="top-header-container">
		<a class="btn btn-default back-button" href="{{ route('athlete-results') }}"> Back</a>
		<h2 class="top-header">Results: {{ $meet->name }}</h2>
		
	</div>

	<div class="half-page">
		<div class="half-header-container">
			<h3 class="top-header">Boys</h3>
		</div>

		@foreach ($meet->getEvents() as $e)
			@if (count($meet->results($e->id, 1)) > 0)
				<div class="list-container">
					<h4>{{ $e->name }}</h4>
		
					<ul class="list-group">
					@foreach ($meet->results($e->id, 1) as $result) 
						<li class="list-group-item">{{ $result->name . ' - ' . $result->result }}</li>
					@endforeach
					</ul>
				</div>
			@endif
		@endforeach
	</div>

	<div class="half-page">
		<div class="half-header-container">
			<h3 class="top-header">Girls</h3>
		</div>

		@foreach ($meet->getEvents() as $e)
			@if (count($meet->results($e->id, 0)) > 0)
				<div class="list-container">
					<h4>{{ $e->name }}</h4>
					<ul class="list-group">
					@foreach ($meet->results($e->id, 0) as $result) 
						<li class="list-group-item">{{ $result->name . ' - ' . $result->result }}</li>
					@endforeach
					</ul>
				</div>
			@endif
			
		@endforeach
	</div>
</div>
@endsection