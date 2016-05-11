@extends('app')
@section('contentheader_title')
    Delete Hostel
@endsection
@section('main-content')
	{!! Form::open(array('class' => 'form-inline',  'method' => 'DELETE', 'route' => array('hostel.destroy', $hostel->id))) !!}
		Do you really want to delete {{ $hostel->hostelTitle }} ?
        <a href="{{ route('hostel.index') }}"class="btn btn-default">Cancel</a>
        {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
    {!! Form::close() !!}
@endsection
