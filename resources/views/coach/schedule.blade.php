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
                    @foreach ($team->schedule() as $entry)
                        @if ($entry->importance == 0)
                            <tr class="success">
                                <td>{{ $entry->name }}</td>
                                <td>{{ $entry->date_formatted }}</td>
                                <td>{{ $entry->location }}</td>
                                <td>Low</td>                        
                        @elseif ($entry->importance == 1)
                            <tr class="warning">
                                <td>{{ $entry->name }}</td>
                                <td>{{ $entry->date_formatted }}</td>
                                <td>{{ $entry->location }}</td>
                                <td>Medium</td>
                        @else 
                            <tr class="danger">
                                <td>{{ $entry->name }}</td>
                                <td>{{ $entry->date_formatted }}</td>
                                <td>{{ $entry->location }}</td>
                                <td>High</td>                            
                        @endif
                            <td>
                                <div class="squaredFour">
                                    @if ($entry->complete)
                                        <input class="completed" type="checkbox" id="completed-{{ $entry->id }}" onchange="uncompleteEvent({{ $entry->id }})" checked>
                                    @else 
                                        <input class="completed" type="checkbox" id="completed-{{ $entry->id }}" onchange="completeEvent({{ $entry->id }})">
                                    @endif
                                    <label for="completed-{{ $entry->id }}"></label>
                                </div>
                            </td>
                            @if ($entry->complete)
                                <td><a href="{{ route('add-results-individual', ['meet' => $entry->id]) }}">Add Results</a></td>
                                <td>-</td>
                            @else
                                <td>Not Complete</td>
                                <td><a href="#" id='remove' onclick='removeEntry({{ $entry->id }})'><img class="minus" src="{{ asset('/images/red-minus-hi.png') }}"></a></td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
		
	</div>

    @if (session('season') == $team->currentSeason()->id)
	<div class="footer">
		<a class="add-button" href="{{ route('add-schedule-event') }}">
			<button class="btn btn-default btn-bottom-right">Add New Event</button>
		</a>
	</div>
    @endif
</div>

{{ csrf_field() }}
<script>
function uncompleteEvent(entry_id) {
	console.log('hello2');
    if (confirm("Uncompleting this event will delete all of its results. Continue?")) {
        var form = document.createElement("form");
        form.setAttribute("method", "post");

        var complete = document.createElement("input");
        complete.setAttribute("type", "hidden");
        complete.setAttribute("name", "complete");
        complete.setAttribute("value", 0);
        form.appendChild(complete);

        var id = document.createElement("input");
        id.setAttribute("type", "hidden");
        id.setAttribute("name", "entry_id");
        id.setAttribute("value", entry_id);
        form.appendChild(id);

        var csrf_field = document.createElement("input");
        csrf_field.setAttribute("type", "hidden");
        csrf_field.setAttribute("name", "_token");
        csrf_field.setAttribute("value", $("input[name=_token]").val());
        form.appendChild(csrf_field);

        var team_id = document.createElement("input");
        team_id.setAttribute("type", "hidden");
        team_id.setAttribute("name", "team_id");
        team_id.setAttribute("value", {{ $team->id }});
        form.appendChild(team_id);

        document.body.appendChild(form);
        form.submit();
    }
}

function completeEvent(entry_id) {
	console.log('hello');
    var form = document.createElement("form");
    form.setAttribute("method", "post");

    var complete = document.createElement("input");
    complete.setAttribute("type", "hidden");
    complete.setAttribute("name", "complete");
    complete.setAttribute("value", 1);
    form.appendChild(complete);

    var id = document.createElement("input");
    id.setAttribute("type", "hidden");
    id.setAttribute("name", "entry_id");
    id.setAttribute("value", entry_id);
    form.appendChild(id);

    var csrf_field = document.createElement("input");
    csrf_field.setAttribute("type", "hidden");
    csrf_field.setAttribute("name", "_token");
    csrf_field.setAttribute("value", $("input[name=_token]").val());
    form.appendChild(csrf_field);
        
    document.body.appendChild(form);
    form.submit();
}

function removeEntry(entry_id) {
    if (confirm("Delete meet entry?")) {
        var form = document.createElement("form");
        form.setAttribute("method", "post");

        var del = document.createElement("input");
        del.setAttribute("type", "hidden");
        del.setAttribute("name", "delete");
        del.setAttribute("value", 1);
        form.appendChild(del);        

        var id = document.createElement("input");
        id.setAttribute("type", "hidden");
        id.setAttribute("name", "entry_id");
        id.setAttribute("value", entry_id);
        form.appendChild(id);

        var csrf_field = document.createElement("input");
        csrf_field.setAttribute("type", "hidden");
        csrf_field.setAttribute("name", "_token");
        csrf_field.setAttribute("value", $("input[name=_token]").val());
        form.appendChild(csrf_field);
            
        document.body.appendChild(form);
        form.submit();
    }
}
</script>
@endsection