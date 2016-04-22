@extends('app')
@section('contentheader_title')
    Delete Role
@endsection
@section('main-content')
	{!! Form::open(array('class' => 'form-inline',  'method' => 'DELETE', 'route' => array('admin.role.destroy', $role->id))) !!}
		Do you really want to delete {{ $role->name }} ?
        <a href="{{ route('admin.role.index') }}"class="btn btn-default">Cancel</a>
        {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
    {!! Form::close() !!}
@endsection
