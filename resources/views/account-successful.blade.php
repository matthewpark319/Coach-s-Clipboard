@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Coach Title</div>
                <div class="panel-body">
                    <div class="form-group">
                        <h2>Account Created Successfully</h2>
                        <h2>{{ $message }}</h2>
                    </div>

                    <div class="form-group">
                        <a href="/">Back to login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection