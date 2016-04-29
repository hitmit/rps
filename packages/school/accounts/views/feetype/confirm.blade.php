@extends('app')
@section('contentheader_title')
    Delete Fee Type
@endsection
@section('main-content')
	{!! Form::open(array('class' => 'form-inline',  'method' => 'DELETE', 'route' => array('feetype.destroy', $feetype->id))) !!}
		Do you really want to delete {{ $feetype->feeTitle }} ?
        <a href="{{ route('feetype.index') }}"class="btn btn-default">Cancel</a>
        {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
    {!! Form::close() !!}
@endsection
