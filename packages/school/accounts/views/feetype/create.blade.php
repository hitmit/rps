@extends('app')
@section('contentheader_title')
    <i class="fa fa-money"></i> Create Fee Type
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
                <form role="form" method="POST" class="form-horizontal" action="{{ route('feetype.store') }}">
                	{!! csrf_field() !!}
                  	<div class="box-body">
                    	<div class="form-group">
                      		<label for="name" class="col-sm-2 control-label">Fee Title </label>
                      		<div class="col-sm-10">
                        		<input type="text" class="form-control" required="required" placeholder="Fee Title" name="feeTitle" />
                      		</div>
                    	</div>

                    	<div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Default amount </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" required="required" placeholder="Default amount" name="feeDefault" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Notes </label>
                            <div class="col-sm-10">
                                <textarea class="form-control" placeholder="Notes" name="feeNotes" ></textarea>
                            </div>
                        </div>

                   	</div><!-- /.box-body -->
                  	<div class="box-footer">
	                    <a href="{{ route('feetype.index') }}" class="btn btn-default pull-left">Cancel</a>
	                    <button type="submit" class="btn btn-info pull-right">Add fee type</button>
                  	</div><!-- /.box-footer -->
                </form>
            </div><!-- /.box -->
    	</div>
    </div>
@endsection
