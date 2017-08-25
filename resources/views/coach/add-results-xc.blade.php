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
            <form method="post" id="form" action="{{ route('add-xc-results', ['meet' => $meet->id]) }}">
                {{ csrf_field() }}
                <div class="form-inline event">
                    <div class="form-group">
                        <label for="event">Event</label>
                   
                        <select id="event" class="form-control" name="event" required>
                            <option value="">-- Select Event --</option>

                            @foreach (\App\Event::getXCEvents() as $e)
                                <option value="{{ $e->id }}">{{ $e->name }}</option>
                            @endforeach
                        </select>
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
                            <input id="result" type="text" class="form-control" name="result[]" placeholder="Enter in mm:ss format" required>
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

            <div class="error-container">
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

function addNewEntry() {
    var remove = "<a id='remove' href='#' onclick='removeEntry(this)'><img id='plus' src=\"{{ asset('/images/red-minus-hi.png') }}\"></a>";
    var clone = $('.entry').first().clone();
    clone.find("#result").val('');
    clone.find("#place").val('');
    clone.find('#add').after(remove);

    $('#form').append(clone);
}

function removeEntry(element) {
    $(element).closest('.entry').remove();
}

</script>
@endsection