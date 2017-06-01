@extends('layouts.coach-home')

@section('content')
<div class="main">
	<div class="top-header-container">
		<h2 class="top-header">Add Results for {{ $meet->name }}</h2>
	</div>

	<div class="content-container-lg">
		<div class="form-container">
            <form method="post" id="form" action="/coach/add-results/relay/{{ $meet->id }}">
                {{ csrf_field() }}
                <input name="team_id" type="hidden" value="{{ $team->id }}">
                <div class="form-inline event">
                    <div class="form-group">
                        <label for="event">Event</label>
                   
                        <select id="event" class="form-control" name="event" onchange="setRelay()" required>
                            <option value="0">-- Select Event --</option>

                            @foreach (\App\Event::getRelayEvents() as $e)
                                <option value="{{ $e->id }}" class="{{ $e->type }}">{{ $e->name }}</option>
                            @endforeach
                        </select>

                        
                        <label for="relay" style="padding-left:15px">Relay</label>
                        <input id="relay" type="checkbox" name="relay" class="checkbox" onchange="changeToIndividual()" checked>

                        <label for="gender" style="padding-left:15px">Relay: {{ $gender == 1 ? 'Boys' : 'Girls'}}</label>
                        <a id="gender" class="margin-left" href="{{ route('add-results-relay', ['meet' => $meet->id, 'relay' => is_null($relay) ? 0 : $relay, 'gender' => $gender ^ 1 ]) }}">Change to {{ $gender == 1 ? 'Girls' : 'Boys' }}</a>
                        
                    </div>
                    
                </div>

                
                <div class="form-inline entry">
                    <div class="form-group">
                        @if ($relay != null)
                            @php $legs = \App\Event::getRelayLegs($relay->id) @endphp

                            <label for="first_leg">First Leg: {{ $legs[0]->name }}</label>
                        @else
                            <label for="first_leg">First Leg</label>
                        @endif

                        <select id="first_leg" class="form-control" name="legs[]" required>
                            <option value="">-- Select Athlete --</option>
                            @foreach ($team->roster($gender) as $athlete)
                                <option value="{{ $athlete->id }}">{{ $athlete->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group performance">
                        <label for="first_leg_split">Split</label>
                        <input type="text" id="first_leg_split" name="splits[]" class="form-control" placeholder="Enter in mm:ss format" required>
                        @if ($relay != null && $legs[0]->type == 1)
                            <a href='#' onclick="addSplits(this.parentElement.parentElement, {{ $legs[0]->id }})" id='splits' class='margin-left'>Add Splits</a>
                        @endif
                    </div> 
                </div>
                
                <div class="form-inline entry">
                    <div class="form-group">
                        @if ($relay != null)
                            <label for="second_leg">Second Leg: {{ $legs[1]->name }}</label>
                        @else
                            <label for="second_leg">Second Leg</label>
                        @endif

                        <select id="second_leg" class="form-control" name="legs[]" required>
                            <option value="">-- Select Athlete --</option>
                            @foreach ($team->roster($gender) as $athlete)
                                <option value="{{ $athlete->id }}">{{ $athlete->name }}</option>
                            @endforeach
                        </select>
                    </div> 

                    <div class="form-group performance">
                        <label for="second_leg_split">Split</label>
                        <input type="text" id="second_leg_split" name="splits[]" class="form-control" placeholder="Enter in mm:ss format" required>
                        @if ($relay != null && $legs[1]->type == 1)
                            <a href='#' onclick="addSplits(this.parentElement.parentElement, {{ $legs[1]->id }})" id='splits' class='margin-left'>Add Splits</a>
                        @endif
                    </div>   
                </div>

                <div class="form-inline entry">
                    <div class="form-group">
                        @if ($relay != null)
                            <label for="third_leg">Third Leg: {{ $legs[2]->name }}</label>
                        @else
                            <label for="third_leg">Third Leg</label>
                        @endif

                        <select id="third_leg" class="form-control" name="legs[]" required>
                            <option value="">-- Select Athlete --</option>
                            @foreach ($team->roster($gender) as $athlete)
                                <option value="{{ $athlete->id }}">{{ $athlete->name }}</option>
                            @endforeach
                        </select>
                    </div>    

                    <div class="form-group performance">
                        <label for="third_leg_split">Split</label>
                        <input type="text" id="third_leg_split" name="splits[]" class="form-control" placeholder="Enter in mm:ss format" required>
                        @if ($relay != null && $legs[2]->type == 1)
                            <a href='#' onclick="addSplits(this.parentElement.parentElement, {{ $legs[2]->id }})" id='splits' class='margin-left'>Add Splits</a>
                        @endif
                    </div>   
                </div>

                <div class="form-inline entry">
                    <div class="form-group">
                        @if ($relay != null)
                            <label for="anchor_leg">Anchor Leg: {{ $legs[3]->name }}</label>
                        @else
                            <label for="anchor_leg">Anchor Leg</label>
                        @endif

                        <select id="anchor_leg" class="form-control" name="legs[]" required>
                            <option value="">-- Select Athlete --</option>
                            @foreach ($team->roster($gender) as $athlete)
                                <option value="{{ $athlete->id }}">{{ $athlete->name }}</option>
                            @endforeach
                        </select>
                    </div>    

                    <div class="form-group performance">
                        <label for="fourth_leg_split">Split</label>
                        <input type="text" id="fourth_leg_split" name="splits[]" class="form-control" placeholder="Enter in mm:ss format" required>
                        @if ($relay != null && $legs[3]->type == 1)
                            <a href='#' onclick="addSplits(this.parentElement.parentElement, {{ $legs[3]->id }})" id='splits' class='margin-left'>Add Splits</a>
                        @endif
                    </div>   
                </div>

                <div class="form-inline event">
                    <div class="form-group">
                        <label for="time">Total Time</label>
                        <input id="time" type="text" class="form-control" name="time" placeholder="Enter in mm:ss format" required>
                    </div>

                    <div class="form-group">
                        <label for="place">Place</label>
                        <input id="place" type="number" class="form-control" name="place" style="width:30%">
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

        <div class='right-margin'>
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
function changeToIndividual() {
    window.location.href = "{{ route('add-results-individual', $meet->id) }}";
}

function setRelay() {
    window.location.href = '/coach/add-results/relay/' + "{{ $meet->id }}/" + $('#event option:selected').val() + "/{{ $gender }}";
}

@if ($relay != null) 
$(document).ready(function(){
    $('#event option[value={{ $relay->id }}]').attr('selected', 'selected');
});

function addSplits(appendTo, event) {
    var tempSplits = document.createElement("div");

    console.log(event);

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
                                        <input name='lap_1[]' class='form-control' placeholder='Lap 1' style='width:10%' required> \
                                        <input name='lap_2[]' class='form-control' placeholder='Lap 2' style='width:10%' required> \
                                        <input name='lap_3[]' class='form-control' placeholder='Lap 3' style='width:10%' required> \
                                        <a href='#' onclick='removeSplits(this.parentElement.parentElement)'>Cancel</a> \
                                    </div> \
                                </div>";
    }

    appendTo.append(tempSplits.firstChild);
    $(appendTo).find("#splits").remove();
}

function removeSplits(splits) {
    $(splits).siblings('.performance').append("<a href='#' onclick='addSplits(this.parentElement.parentElement)' id='splits' class='margin-left'>Add Splits</a>");
    $(splits).remove();
} 
@endif

</script>
@endsection