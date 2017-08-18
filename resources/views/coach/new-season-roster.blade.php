@extends('layouts.coach-home')

@section('content')
<div class="main">
	<div class="top-header-container">
		<div class="header-center">
            <h2 class="top-header">Roster for New Season</h2>
        </div>
	</div>
    <form id="form" method="post" action="{{ route('submit-new-roster') }}" style="margin:0"> 
        {{ csrf_field() }} 
        <input type="hidden" name="team_id" value="{{ $team->id }}">                   
    	<div class="content-container-lg">
            <div class="half-page">
                <div class="half-header-container text-align-center">
                    <h4 class="top-header">Add returning athletes</h4>   
                </div>

                <div class="half-content">
                    <div class="list-container-scroll" style="height:85%">

                    @if (null !== session('old-roster'))
                        <table class="table table-bordered table-hover">
                            <col style="width:33%">
                            <col style="width:33%">
                            <col style="width:34%">
                            <thead>
                                <th>Name</th>
                                <th>Class of</th>
                                <th>Add</th>
                            </thead>
                            <tbody id="old_roster">
                                @foreach(session('old-roster') as $id)
                                    @php $athlete = \App\Athlete::find($id) @endphp
                                    <tr>
                                        <td>{{ $athlete->name() }}</td>
                                        <td>{{ $athlete->grad_year }}</td>
                                        @php $name = str_replace("'", "\'", $athlete->name()) @endphp
                                        <td><a href="#" onclick="addAthlete('{{ $athlete->id }}', '{{ $name }}', '{{ $athlete->grad_year }}', this.parentElement.parentElement)">Add</a></td>
                                        <input type='hidden' value="{{ $athlete->id }}" name='old[]'>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        @php $returning = $team->returningAthletes(session('ns_id'), $team->currentSeason()->id) @endphp
                        @if (count($returning) > 0)
                            <table class="table table-bordered table-hover">
                                <col style="width:33%">
                                <col style="width:33%">
                                <col style="width:34%">
                                <thead>
                                    <th>Name</th>
                                    <th>Class of</th>
                                    <th>Add</th>
                                </thead>
                                <tbody id="old_roster">
                                    @foreach ($returning as $athlete)                               
                                       <tr>
                                            <td>{{ $athlete->name }}</td>
                                            <td>{{ $athlete->grad_year }}</td>
                                            @php $name = str_replace("'", "\'", $athlete->name) @endphp
                                            <td><a href="#" onclick="addAthlete('{{ $athlete->id }}', '{{ $name }}', '{{ $athlete->grad_year }}', this.parentElement.parentElement)">Add</a></td>
                                            <input type='hidden' value="{{ $athlete->id }}" name='old[]'>
                                       </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <h4>No returning athletes for {{ \App\Season::find(session('ns_id'))->year }}</h4>
                        @endif
                    @endif
                    </div>
                </div>
            </div>

            <div class="half-page">
                <div class="half-header-container text-align-center">
                    <h4 class="top-header">Roster for new season</h4>   
                </div>

                <div class="half-content">
                    <div class="list-container-scroll" style="height:85%">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <th>Name</th>
                            </thead>
                            <tbody id="new_roster">
                                @if (null !== session('new-roster'))
                                    @foreach(session('new-roster') as $id)
                                        @php $athlete = \App\Athlete::find($id) @endphp
                                        <tr>
                                            <td>{{ $athlete->name() }}
                                                <a href='#' onclick="removeAthlete({{ $athlete->id }}, '{{ $athlete->name() }}', {{ $athlete->grad_year }}, this.parentElement.parentElement)"" id='remove'><img class='minus float-right' src="{{ asset('/images/red-minus-hi.png') }}"></a>
                                            </td>
                                            <input type='hidden' value='{{ $athlete->id }}' name='new[]'>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <button onclick="$('#form').submit()" class='btn btn-default float-right margin-right'>Submit Roster</button>
            <button onclick="addNewAthlete()" class='btn btn-default float-right margin-right'>Add New Athlete</button>
    	</div>
    </form>
</div>



<script>
function addAthlete(id, name, grad_year, row_to_remove) {
    $(row_to_remove).remove();
    var remove = "<a href='#' onclick=\"removeAthlete(" + id + ", '" + name + "', " + grad_year + ", this.parentElement.parentElement)\" id='remove'><img class='minus float-right' src=\"{{ asset('/images/red-minus-hi.png') }}\"></a>";
    $('#new_roster').append("<tr><td>" + name + remove + "</td> \
        <input type='hidden' value='" + id + "' name='new[]'></tr>");
} 

function removeAthlete(id, name, grad_year, row_to_remove) {
    $(row_to_remove).remove();
    var new_row = "<tr> \
                        <td>" + name + "</td> \
                        <td>" + grad_year + "</td> \
                        <td><a href='#' onclick=\"addAthlete(" + id + ", '" + name + "', " + grad_year + ", this.parentElement.parentElement)\">Add</a></td> \
                        <input type='hidden' value=" + id + " name='old[]'> \
                    </tr>";
    $('#old_roster').append(new_row);
}

function addNewAthlete() {
    $('#form').attr('action', "{{ route('ns-add-athlete') }}");
    $('#form').submit();
}
</script>
@endsection