@extends('app')
@section('contentheader_title')
     <i class="fa fa-file-pdf-o"></i> Delete Assignment
@endsection
@section('main-content')
	{!! Form::open(array('class' => 'form-inline',  'method' => 'DELETE', 'route' => array('assignments.destroy', $assignment->id))) !!}
		Do you really want to delete {{ $assignment->AssignTitle }} ?
        <a href="{{ route('assignments.index') }}"class="btn btn-default">Cancel</a>
        {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
    {!! Form::close() !!}
@endsection
