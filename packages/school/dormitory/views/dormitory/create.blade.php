@extends('app')
@section('contentheader_title')
    <i class="fa fa-building-o"></i> Create Dormitory
@endsection
@section('main-content')
    <div class="row">
    	<div class="col-md-12">
    		@if (isset($errors) && count($errors) > 0)
				<div class="alert alert-danger">
					<strong>Whoops!</strong> There were some problems with your input.<br><br>
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif
    		<div class="box box-info">
                <!-- form start -->
                <form role="form" method="POST" class="form-horizontal" action="{{ route('dormitory.store') }}">
                	{!! csrf_field() !!}
                  	<div class="box-body">
                    	<div class="form-group">
                      		<label for="name" class="col-sm-2 control-label">Dormitory Name *</label>
                      		<div class="col-sm-10">
                        		<input type="text" class="form-control" required="required" placeholder="Dormitory Name" name="dormitory" />
                      		</div>
                    	</div>
                    	<div class="form-group">
                      		<label for="description" class="col-sm-2 control-label">Dormitory Description</label>
                      		<div class="col-sm-10">
                        		<textarea name="dormDesc" placeholder="Dormitory Description"></textarea>
                      		</div>
                    	</div>
                   	</div><!-- /.box-body -->
                  	<div class="box-footer">
	                    <a href="{{ route('dormitory.index') }}" class="btn btn-default pull-left">Cancel</a>
	                    <button type="submit" class="btn btn-info pull-right">Create Dormitory</button>
                  	</div><!-- /.box-footer -->
                </form>
            </div><!-- /.box -->
    	</div>
    </div>
@endsection
