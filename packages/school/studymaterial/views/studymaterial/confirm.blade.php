@extends('app')
@section('contentheader_title')
     <i class="fa fa-book"></i> Delete Study Material
@endsection
@section('main-content')
	{!! Form::open(array('class' => 'form-inline',  'method' => 'DELETE', 'route' => array('studymaterials.destroy', $studymaterial->id))) !!}
		Do you really want to delete {{ $studymaterial->material_title }} ?
        <a href="{{ route('studymaterials.index') }}"class="btn btn-default">Cancel</a>
        {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
    {!! Form::close() !!}
@endsection
