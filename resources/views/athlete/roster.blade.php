@extends('layouts.athlete-home')

@section('content')
<div class="main">
	<div class="top-header-container">
		<h2 class="top-header">Roster</h2>
	</div>

	<div class="content-container-lg">
        <table class="table table-bordered table-hover roster-table">
            <col style="width:50%">
            <col style="width:50%">
            <thead>
                <th>Name</th>
                <th>Events</th>
            </thead>
            <tbody>
                @foreach ($team->roster() as $athlete)
                    <tr>
                        <td><a href="{{ route('coach-view-athlete', ['athlete' => $athlete->id]) }}">{{ $athlete->name }}</a></td>
                        <td>{{ $athlete->events }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
	</div>
</div>
@endsection