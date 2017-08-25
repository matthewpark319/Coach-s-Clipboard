@extends('layouts.coach-home')

@section('content')
<div class="main">
	<div class="top-header-container">
		<div class="header-center">
            <h2 class="top-header">Schedule</h2>
        </div>

        <div class="select-right">
            <select id="season" onchange="changeSeason('schedule')">
                <option value="{{ $team->selectedSeason()->id }}">{{ $team->selectedSeason()->info }}</option>
                @foreach ($team->seasonsNotSelected() as $season) 
                    <option value="{{ $season->id }}">{{ $season->info }}</option>
                @endforeach
            </select>
        </div>
	</div>

	<div class="content-container-lg">
        <div class="table-container">
            <table class="table table-bordered table-hover">
                <thead>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Location</th>
                    <th>Importance</th>
                    <th>Completed</th>
                    <th>Add Results</th>
                    <th>Delete</th>
                </thead>
                <tbody>
                    @foreach ($team->schedule() as $meet)
                        @if ($meet->importance == 0)
                            <tr class="success">
                                <td>{{ $meet->name }}</td>
                                <td>{{ $meet->date_formatted }}</td>
                                <td>{{ $meet->location }}</td>
                                <td>Low</td>                        
                        @elseif ($meet->importance == 1)
                            <tr class="warning">
                                <td>{{ $meet->name }}</td>
                                <td>{{ $meet->date_formatted }}</td>
                                <td>{{ $meet->location }}</td>
                                <td>Medium</td>
                        @else 
                            <tr class="danger">
                                <td>{{ $meet->name }}</td>
                                <td>{{ $meet->date_formatted }}</td>
                                <td>{{ $meet->location }}</td>
                                <td>High</td>                            
                        @endif
                            <td>
                                <div class="squaredFour">
                                    @if ($meet->complete)
                                        <input class="completed" type="checkbox" id="completed-{{ $meet->id }}" onchange="uncompleteEvent({{ $meet->id }})" checked>
                                    @else 
                                        <input class="completed" type="checkbox" id="completed-{{ $meet->id }}" onchange="completeEvent({{ $meet->id }})">
                                    @endif
                                    <label for="completed-{{ $meet->id }}"></label>
                                </div>
                            </td>
                            @if ($meet->complete)
                                @if (session('xc'))
                                    <td><a href="{{ route('add-results-xc', ['meet' => $meet->id]) }}">Add Results</a></td>
                                @else
                                    <td><a href="{{ route('add-results-individual', ['meet' => $meet->id]) }}">Add Results</a></td>
                                @endif
                                <td>-</td>
                            @else
                                <td>Not Complete</td>
                                <td>
                                    <a href="{{ route('delete-meet', ['meet' => $meet->id]) }}" id='remove' onclick="confirm('Delete meet: {{ $meet->name }}?')">
                                        <img class="minus" src="{{ asset('/images/red-minus-hi.png') }}"></a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
		
	</div>

    @if (session('season') == $team->currentSeason()->id)
	<div class="footer">
        @if (session('xc'))
            <a class="add-button" href="{{ route('add-meet-xc') }}">
        @else
            <a class="add-button" href="{{ route('add-meet') }}">
        @endif
            <button class="btn btn-default btn-bottom-right">Add New Meet</button>
        </a>
	</div>
    @endif
</div>

<script>
function uncompleteEvent(meet_id) {
    if (confirm("Uncompleting this event will delete all of its results. Continue?")) {
        window.location.href = '/coach/schedule/uncomplete-meet/' + meet_id;
    }
}

function completeEvent(meet_id) {
	window.location.href = '/coach/schedule/complete-meet/' + meet_id;
}

</script>
@endsection