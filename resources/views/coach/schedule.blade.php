@extends('layouts.coach-home')

@section('content')
<div class="main">
	<div class="top-header-container">
		<h2 class="top-header">Schedule</h2>
	</div>

	<div class="content-container-lg">
		<table class="table table-bordered table-hover roster-table">
            <col style="width:20%">
            <col style="width:20%">
            <col style="width:20%">
            <col style="width:20%">
            <col style="width:10%">
            <col style="width:10%">
            <thead>
                <th>Name</th>
                <th>Date</th>
                <th>Location</th>
                <th>Importance</th>
                <th>Completed</th>
                <th>Add Results</th>
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
                            <td><a href="{{ route('add-results', ['meet' => $entry->id]) }}">Add Results</a></td>
                        @else
                            <td>Not Complete</td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
	</div>

	<div class="footer">
		<a class="add-button" href="{{ route('add-schedule-event') }}">
			<button class="btn btn-default btn-bottom-right">Add New Event</button>
		</a>
	</div>
</div>

{{ csrf_field() }}
<script>
function uncompleteEvent(entry_id) {
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
        form.append(csrf_field);

        var team_id = document.createElement("input");
        team_id.setAttribute("type", "hidden");
        team_id.setAttribute("name", "team_id");
        team_id.setAttribute("value", {{ $team->id }});
        form.append(team_id);

        document.body.appendChild(form);
        form.submit();
    }
}

function completeEvent(entry_id) {
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
    form.append(csrf_field);
        
    document.body.appendChild(form);
    form.submit();
}
</script>
@endsection