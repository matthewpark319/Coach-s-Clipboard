@extends('layouts.coach-home')

@section('content')
<div class="main">
	<div class="top-header-container">
		<div class="header-center">
			<h2 class="top-header">Splits</h2>
		</div>
	</div>

	<div class="content-container-lg">
		<div class="form-container">
			<h4 class="info">Athlete: {{ $performance->athleteName() }}</h4>
			<h4 class="info">Race: {{ $performance->getRaceInfo() }}</h4>
			<h4 class="info">Splits: </h4>

			<div class="list-container">
				<ul class="list-group">
					@for ($i = 0; $i < count($performance->splits()); $i++)
						<li class="list-group-item">Lap {{ $i + 1 }}: {{ $performance->splits()[$i]->time }}</li>
					@endfor
				</ul>
			</div>
		</div>
		<div class="right-margin">
	        <div class="button-container">
	            <button class="btn btn-default add-button" onclick="window.history.back()">Back</button>
	        </div>
	    </div>
	</div>
	
</div>
@endsection