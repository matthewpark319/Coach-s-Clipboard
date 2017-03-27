@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create or Join a Team</div>
                <div class="panel-body">
                    <div class="form-horizontal">
                        {{ csrf_field() }}

                        <a href="{{ route('create-team') }}">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <h3>Create a new team</h3>
                                </div>
                            </div> 
                        </a>   

                        <a href="{{ route('join-team') }}">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <h3>Join a team</h3>
                                </div>
                            </div> 
                        </a>   
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection