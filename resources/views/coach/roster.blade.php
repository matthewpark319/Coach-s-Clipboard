@extends('layouts.coach-home')

@section('content')
<div class="main">
	<div class="top-header-container">
		<h2 class="top-header">Roster</h2>
	</div>

	<div class="content-container-lg">
        <div class="table-container">
            <table class="table table-bordered table-hover">
                <col style="width:33%">
                <col style="width:33%">
                <col style="width:34%">
                <thead>
                    <th>Name</th>
                    <th>Level</th>
                    <th>Events</th>
                </thead>
                <tbody>
                    @foreach ($team->roster() as $athlete)
                        <tr>
                            <td><a href="{{ route('coach-view-athlete', ['athlete' => $athlete->id]) }}">{{ $athlete->name }}</a></td>
                            <td>{{ $athlete->level }}</td>
                            <td>{{ $athlete->events }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
	</div>
</div>
@endsection