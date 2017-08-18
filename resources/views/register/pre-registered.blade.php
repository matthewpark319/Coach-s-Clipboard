@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Pre-Registered Athletes</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('pre-registered') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="team_id" class="col-md-4 control-label">Enter Team ID</label>

                            <div class="col-md-6">
                                <input id="team_id" type="text" class="form-control" name="team_id" value="{{ old('team_id') }}" required autofocus>

                                @if ($errors->has('team_id'))
                                    <span class="help-block">{{ $errors->first('team_id') }}</span>
                                @endif
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
