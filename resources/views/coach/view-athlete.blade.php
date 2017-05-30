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
						
						@if (is_null($p->id)) @break @endif
						@php $performance = \App\Performance::find($p->id); @endphp

					
						<li class="list-group-item">{{ $performance->getRaceResult() . ' - ' . $performance->getRaceInfo() }}	
						
						@if ($p->has_splits == 1)
							<a href="{{ route('coach-splits', ['performance' => $p->id]) }}" class='float-right'>See Splits</a>
						@endif
						</li>
					@endforeach
				</ul>
			</div>
		</div>
		<div class="right-margin">
	        <div class="button-container">
	            <a class="btn btn-default add-button" href="{{ route('coach-roster') }}">Back</a>
	        </div>
	    </div>
	</div>

	
</div>
@endsection