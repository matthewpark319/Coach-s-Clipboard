@extends('layouts.athlete-home')

@section('content')
<div class="main">
	<div class="top-header-container">
		<div class="header-center">
            <h2 class="top-header">Team</h2>
        </div>
	</div>

	<div class="half-page">
        <div class="half-header-container">
            <div class="header-center">
                <h3 class="top-header">Roster</h3>
            </div>
        </div>
        <div class="half-content">
            <div class="list-container-scroll">
                <table class="table table-bordered table-hover">
                    <col style="width:50%">
                    <col style="width:50%">
                    <thead>
                        <th>Name</th>
                        <th>Level</th>
                    </thead>
                    <tbody>
                        @foreach ($team->roster() as $teammate)
                            <tr>
                                <td><a href="{{ route('athlete-view-athlete', ['athlete' => $teammate->id]) }}">{{ $teammate->name }}</a></td>
                                <td>{{ $teammate->level }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>

    <div class="half-page">
        <div class="half-header-container">
            <div class="header-center">
                <h3 class="top-header">Team Info</h3>
            </div>
        </div>

        <div class="half-content">
            <h4 class="info">School: {{ $team->school }}</h4>
            <h4 class="info">Team Name: {{ $team->name }}</h4>
            <h4 class="info">Head Coach: {{ $team->headCoachName() }}</h4>
            @foreach ($team->nonHeadCoaches() as $c)
                <h4 class="info">Assistant Coach: {{ $c->name }}</h4>
            @endforeach
        </div>
        
    </div>
</div>
@endsection