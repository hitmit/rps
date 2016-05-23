@extends('app')
@section('contentheader_title')
     <i class="fa fa-folder-open"></i> Delete Library
@endsection
@section('main-content')
	{!! Form::open(array('class' => 'form-inline',  'method' => 'DELETE', 'route' => array('library.destroy', $library->id))) !!}
		Do you really want to delete {{ $library->bookName }} ?
        <a href="{{ route('library.index') }}"class="btn btn-default">Cancel</a>
        {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
    {!! Form::close() !!}
@endsection
