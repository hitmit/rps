@extends('app')
@section('contentheader_title')
    Delete NewsBoard
@endsection
@section('main-content')
	{!! Form::open(array('class' => 'form-inline',  'method' => 'DELETE', 'route' => array('newsboard.destroy', $newsboard->id))) !!}
		Do you really want to delete {{ $newsboard->newsTitle }} ?
        <a href="{{ route('hostel.index') }}"class="btn btn-default">Cancel</a>
        {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
    {!! Form::close() !!}
@endsection
