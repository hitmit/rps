@extends('app')
@section('contentheader_title')
     <i class="fa fa-user"></i> Delete Parent
@endsection
@section('main-content')
	{!! Form::open(array('class' => 'form-inline',  'method' => 'DELETE', 'route' => array('parents.destroy', $user->id))) !!}
		Do you really want to delete {{ $user->email }} ?
        <a href="{{ route('parents.index') }}"class="btn btn-default">Cancel</a>
        {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
    {!! Form::close() !!}
@endsection
