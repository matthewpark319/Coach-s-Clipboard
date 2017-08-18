@extends('layouts.coach-home')

@section('content')
<div class="main">
	<div class="top-header-container">
		<div class="header-center">
            <h2 class="top-header">Manage Team</h2>
        </div>
	</div>

	<div class="content-container-lg">
		<div class="half-page">
			<div class="half-header-container">
				<div class="header-center">
					<h3 class="top-header">Edit Athlete</h3>
				</div>
			</div>

			<div class="half-content">
				@if (isset($athlete))
					<form id="edit" method="post" class="form-horizontal" style="height:75%;">
						{{ csrf_field() }}
						<div class="form-group">
							<div class="col-md-2">
								<label class="float-right" for="level">Athlete</label>
							</div>
							<div class="col-md-8">
								<select id="select" class="form-control" name="athlete_id" onchange="editAthlete()">
									<option value="0">-- Select Athlete --</option>
									<option value="{{ $athlete->id }}" selected>{{ $athlete->name() }}</option>
									@foreach ($team->teammates($athlete->id) as $a) 
										<option value="{{ $a->id }}">{{ $a->name }}</option> 
									@endforeach
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-md-2">
								<label class="float-right" for="level">Level</label>
							</div>
							
			 				<div class="col-md-8">
								<select id="level" class="form-control" name="level" required>
									<option value="Varsity">Varsity</option>
									<option value="JV">JV</option>
									<option value="Freshman">Freshman</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-2">
								<label class="float-right" for="events">Events</label>
							</div>
							
			 				<div class="col-md-8">
								<input id="events" type="text" class="form-control" name="events" value="{{ $athlete->events }}" required>
							</div>
						</div>

						

						@if (isset($successful))
							<div class="container">
								<h4>Edited Successfully</h4>
							</div>
						@endif
					</form>

					<div class="footer" style="position:relative; text-align:center; width:90%;">
						<button onclick="$('#edit').submit()" class="btn btn-default float-right margin-right">Save Changes</button>
					</div>
					<script>
						$(document).ready(function() {
							$("#level option[value='{{ $athlete->level }}']").attr('selected', 'selected');
						});
					</script>
				@else
					<div class="form-group">
						<div class="col-md-2">
							<label class="float-right" for="level">Athlete</label>
						</div>
						<div class="col-md-8">
							<select id="select" class="form-control" onchange="editAthlete()">
								<option value="0">-- Select Athlete --</option>
								@foreach ($team->roster() as $a) 
									<option value="{{ $a->id }}">{{ $a->name }}</option> 
								@endforeach
							</select>
						</div>
					</div>
				@endif
			</div>
		</div>

		<div class="half-page">
			<div class="half-header-container">
				<div class="header-center">
					<h3 class="top-header">Past Seasons</h3>
				</div>
			</div>

			<div class="half-content">
				<div class="list-container-scroll" style="margin:0">
					<ul class="list-group">
						@foreach ($team->allSeasons() as $season)
							<li class="list-group-item">
								{{ $season->name . ' ' . $season->year }}
 								@if ($season->current) 
 									<p class="float-right">Current</p>
 								@else 
 									<a class="float-right" href="{{ route('manage-team', ['set_current' => $season->id]) }}">Set as current</a>
								@endif
							</li>
						@endforeach
					</ul>
				</div>

				<div class="footer" style="width:90%">
					<a href="{{ route('coach-home') }}" class="btn btn-default float-right margin-right">Back</a>
				</div>
			</div>
		</div>
    </div>
</div>

<script>
function editAthlete() {
	var id = $('#select option:selected').val();
	if (id != 0) window.location.href = "/coach/manage-team/edit-athlete/" + id;
}
</script>
@endsection