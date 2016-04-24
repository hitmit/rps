@extends('app')
@section('contentheader_title')
    Delete Student
@endsection
@section('main-content')
	{!! Form::open(array('class' => 'form-inline',  'method' => 'DELETE', 'route' => array('students.destroy', $user->id))) !!}
		Do you really want to delete {{ $user->email }} ?
        <a href="{{ route('students.index') }}"class="btn btn-default">Cancel</a>
        {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
    {!! Form::close() !!}
@endsection
