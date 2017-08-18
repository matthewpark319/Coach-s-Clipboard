@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Success</div>
                <div class="panel-body">
                    <div class="form-group">
                        <h2>Account Created Successfully</h2>
                        <h3>{{ $message }}</h3>
                        @if (isset($team_password))
                            <h3>{{ $team_password }}</h3>
                        @endif
                    </div>

                    <div class="form-group">
                        <a href="{{ route('login') }}">Back to login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection