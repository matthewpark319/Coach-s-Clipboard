@extends('layouts.coach-home')

@section('content')
<div class="main">
	<div class="top-header-container">
        <div class="header-center">
            <h2 class="top-header">Add Results for {{ $meet->name }}</h2>
        </div>
	</div>

	<div class="content-container-lg">
		<div class="form-container">
            <form method="post" id="form" url="{{ $meet->id }}">
                {{ csrf_field() }}
                <input name="team_id" type="hidden" value="{{ $team->id }}">
                <input name="event_type" type="hidden" value="" id="event_type">
                <div class="form-inline event">
                    <div class="form-group">
                        <label for="event">Event</label>
                   
                        <select id="event" class="form-control" name="event" onchange="setEventType()" required>
                            <option value="" data-type=null>-- Select Event --</option>

                            @foreach (\App\Event::getIndividualEvents() as $e)
                                <option value="{{ $e->id }}" data-type="{{ $e->type }}">{{ $e->name }}</option>
                            @endforeach
                        </select>

                        <label for="relay" class="margin-left">Relay</label>
                        <input id="relay" type="checkbox" name="relay" class="checkbox" onchange="changeToRelays()">
                        
                    </div>
                    
                </div>


                <div class="entry">
                    <div class="form-inline performance">
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
                            <input id="place" type="number" class="form-control" name="place[]" style="width:60%">
                        </div>

                        <a id="add" href="#" onclick="addNewEntry()">
                            <img id="plus" src="{{ asset('/images/add-button-hi.png') }}">
                        </a>
                    </div>
                    
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

        <div class="right-margin">
            <div class="button-container">
                <a href="{{ route('coach-schedule') }}"> 
                    <button type="button" class="btn btn-default add-button">Back</button>
                </a>
                <button onclick="$('#form').submit()" class="btn btn-default add-button">Add</button>
            </div>
        </div>
	</div>
    
</div>

<script>
function setEventType() {
    var event_type = $('option:selected').attr('data-type');
    console.log(event_type);

    if (event_type == 1) {
        $('input[name^=result').attr('placeholder', 'Enter time in mm:ss format');
        $('.entry').find('.splits').remove();
        $('.entry').not(':has(#splits)').find('.performance').append("<a href='#' onclick=\"addSplits(this.parentElement.parentElement)\" id='splits' class='margin-left'>Add Splits</a>");
        return;
    }
    else if (event_type == 0) 
        $('input[name^=result').attr('placeholder', 'Enter time in mm:ss.ss format');
    else if (event_type == 'null') 
        $('input[name^=result').attr('placeholder', 'Select an event');
    else if (event_type == 2) 
        $('input[name^=result').attr('placeholder', 'Enter result in ft-in format');
    $('.entry').find("#splits").remove();  
    $('.entry').find('.splits').remove();
}

function addSplits(performance) {
    var tempSplits = document.createElement("div");

    var event = $('#event').val();
    if (event == 4) {
        tempSplits.innerHTML = "<div class='form-inline splits'> \
                                    <div class='form-group'> \
                                        <img class='split-arrow' src=\"{{ asset('/images/operation-next.png') }}\"> \
                                        <label>Enter Splits</label> \
                                    </div> \
                                    \
                                    <div class='form-group' style='width:10%'> \
                                        <input name='lap_1[]' class='form-control' placeholder='Lap 1' style='width:100%' required> \
                                    </div> \
                                    \
                                    <div class='form-group' style='width:10%'> \
                                        <input name='lap_2[]' class='form-control' placeholder='Lap 2' style='width:100%' required> \
                                    </div> \
                                    <a href='#' onclick='removeSplits(this.parentElement)'>Cancel</a> \
                                </div>";
    } else if (event == 5) {
        tempSplits.innerHTML = "<div class='form-inline splits'> \
                                    <div class='form-group'> \
                                        <img class='split-arrow' src=\"{{ asset('/images/operation-next.png') }}\"> \
                                        <label>Enter Splits</label> \
                                        <input name='lap_1[]' class='form-control' placeholder='Lap 1' style='width:10%' required> \
                                        <input name='lap_2[]' class='form-control' placeholder='Lap 2' style='width:10%' required> \
                                        <input name='lap_3[]' class='form-control' placeholder='Lap 3' style='width:10%' required> \
                                        <input name='lap_4[]' class='form-control' placeholder='Lap 4' style='width:10%' required> \
                                        <a href='#' onclick='removeSplits(this.parentElement.parentElement)'>Cancel</a> \
                                    </div> \
                                </div>";
    } else {
        tempSplits.innerHTML = "<div class='form-inline splits'> \
                                    <div class='form-group'> \
                                        <img class='split-arrow' src=\"{{ asset('/images/operation-next.png') }}\"> \
                                        <label>Enter Splits</label> \
                                        <input name='lap_1[]' class='form-control' placeholder='Lap 1' style='width:8%' required> \
                                        <input name='lap_2[]' class='form-control' placeholder='Lap 2' style='width:8%' required> \
                                        <input name='lap_3[]' class='form-control' placeholder='Lap 3' style='width:8%' required> \
                                        <input name='lap_4[]' class='form-control' placeholder='Lap 4' style='width:8%' required> \
                                        <input name='lap_5[]' class='form-control' placeholder='Lap 5' style='width:8%' required> \
                                        <input name='lap_6[]' class='form-control' placeholder='Lap 6' style='width:8%' required> \
                                        <input name='lap_7[]' class='form-control' placeholder='Lap 7' style='width:8%' required> \
                                        <input name='lap_8[]' class='form-control' placeholder='Lap 8' style='width:8%' required> \
                                        <a class='margin-left' href='#' onclick='removeSplits(this.parentElement.parentElement)'>Cancel</a> \
                                    </div> \
                                </div>";
    }


    performance.append(tempSplits.firstChild);

    $(performance).find("#splits").remove();
}

function addNewEntry() {
    var remove = "<a id='remove' href='#' onclick='removeEntry(this)'><img id='plus' src=\"{{ asset('/images/red-minus-hi.png') }}\"></a>";
    var clone = $('.entry').first().clone();
    clone.find("#result").val('');
    clone.find("#place").val('');
    clone.find('#add').after(remove);
    clone.find('.splits').remove();

    if ($('option:selected').attr('data-type') == 1) {
        clone.not(':has(#splits)').children('.performance').append("<a href='#' onclick='addSplits(this.parentElement.parentElement)' id='splits' class='margin-left'>Add Splits</a>");
    }

    $('#form').append(clone);
}

function removeEntry(element) {
    $(element).closest('.entry').remove();
}

function changeToRelays() {
    window.location.href = "{{ route('add-results-relay', $meet->id) }}";
}

function removeSplits(splits) {
    $(splits).siblings('.performance').append("<a href='#' onclick='addSplits(this.parentElement.parentElement)' id='splits' class='margin-left'>Add Splits</a>");
    $(splits).remove();
} 
</script>
@endsection