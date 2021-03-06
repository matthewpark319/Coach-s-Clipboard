@extends('layouts.athlete-home')

@section('content')
<div class="main">
	<div class="top-header-container">
		<div class="header-center">
            <h2 class="top-header">Athlete Profile: {{ $teammate->name() }}</h2>
        </div>
	</div>

	<div class="content-container-lg">
		<div class="form-container">
			<h4 class="info">Level: {{ $teammate->level }}</h4>
			<h4 class="info">Events: {{ $teammate->events }}</h4>
			<h4 class="info">Performances: </h4>
			<div class="list-container">
				<ul class="list-group">
					@foreach ($team->allSeasons() as $s)
						@php $performances = $teammate->performances($s->id) @endphp
						@if (count($performances) > 0)
							<h5>{{ $s->name . ' ' . $s->year }}</h5>
							@foreach ($performances as $p)

								<!-- @if (is_null($p->id)) @break @endif -->
								@php $performance = \App\Performance::find($p->id); @endphp

								<li class="list-group-item">{{ $performance->getRaceResult() . ' - ' . $performance->getRaceInfo() }}	
									@if ($p->has_splits == 1)
										<a href="{{ route('athlete-splits', ['performance' => $p->id]) }}" class='float-right'>See Splits</a>
									@endif
								</li>

							@endforeach
						@endif
					@endforeach
				</ul>
			</div>
		</div>

		<div class="right-margin">
	        <div class="button-container">
	            <a class="btn btn-default add-button" href="{{ route('athlete-roster') }}">Back</a>
	        </div>
	    </div>

	</div>
</div>
@endsection