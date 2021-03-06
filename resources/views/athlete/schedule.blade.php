@extends('layouts.athlete-home')

@section('content')
<div class="main">
	<div class="top-header-container">
		<div class="header-center">
            <h2 class="top-header">Schedule</h2>
        </div>
	</div>

	<div class="content-container-lg">
        <div class="table-container">
            <table class="table table-bordered table-hover">
                <col style="width:25%">
                <col style="width:25%">
                <col style="width:25%">
                <col style="width:25%">
                <thead>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Location</th>
                    <th>Importance</th>
                </thead>
                <tbody>
                    @foreach ($team->schedule() as $entry)
                        @if ($entry->importance == 0)
                            <tr class="success">
                                <td>{{ $entry->name }}</td>
                                <td>{{ $entry->date_formatted }}</td>
                                <td>{{ $entry->location }}</td>
                                <td>Low</td>
                            </tr>
                        @elseif ($entry->importance == 1)
                            <tr class="warning">
                                <td>{{ $entry->name }}</td>
                                <td>{{ $entry->date_formatted }}</td>
                                <td>{{ $entry->location }}</td>
                                <td>Medium</td>
                            </tr>
                        @else 
                            <tr class="danger">
                                <td>{{ $entry->name }}</td>
                                <td>{{ $entry->date_formatted }}</td>
                                <td>{{ $entry->location }}</td>
                                <td>High</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
	</div>
</div>
@endsection