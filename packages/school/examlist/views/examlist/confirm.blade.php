@extends('app')
@section('contentheader_title')
    Delete Exam
@endsection
@section('main-content')
	{!! Form::open(array('class' => 'form-inline',  'method' => 'DELETE', 'route' => array('examlist.destroy', $examlist->id))) !!}
		Do you really want to delete {{ $examlist->examTitle }} ?
        <a href="{{ route('examlist.index') }}"class="btn btn-default">Cancel</a>
        {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
    {!! Form::close() !!}
@endsection
