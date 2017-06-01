@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Join a Team</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="title" class="col-md-4 control-label">Enter Team ID</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="team_id" value="{{ old('team_id') }}" required autofocus>
                            </div>
                        </div>    

                        @if (!session()->has('athlete-events')) 
                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Enter Team Password</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>
                            </div>
                        </div>
                        @endif

                        
                        <div class="form-group">
                            @if (count($errors) > 0)
                                @foreach($errors->all() as $e)
                                	<li class="error-margin-left">{{ $e }}</li>
                            	@endforeach
                            @endif
                            @if ($password_incorrect == True)
                                <li class="error-margin-left">Incorrect password</li>
                            @endif
                        </div>
	                    

	                    
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>                   
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection