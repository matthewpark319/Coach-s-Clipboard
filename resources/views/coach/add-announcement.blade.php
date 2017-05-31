@extends('layouts.coach-home')

@section('content')
<div class="main">
	<div class="top-header-container">
		<h2 class="top-header">Add Announcement</h2>
	</div>

	<div class="content-container-lg">
		<div class="form-container">
			<form id="form" class="form-horizontal" method="post">
				{{ csrf_field() }}
				<input name="team_id" type="hidden" value="{{ $team->id }}">
				<input name="coach_id" type="hidden" value="{{ $coach->id }}">
				<div class="form-group">
					<label for="text">Announcement: </label>
					<textarea id="text" name="text" class="form-control" rows='6' required autofocus></textarea>
				</div>
			</form>

			<div class="container">
			@if ($successful)
				<h4>New Announcement Added</h4>
			@endif
			</div>
		</div>

		<div class="right-margin">
	        <div class="button-container">
	            <a href="{{ route('coach-announcement') }}"> 
	                <button type="button" class="btn btn-default add-button">Back</button>
	            </a>
	            <button onclick="$('#form').submit()" class="btn btn-default add-button">Add</button>
	        </div>
	    </div>
	</div>
	
</div>
@endsection