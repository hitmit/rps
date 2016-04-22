@extends('app')
@section('contentheader_title')
    Delete Academic Year
@endsection
@section('main-content')
	{!! Form::open(array('class' => 'form-inline',  'method' => 'DELETE', 'route' => array('admin.academic.destroy', $academicYear->id))) !!}
		Do you really want to delete {{ $academicYear->name }} ?
        <a href="{{ route('admin.academic.index') }}"class="btn btn-default">Cancel</a>
        {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
    {!! Form::close() !!}
@endsection
