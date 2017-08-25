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
						<label class="float-right" for="course_id">Course</label>
					</div>
					<div class="col-md-4">
						<select id="course_id" type="text" class="form-control" name="course_id" value="{{ old('course_id') }}" required>
							<option value="">-- Select --</option>
							@foreach ($team->courses() as $course)
								<option value="{{ $course->id }}" data-name="{{ $course->name }}">{{ $course->name }}</option>
							@endforeach
						</select>
					</div>

					<div class="col-md-3">
						<input id="add_course" type="text" class="form-control" name="name" placeholder="Add New Course">
					</div>

					<div class="col-md-1">
						<button class="btn btn-default" onclick="addCourse()" type="button">Add</button>
					</div>	
				</div>

				<div class="form-group">
					<div class="col-md-2">
						<label class="float-right" for="name">Event Name</label>
					</div>
					
	 				<div class="col-md-8">
						<input id="name" type="text" class="form-control" name="meet_name" value="{{ old('name') }}" autofocus>
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-2">
						<label class="float-right" for="date">Date</label>
					</div>
					<div class="col-md-8">
						<input id="date" type="text" class="form-control" name="date" placeholder="Enter format: m/d/yyyy" value="{{ old('date') }}">
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-2">
						<label class="float-right" for="importance">Importance</label>
					</div>
					<div class="col-md-8">
						<select id="importance" type="text" class="form-control" name="importance" value="{{ old('importance') }}">
							<option value="">-- Select --</option>
							<option value="2">High</option>
							<option value="1">Medium</option>
							<option value="0">Low</option>
						</select>
					</div>
				</div>

			</form>

			<div class="error-container">
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
                <button onclick="submit()" class="btn btn-default add-button">Add</button>
            </div>
        </div>
	</div>
</div>

<script>
$(document).ready(function() {
	$("#importance option[value={{ old('importance') }}]").attr('selected', 'selected');
});

function submit() {
	var course_name = $('#course_id option:selected').attr('data-name');
	$('#form').append("<input type='hidden' name='location' value='" + course_name + "'>");
	$('#form').submit();
}

function addCourse() {
	var course = $("#add_course").val();
	$("course_id").attr("required", "null");
	if (course) {
		$("#form").attr('action', 'add-course-xc');
		$("#form").submit();
	} else {
		alert("No course name given");
	}
}
</script>
@endsection