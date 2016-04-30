@extends('app')
@section('contentheader_title')
  <i class="fa fa-sitemap"></i>  Delete {{ $class->className }}
@endsection
@section('main-content')
	{!! Form::open(array('class' => 'form-inline',  'method' => 'DELETE', 'route' => array('classes.destroy', $class->id))) !!}
		Do you really want to delete {{ $class->className }} ?
        <a href="{{ route('classes.index') }}"class="btn btn-default">Cancel</a>
        {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
    {!! Form::close() !!}
@endsection
