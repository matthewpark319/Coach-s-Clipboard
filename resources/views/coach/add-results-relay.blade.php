@extends('layouts.coach-home')

@section('content')
<div class="main">
	<div class="top-header-container">
		<h2 class="top-header">Add Results for {{ $meet->name }}</h2>
	</div>

	<div class="content-container-lg">
		<div class="form-container-small">
            <form method="post" id="form" url="{{ $meet->id }}" action="{{ $meet->id }}">
                {{ csrf_field() }}
                <input name="team_id" type="hidden" value="{{ $team->id }}">
                <div class="form-inline event">
                    <div class="form-group">
                        <label for="event">Event</label>
                   
                        <select id="event" class="form-control" name="event" required>
                            <option value="">-- Select Event --</option>

                            @foreach (\App\Event::getRelayEvents() as $e)
                                <option value="{{ $e->id }}" class="{{ $e->type }}">{{ $e->name }}</option>
                            @endforeach
                        </select>

                        <label for="relay" style="padding-left:15px">Relay</label>
                        <input id="relay" type="checkbox" name="relay" class="checkbox" onchange="changeToIndividual()" checked>
                        
                    </div>
                    
                </div>

                <div class="entry">
                    <div class="form-inline event">
                        <div class="form-group">
                            <label for="first_leg">First Leg</label>
                            <select id="first_leg" class="form-control" name="legs[]" required>
                                <option value="">-- Select Athlete --</option>
                                @foreach ($team->roster() as $athlete)
                                    <option value="{{ $athlete->id }}">{{ $athlete->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group margin-left">
                            <label for="first_leg_split">Split</label>
                            <input type="text" id="first_leg_split" name="splits[]" class="form-control" placeholder="Enter in mm:ss format" required>
                        </div> 
                    </div>
                    
                    <div class="form-inline event">
                        <div class="form-group">
                            <label for="second_leg">Second Leg</label>
                            <select id="second_leg" class="form-control" name="legs[]" required>
                                <option value="">-- Select Athlete --</option>
                                @foreach ($team->roster() as $athlete)
                                    <option value="{{ $athlete->id }}">{{ $athlete->name }}</option>
                                @endforeach
                            </select>
                        </div> 

                        <div class="form-group margin-left">
                            <label for="second_leg_split">Split</label>
                            <input type="text" id="second_leg_split" name="splits[]" class="form-control" placeholder="Enter in mm:ss format" required>
                        </div>   
                    </div>

                    <div class="form-inline event">
                        <div class="form-group">
                            <label for="third_leg">Third Leg</label>
                            <select id="third_leg" class="form-control" name="legs[]" required>
                                <option value="">-- Select Athlete --</option>
                                @foreach ($team->roster() as $athlete)
                                    <option value="{{ $athlete->id }}">{{ $athlete->name }}</option>
                                @endforeach
                            </select>
                        </div>    

                        <div class="form-group margin-left">
                            <label for="third_leg_split">Split</label>
                            <input type="text" id="third_leg_split" name="splits[]" class="form-control" placeholder="Enter in mm:ss format" required>
                        </div>   
                    </div>

                    <div class="form-inline event">
                        <div class="form-group">
                            <label for="fourth">Fourth Leg</label>
                            <select id="fourth_leg" class="form-control" name="legs[]" required>
                                <option value="">-- Select Athlete --</option>
                                @foreach ($team->roster() as $athlete)
                                    <option value="{{ $athlete->id }}">{{ $athlete->name }}</option>
                                @endforeach
                            </select>
                        </div>    

                        <div class="form-group margin-left">
                            <label for="fourth_leg_split">Split</label>
                            <input type="text" id="fourth_leg_split" name="splits[]" class="form-control" placeholder="Enter in mm:ss format" required>
                        </div>   
                    </div>

                    <div class="form-inline event">
                        <div class="form-group">
                            <label for="time">Total Time</label>
                            <input id="time" type="text" class="form-control" name="time" placeholder="Enter in mm:ss format" required>
                        </div>

                        <div class="form-group margin-left">
                            <label for="place">Place</label>
                            <input id="place" type="number" class="form-control" name="place" style="width:30%">
                        </div>
                    </div>

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
function changeToIndividual() {
    window.location.href = "{{ route('add-results-individual', $meet->id) }}";
}
</script>
@endsection