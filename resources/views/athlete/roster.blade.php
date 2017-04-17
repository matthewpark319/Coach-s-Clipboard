@extends('layouts.athlete-home')

@section('content')
<div class="main">
	<div class="top-header-container">
		<h2 class="top-header">Roster</h2>
	</div>

	<div class="content-container-lg">
        <div class="table-container">
            <table class="table table-bordered table-hover">
                <col style="width:33%">
                <col style="width:33%">
                <col style="width:34%">
                <thead>
                    <th>Name</th>
                    <th>Level</th>
                    <th>Events</th>
                </thead>
                <tbody>
                    @foreach ($team->teammates($athlete->id) as $teammate)
                        <tr>
                            <td><a href="{{ route('athlete-view-athlete', ['teammate' => $teammate->id]) }}">{{ $teammate->name }}</a></td>
                            <td>{{ $teammate->level }}</td>
                            <td>{{ $teammate->events }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
	</div>
</div>
@endsection