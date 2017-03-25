@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Coach Title</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="title" class="col-md-4 control-label">Athletes call you:</label>

                            <div class="col-md-6">
                                <input id="title" type="text" placeholder="ex. Coach Mike, Coach Mykytok" class="form-control" name="title" value="{{ old('title') }}" required autofocus>
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