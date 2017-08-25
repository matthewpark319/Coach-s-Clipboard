@extends('layouts.athlete-home')

@section('content')

<div class="main">
    <div class="top-header-container">
        <div class="header-center">
            <h2 class="top-header">Results</h2>
        </div>

        <div class="select-right">
            <select id="season" onchange="changeSeason('results')">
                <option value="{{ $team->selectedSeason()->id }}">{{ $team->selectedSeason()->info }}</option>
                @foreach ($team->seasonsNotSelected() as $season) 
                    <option value="{{ $season->id }}">{{ $season->info }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="half-page">
        <div class="half-header-container text-align-center">
            <h3 class="top-header">Team Bests</h3>
        </div>

        <div class="half-content">
            <div class="container">
                <div class="col-md-2">
                    <select id="event" name="event" class="form-control" onchange="showTeamBests()">
                        <option value="">-- Select Event --</option>

                        @foreach (\App\Event::getXCEvents() as $e)
                            <option id="{{ $e->id }}" value="{{ $e->id }}" class="{{ $e->type }}">{{ $e->name }}</option> 
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <select id="course" onchange="showTeamBests()" class="form-control">
                        <option value="">-- Select Course --</option>
                        @foreach ($team->courses() as $c) 
                            <option id="{{ $c->id }}" value="{{ $c->id }}">{{ $c->name }}</option>
                        @endforeach
                    </select>
                </div>

            </div>
            @if (isset($event))
                @php
                    $event_id = $event->id;
                    if (isset($course)) $course_id = $course->id;
                    else $course_id = null;

                @endphp
                <div class="list-container" style="margin-top:30px">
                    <h4>Boys</h4>
                    @if (count($team->teamBestsXC($event_id, 1, $course_id)) == 0)
                        <h5>No Results</h5>
                    @else
                        <ul class="list-group">
                        @foreach ($team->teamBestsXC($event_id, 1, $course_id) as $p)
                            <li class="list-group-item">{{ $p->result }}</li>
                        @endforeach
                        </ul>
                    @endif
                </div>

                <div class="list-container" style="margin-top:30px">
                    <h4>Girls</h4>
                    @if (count($team->teamBestsXC($event->id, 0, $course_id)) == 0)
                        <h5>No Results</h5>
                    @else
                        <ul class="list-group">
                        @foreach ($team->teamBestsXC($event->id, 0, $course_id) as $p)
                            <li class="list-group-item">{{ $p->result }}</li>
                        @endforeach
                        </ul>
                    @endif
                </div>

                <script>
                    $(document).ready(function(){
                        var selectedEventId = "#" + "{{ $event_id }}";
                        $(selectedEventId).attr("selected", "selected");

                        var selectedCourseId = "#" + "{{ $course_id }}";
                        $(selectedCourseId).attr("selected", "selected");
                    });
                </script>
            @else 
                <div class="list-container">
                    <h4>Team leading performances will appear here after event is selected.</h4>
                </div>
            @endif

        </div>
    </div>

    <div class="half-page">
        <div class="half-header-container text-align-center">
            <h3 class="top-header">Meet Results</h3>
        </div>

        <div class="half-content">
            <div class="list-container-scroll">
                @php $schedule = $team->scheduleComplete() @endphp

                @if (count($schedule) > 0)
                    <ul class="list-group">
                        @foreach($team->scheduleComplete() as $s) 
                            <a href="{{ route('athlete-view-meet-xc', ['meet' => $s->id]) }}" class="list-group-item">{{ $s->name }}</a>
                        @endforeach
                    </ul>
                @else 
                    <h4 style="text-align:center">-- No meets --</h4>
                @endif
            </div>
            
        </div>
    </div>
</div>

<script>
function showTeamBests() {
    if ($('#event').val()) {
        if ($('#course').val()) window.location.href = "/athlete/results-xc/team-bests/" + $("#event option:selected").val() + "/" + $("#course option:selected").val();
        else window.location.href = "/athlete/results-xc/team-bests/" + $("#event option:selected").val();
    }
}
</script>
@endsection