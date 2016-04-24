@extends('app')
@section('contentheader_title')
    <i class="fa fa-bus"></i> Delete Transports
@endsection
@section('main-content')
	{!! Form::open(array('class' => 'form-inline',  'method' => 'DELETE', 'route' => array('transports.destroy', $transport->id))) !!}
		Do you really want to delete {{ $transport->transportTitle }} ?
        <a href="{{ route('transports.index') }}"class="btn btn-default">Cancel</a>
        {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
    {!! Form::close() !!}
@endsection
