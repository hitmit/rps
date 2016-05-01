@extends('app')
@section('contentheader_title')
    <i class="fa fa-sitemap"></i> Create Class
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
                <form role="form" method="POST" class="form-horizontal" action="{{ route('classes.store') }}">
                	{!! csrf_field() !!}
                  	<div class="box-body">
                    	<div class="form-group">
                      		<label for="name" class="col-sm-2 control-label">Class Name</label>
                      		<div class="col-sm-10">
                        		<input type="text" class="form-control" required="required" placeholder="Class Name" name="className" />
                      		</div>
                    	</div>

                    	<div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Class Teacher</label>
                            <div class="col-sm-10">
                                <select class="form-control" required="required" name="classTeacher[]" multiple="multiple">
                                    @foreach($teachers as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Class Subjects</label>
                            <div class="col-sm-10">
                                <select class="form-control" required="required" name="classSubjects[]" multiple="multiple">
                                    @foreach($subjects as $k => $val)
                                        <option value="{{ $k }}">{{ $val }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Dormitory</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="dormitoryId">
                                    <option value="">Select Dormitory</option>
                                    @foreach($dormitories as $keys => $values)
                                        <option value="{{ $keys }}">{{ $values }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                   	</div><!-- /.box-body -->
                  	<div class="box-footer">
	                    <a href="{{ route('classes.index') }}" class="btn btn-default pull-left">Cancel</a>
	                    <button type="submit" class="btn btn-info pull-right">Add Class</button>
                  	</div><!-- /.box-footer -->
                </form>
            </div><!-- /.box -->
    	</div>
    </div>
@endsection
