@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create a Team</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="post">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Team Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" placeholder="ex. Knights, Lions" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                <!-- @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif -->
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="school" class="col-md-4 control-label">School</label>

                            <div class="col-md-6">
                                <input id="school" type="text" placeholder="ex. Bergen Tech" class="form-control" name="school" value="{{ old('school') }}" required>

                                <!-- @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif -->
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Create Team Password</label>

                            <div class="col-md-6">
                                <input id="password" type="text" class="form-control" name="password" required>

                            </div>
                        </div>


                        @if (count($errors) > 0)
                        <div class="form-group">
                            @foreach($errors->all() as $e)
                            	<li class="error-margin-left">{{ $e }}</li>
                        	@endforeach
                        </div>
                        @endif

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