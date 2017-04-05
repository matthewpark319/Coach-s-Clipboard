@extends('layouts.coach-home')

@section('content')
<div class="main">
	<div class="top-header-container">
		<h2 class="top-header">Add Results for {{ $meet->name }}</h2>
	</div>

	<div class="content-container-lg">
		<div class="form-container">
            <form method="post" id="form">
                {{ csrf_field() }}
                <input name="team_id" type="hidden" value="{{ $team->id }}">
                <input name="event_type" type="hidden" value="" id="event_type">
                <input name="meet_id" type="hidden" value="{{ $meet->id }}">
                <div class="form-inline event">
                    <div class="form-group">
                        <label for="event">Event</label>
                   
                        <select id="event" class="form-control" name="event" onchange="setEventType()" required>
                            <option value="">-- Select Event --</option>

                            @foreach ($meet->getEvents() as $e)
                                <option value="{{ $e->id }}" class="{{ $e->type }}">{{ $e->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                </div>

                <div class="form-inline entry">
                    <div class="form-group">
                        <label for="athlete">Athlete</label>
                        <select id="athlete" class="form-control" name="athlete[]" required>
                            <option value="">-- Select Athlete --</option>
                            @foreach ($team->roster() as $athlete)
                                <option value="{{ $athlete->id }}">{{ $athlete->name }}</option>
                            @endforeach
                        </select>
                    </div>    

                    <div class="form-group">
                        <label for="result">Result</label>
                        <input id="result" type="text" class="form-control" name="result[]" placeholder="Select an event" required>
                    </div>


                    <div class="form-group" style="width:15%">
                        <label for="place">Place</label>
                        <input id="place" type="number" class="form-control" name="place[]" style="width:70%">
                    </div>

                    <a href="#" onclick="addNewEntry()">
                        <img id="plus" src="{{ asset('/images/add-button-hi.png') }}">
                    </a>
                </div>
                
                <div class="button-container">
                    <a href="{{ route('coach-schedule') }}"> 
                        <button type="button" class="btn btn-default add-button">Back</button>
                    </a>
                    <button type="submit" class="btn btn-default add-button">Add</button>
                </div>

            </form>
            <div class="container">
            @if (count($errors) > 0)
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            @elseif ($successful)
                <h4>Results Saved</h4>
            @endif
            </div>
        </div>

	</div>
    
</div>

<script>
function setEventType() {
    var event_type = $('option:selected').attr('class');
    $('#event_type').val(event_type);

    if (event_type.localeCompare('') == 0)
        $('input[name^=result').attr('placeholder', 'Select an event');
    else if (event_type.localeCompare('sprints') == 0) 
        $('input[name^=result').attr('placeholder', 'Enter time in mm:ss.ss format');
    else if (event_type.localeCompare('distance') == 0) 
        $('input[name^=result').attr('placeholder', 'Enter time in mm:ss format');
    else if (event_type.localeCompare('field') == 0) 
        $('input[name^=result').attr('placeholder', 'Enter result in ft-in format');
    
}

function addNewEntry() {
    var remove = "<a id='remove' href='#' onclick='removeEntry(this)'><img id='plus' src=\"{{ asset('/images/red-minus-hi.png') }}\"'></a>";
    var clone = $('.entry').first().clone();
    clone.find("#result").val('');
    clone.find("#place").val('');
    clone.append(remove);
    clone.appendTo($('#form'));
}

function removeEntry(element) {
    $(element).parent('.entry').remove();
}

</script>
@endsection