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
						
						@if (is_null($p->id)) @break @endif
						@php $performance = \App\Performance::find($p->id); @endphp
					
						<li class="list-group-item">{{ $performance->getRaceResult() . ' - ' . $performance->getRaceInfo() }}	
						
						@if ($p->has_splits == 1)
							<a href="{{ route('athlete-splits', ['performance' => $p->id]) }}" class='float-right'>See Splits</a>
						@endif
						</li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
</div>
@endsection