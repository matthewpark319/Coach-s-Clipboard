@extends('layouts.coach-home')

@section('content')
<div class="main">
	<div class="top-header-container">
		<div class="header-center">
			<h2 class="top-header">Add New Schedule Event</h2>
		</div>
	</div>

	<div class="content-container-lg">
		<div class="form-container">
			<form id="form" class="form-horizontal" method="post">
				{{ csrf_field() }}
				<div class="form-group">
					<div class="col-md-2">
						<label class="float-right" for="name">Event Name</label>
					</div>
					
	 				<div class="col-md-8">
						<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-2">
						<label class="float-right" for="date">Date</label>
					</div>
					<div class="col-md-8">
						<input id="date" type="text" class="form-control" name="date" placeholder="Enter format: m/d/yyyy" value="{{ old('date') }}" required>
					</div>
				</div>
				
				<div class="form-group">
					<div class="col-md-2">
						<label class="float-right" for="location">Location</label>
					</div>
					<div class="col-md-8">
						<input id="location" type="text" class="form-control" name="location" value="{{ old('location') }}" required>
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-2">
						<label class="float-right" for="importance">Importance</label>
					</div>
					<div class="col-md-8">
						<select id="importance" type="text" class="form-control" name="importance" value="{{ old('importance') }}" required>
							<option value="">-- Select --</option>
							<option value="2">High</option>
							<option value="1">Medium</option>
							<option value="0">Low</option>
						</select>
					</div>
				</div>

			</form>

			<div class="container">
			@if (count($errors) > 0)
				@foreach ($errors->all() as $e)
					<li>{{ $e }}</li>
				@endforeach
			@elseif ($successful)
				<h4>Meet Saved</h4>
			@endif
			</div>
		</div>

		<div class="right-margin">
            <div class="button-container">
                <a href="{{ route('coach-schedule') }}"> 
                    <button type="button" class="btn btn-default add-button">Back</button>
                </a>
                <button onclick="$('#form').submit()" class="btn btn-default add-button">Add</button>
            </div>
        </div>
	</div>
</div>

<script>
$(document).ready(function() {
	$("#importance option[value={{ old('importance') }}]").attr('selected', 'selected');
})
</script>
@endsection