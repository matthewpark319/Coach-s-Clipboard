@extends('layouts.coach-home')

@section('content')
<div class="main">
	<div class="top-header-container">
		<div class="header-center">
            <h2 class="top-header">Start New Season</h2>
        </div>
	</div>

	<div class="content-container-lg">
        <div class="form-container">
            <form id="form" class="form-horizontal" method="post">
                {{ csrf_field() }}
                <input name="team_id" type="hidden" value="{{ $team->id }}">
                <div class="form-group">
                    <div class="col-md-2">
                        <label class="float-right" for="name">Season</label>
                    </div>
                    
                    <div class="col-md-8">
                        <select id="name" type="text" class="form-control" name="name" required>
                            <option value="">-- Select Season--</option>
                            <option value="Cross Country">Cross Country</option>
                            <option value="Indoor Track">Indoor Track</option>
                            <option value="Outdoor Track">Outdoor Track</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-2">
                        <label class="float-right" for="year">Year of Season</label>
                    </div>
                    <div class="col-md-8">
                        <input id="year" type="text" class="form-control" name="year" placeholder="Enter in yyyy format" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-2">
                        <label class="float-right" for="year" style="text-align:right">Set new season as current</label>
                    </div>
                    <div class="col-md-8">
                        <input style="height:20px; width:20px" type="checkbox" name="current">
                    </div>
                </div>

            </form>

            <div class="container">
            @if (count($errors) > 0)
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            @endif
            </div>
        </div>

        <div class="right-margin">
            <div class="button-container">
                <a href="{{ route('coach-home') }}"> 
                    <button type="button" class="btn btn-default add-button">Back</button>
                </a>
                <button onclick="$('#form').submit()" class="btn btn-default add-button">Next</button>
            </div>
        </div>
		
	</div>

	
</div>
@endsection