@extends('layouts.coach-home')

@section('content')
<div class="main">
	<div class="top-header-container">
		<div class="header-center">
            <h2 class="top-header">Announcements</h2>
        </div>
        
	</div>

    {{ csrf_field() }}

	<div class="content-container-lg">
        <div class="table-container">
            <table class="table table-bordered table-hover">
                <col style="width:10%">
                <col style="width:10%">
                <col style="width:10%">
                <col style="width:65%">
                <col style="width:5%">
                <thead>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Coach</th>
                    <th>Announcement</th>
                    <td>Delete</td>
                </thead>
                <tbody>
                    @foreach ($team->announcements() as $announcement)
                        <tr>
                            <td>{{ $announcement->date }}</td>
                            <td>{{ $announcement->time }}</td>
                            <td>{{ $announcement->coach }}</td>
                            <td>{{ $announcement->text }}</td>
                            <td><a href="{{ route('delete-announcement', $announcement->id) }}" id='remove'><img class="minus" src="{{ asset('/images/red-minus-hi.png') }}"></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
	</div>

	<div class="footer">
		<a class="add-button" href="{{ route('add-announcement') }}">
			<button class="btn btn-default btn-bottom-right">Add Announcement</button>
		</a>
	</div>
</div>

@endsection