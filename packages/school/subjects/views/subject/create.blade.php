@extends('app')
@section('contentheader_title')
    <i class="fa fa-book"></i> Create Subject
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
                <form role="form" method="POST" class="form-horizontal" action="{{ route('subjects.store') }}">
                	{!! csrf_field() !!}
                  	<div class="box-body">
                    	<div class="form-group">
                      		<label for="name" class="col-sm-2 control-label">Subject name *</label>
                      		<div class="col-sm-10">
                        		<input type="text" class="form-control" required="required" placeholder="Subject name" name="subjectTitle" />
                      		</div>
                    	</div>

                    	<div class="form-group">
                      		<label for="description" class="col-sm-2 control-label">Teacher *</label>
                      		<div class="col-sm-10">
                      		    <select name="teacherId" class="form-control">
                                    @foreach($teachers as $teacher)
                                        <option value="{{ $teacher->id  }}">{{ $teacher->first_name . ' ' . $teacher->last_name  }}</option>
                                    @endforeach
                      		    </select>
                      		</div>
                    	</div>

                    	<div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Pass grade *</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" required="required" placeholder="Pass grade" name="passGrade" />
                            </div>
                        </div>

                        <div class="form-group">
                      		<label for="name" class="col-sm-2 control-label">Final grade *</label>
                      		<div class="col-sm-10">
                        		<input type="text" class="form-control" required="required" placeholder="Final grade" name="finalGrade" />
                      		</div>
                    	</div>

                   	</div><!-- /.box-body -->
                  	<div class="box-footer">
	                    <a href="{{ route('subjects.index') }}" class="btn btn-default pull-left">Cancel</a>
	                    <button type="submit" class="btn btn-info pull-right">Create Subject</button>
                  	</div><!-- /.box-footer -->
                </form>
            </div><!-- /.box -->
    	</div>
    </div>
@endsection
