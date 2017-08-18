@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Choose Season</div>
                <div class="panel-body">

                    <form class="form-horizontal" role="form" method="POST" action="{{ route($route) }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="team_id" class="col-md-4 control-label">Choose Season to Register For</label>

                            <div class="col-md-6">
                                <select id="season" class="form-control" name="season" required>
                                    <option value="">-- Choose Season --</option>
                                    @foreach ($team->allSeasons() as $season)
                                        <option value="{{ $season->id }}">{{ $season->year . ' ' . $season->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
