@extends('app')
@section('contentheader_title')
    Edit {{ $role->name }}
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
				{!! Form::model($role, array('route' => array('admin.role.update', $role->id), 'method' => 'PUT', 'class' => 'form-horizontal' )) !!}
					<div class="box-body">

						<div class="form-group">
							{!! Form::label('name', 'Role', array('class' => 'col-sm-2 control-label')) !!}
							<div class="col-sm-10">
								{!! Form::text('name', null, array('class' => 'form-control' )) !!}
							</div>
						</div>

					</div>
				<div class="box-footer">
					<a href="{{ route('admin.role.index') }}" class="btn btn-default pull-left">Cancel</a>
					{!! Form::submit('Edit', array('class' => 'btn btn-info pull-right')) !!}
				</div>
				{!! Form::close() !!}
			</div><!-- /.box -->
		</div>
	</div>
@endsection
