@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Athlete Events</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="post">
                        {{ csrf_field() }}
                       
                        <div class="form-group">
                            <label for="events" class="col-md-4 control-label">Events</label>

                            <div class="col-md-6">
                                <input id="events" type="text" placeholder="ex. Distance, Sprints, Jumps" class="form-control" name="events" required autofocus>
                            </div>    
                        </div>    

                        <div class="form-group">
                            <label for="level" class="col-md-4 control-label">Level</label>

                            <div class="col-md-6">
                                <input id="level" type="text" placeholder="ex. Varsity, JV, Freshman" class="form-control" name="level" required>
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