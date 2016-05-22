@extends('app')
@section('contentheader_title')
     <i class="fa fa-check-square-o"></i> Delete Grade level
@endsection
@section('main-content')
	{!! Form::open(array('class' => 'form-inline',  'method' => 'DELETE', 'route' => array('gradelevels.destroy', $gradelevel->id))) !!}
		Do you really want to delete {{ $gradelevel->gradeName }} ?
        <a href="{{ route('gradelevels.index') }}"class="btn btn-default">Cancel</a>
        {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
    {!! Form::close() !!}
@endsection
