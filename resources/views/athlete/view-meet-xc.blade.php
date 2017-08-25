@extends('layouts.athlete-home')

@section('content')
<div class="main">
	<div class="top-header-container">
		<a class="btn btn-default back-button" href="{{ route('athlete-results') }}">Back</a>
		<div class="header-center">
            <h2 class="top-header">Results: {{ $meet->name }} at {{ $meet->courseName() }}</h2>
        </div>
		
	</div>

	<div class="half-page">
		<div class="half-header-container">
			<div class="header-center">
				<h3 class="top-header">Boys</h3>
			</div>
			
		</div>

		@foreach (\App\Event::getXCEvents() as $e)
			@if (count($meet->resultsXC($e->id, 1)) > 0)
				<div class="list-container">
					<h4>{{ $e->name }}</h4>
					
					<ul class="list-group">
					@foreach ($meet->resultsIndividual($e->id, 1) as $result) 
						<li class="list-group-item">{{ $result->name . ' - ' . $result->result }}</li>
					@endforeach
					</ul>
				</div>
			@endif
		@endforeach
	</div>

	<div class="half-page">
		<div class="half-header-container">
			<div class="header-center">
				<h3 class="top-header">Girls</h3>
			</div>

			@foreach (\App\Event::getXCEvents() as $e)
				@if (count($meet->resultsXC($e->id, 0)) > 0)
					<div class="list-container">
						<h4>{{ $e->name }}</h4>
						
						<ul class="list-group">
						@foreach ($meet->resultsXC($e->id, 0) as $result) 
							<li class="list-group-item">{{ $result->name . ' - ' . $result->result }}</li>
						@endforeach
						</ul>
					</div>
				@endif
			@endforeach
	</div>
</div>
@endsection