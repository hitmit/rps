@extends('app')
@section('contentheader_title')
  <i class="fa fa-sitemap"></i>  Delete {{ $section->sectionName }}
@endsection
@section('main-content')
	{!! Form::open(array('class' => 'form-inline',  'method' => 'DELETE', 'route' => array('sections.destroy', $section->id))) !!}
		Do you really want to delete {{ $section->sectionName }} ?
        <a href="{{ route('sections.index') }}"class="btn btn-default">Cancel</a>
        {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
    {!! Form::close() !!}
@endsection
