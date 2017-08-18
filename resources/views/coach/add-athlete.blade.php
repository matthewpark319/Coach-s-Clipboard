@extends('layouts.coach-home')

@section('content')
<div class="main">
	<div class="top-header-container">
		<div class="header-center">
            <h2 class="top-header">Add Athlete</h2>
        </div>
	</div>

	<div class="content-container-lg">
		<div class="form-container">
			<form id="form" class="form-horizontal" method="post" action="{{ route($route) }}">
				{{ csrf_field() }}
				<input name="team_id" type="hidden" value="{{ $team->id }}">
				<div class="form-group">
					<div class="col-md-2">
						<label class="float-right" for="first_name">First Name</label>
					</div>
					
	 				<div class="col-md-8">
						<input id="first_name" type="text" class="form-control" name="first_name" required autofocus>
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-2">
						<label class="float-right" for="last_name">Last Name</label>
					</div>
					<div class="col-md-8">
						<input id="last_name" type="text" class="form-control" name="last_name" required>
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-2">
						<label for="male" class="float-right">Male</label>
					</div>
                    
                    <div class="col-md-1" style="width:10%">     
                        <input id="male" type="radio" name="gender" value="1" checked>
                    </div>

                    <div class="col-md-1">
                    	<label for="female" class="float-right">Female</label>
                    </div>
                    
                    <div class="col-md-2" style="width:10%">
                        <input id="female" type="radio" name="gender" value="0">
                    </div>
                </div>
				
				<div class="form-group">
					<div class="col-md-2">
						<label class="float-right" for="grad_year">Class of</label>
					</div>
					<div class="col-md-8">
						<input id="grad_year" type="text" class="form-control" name="grad_year" placeholder="Enter in yyyy format" required>
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-2">
						<label class="float-right" for="events">Events</label>
					</div>
					<div class="col-md-8">
						<input id="events" type="text" class="form-control" name="events" required>
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-2">
						<label class="float-right" for="level">Level</label>
					</div>
					<div class="col-md-8">
						<select id="level" type="text" class="form-control" name="level" required>
							<option value="">-- Select --</option>
							<option value="Varsity">Varsity</option>
							<option value="JV">JV</option>
							<option value="Freshman">Freshman</option>
						</select>
					</div>
				</div>

				<div class="form-group text-align-center">
					<h4>The added athlete will register his username and password on his own.</h4>
				</div>
			</form>

			<div class="container">
			@if (count($errors) > 0)
				@foreach ($errors->all() as $e)
					<li>{{ $e }}</li>
				@endforeach
			@elseif (isset($successful))
				<h4>Athlete Added Successfully</h4>
			@endif
			</div>
		</div>

		<div class="right-margin">
            <div class="button-container">
                <a href="{{ route($back_route) }}"> 
                    <button type="button" class="btn btn-default add-button">Back</button>
                </a>
                <button onclick="$('#form').submit()" class="btn btn-default add-button">Add to Roster</button>
            </div>
        </div>
    </div>
</div>
@endsection