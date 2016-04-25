@extends('app')
@section('contentheader_title')
    <i class="fa fa-building-o"></i>Delete Dormitory
@endsection
@section('main-content')
	{!! Form::open(array('class' => 'form-inline',  'method' => 'DELETE', 'route' => array('dormitory.destroy', $dormitory->id))) !!}
		Do you really want to delete {{ $dormitory->dormitory }} ?
        <a href="{{ route('dormitory.index') }}"class="btn btn-default">Cancel</a>
        {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
    {!! Form::close() !!}
@endsection
