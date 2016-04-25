@extends('app')
@section('contentheader_title')
    <i class="fa fa-book"></i>Delete Subject
@endsection
@section('main-content')
	{!! Form::open(array('class' => 'form-inline',  'method' => 'DELETE', 'route' => array('subjects.destroy', $subject->id))) !!}
		Do you really want to delete {{ $subject->subjectTitle }} ?
        <a href="{{ route('subjects.index') }}"class="btn btn-default">Cancel</a>
        {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
    {!! Form::close() !!}
@endsection
