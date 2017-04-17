@extends('layouts.athlete-home')

@section('content')
<div class="main">
	<div class="top-header-container">
		<h2 class="top-header">Announcements</h2>
	</div>

	<div class="content-container-lg">
        <div class="table-container">
            <table class="table table-bordered table-hover">
                <col style="width:10%">
                <col style="width:10%">
                <col style="width:10%">
                <col style="width:70%">
                <thead>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Coach</th>
                    <th>Announcement</th>
                </thead>
                <tbody>
                    @foreach ($team->announcements() as $announcement)
                        <tr>
                            <td>{{ $announcement->date }}</td>
                            <td>{{ $announcement->time }}</td>
                            <td>{{ $announcement->coach }}</td>
                            <td>{{ $announcement->text }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
	</div>
</div>
@endsection