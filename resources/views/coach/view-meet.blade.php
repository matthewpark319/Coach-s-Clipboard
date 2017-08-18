@extends('layouts.coach-home')

@section('content')
<div class="main">
	<div class="top-header-container">
		<a class="btn btn-default back-button" href="{{ route('coach-results') }}">Back</a>
		<div class="header-center">
            <h2 class="top-header">Results: {{ $meet->name }}</h2>
        </div>
		
	</div>

	<div class="half-page">
		<div class="half-header-container">
			<div class="header-center">
				<h3 class="top-header">Boys</h3>
			</div>
			
		</div>

		@foreach (\App\Event::getIndividualEvents() as $e)
			@if (count($meet->resultsIndividual($e->id, 1)) > 0)
				<div class="list-container">
					<h4>{{ $e->name }}</h4>
					
					<ul class="list-group">
					@foreach ($meet->resultsIndividual($e->id, 1) as $result) 
						<li class="list-group-item">{{ $result->name . ' - ' . $result->result }}
							
							<a href="{{ route('delete-individual', ['meet' => $meet->id, 'performance' => $result->id]) }}" id='remove'><img class="minus float-right" src="{{ asset('/images/red-minus-hi.png') }}"></a>

							@if ($result->has_splits == 1)
								<a href="{{ route('coach-splits', ['performance' => $result->id]) }}" class='float-right margin-right'>See Splits</a>
							@endif
						</li>
					@endforeach
					</ul>
				</div>
			@endif
		@endforeach

		@foreach (\App\Event::getRelayEvents() as $e)
			@php $results = $meet->resultsRelay($e->id, 1); @endphp

			@if (count($results) > 0)
				<div class="list-container">
					<h4>{{ $e->name }}</h4>

					@for ($i = 0; $i < count($results); $i+=4)
						<ul class="list-group">
							<div class="list-group-item">
								<a href="{{ route('delete-relay', ['meet' => $meet->id, 'relay' => $results[$i]->relay_id]) }}" id='remove'><img class="minus float-right" src="{{ asset('/images/red-minus-hi.png') }}"></a>

								<h4>{{ $results[$i]->total_time }}</h4>
								
								@for ($j = $i; $j < 4; $j++)
									<p>{{ $results[$j]->result }}
									@if ($results[$j]->has_splits == 1)
										<a href="{{ route('coach-splits', ['performance' => $results[$j]->performance_id]) }}" class='float-right margin-right'>See Splits</a>
									@endif
									</p>
								@endfor
								
							</div>
						</ul>
					@endfor
				</div>
			@endif
		@endforeach
	</div>

	<div class="half-page">
		<div class="half-header-container">
			<div class="header-center">
				<h3 class="top-header">Girls</h3>
			</div>

		@foreach (\App\Event::getIndividualEvents() as $e)
			@if (count($meet->resultsIndividual($e->id, 0)) > 0)
				<div class="list-container">
					<h4>{{ $e->name }}</h4>
					
					<ul class="list-group">
					@foreach ($meet->resultsIndividual($e->id, 0) as $result) 
						<li class="list-group-item">{{ $result->name . ' - ' . $result->result }}
							<a href="{{ route('delete-individual', ['meet' => $meet->id, 'performance' => $result->id]) }}" id='remove'><img class="minus float-right" src="{{ asset('/images/red-minus-hi.png') }}"></a>
						</li>
					@endforeach
					</ul>
				</div>	
			@endif
		@endforeach

		@foreach (\App\Event::getRelayEvents() as $e)
			@php $results = $meet->resultsRelay($e->id, 0); @endphp

			@if (count($results) > 0)
				<div class="list-container">
					<h4>{{ $e->name }}</h4>

					@for ($i = 0; $i < count($results); $i+=4)
						<ul class="list-group">
							<div class="list-group-item">
								<a href="{{ route('delete-relay', ['meet' => $meet->id, 'relay' => $results[$i]->relay_id]) }}" id='remove'><img class="minus float-right" src="{{ asset('/images/red-minus-hi.png') }}"></a>

								<h4>{{ $results[$i]->total_time }}</h4>
								@for ($j = $i; $j < 4; $j++)
									<p>{{ $results[$j]->name . ' - ' . $results[$j]->result }}</p>
								@endfor
							</div>
						</ul>
					@endfor
				</div>
			@endif
		@endforeach
	</div>
</div>
@endsection