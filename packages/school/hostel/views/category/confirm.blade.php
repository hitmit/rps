@extends('app')
@section('contentheader_title')
    Delete Hostel Category
@endsection
@section('main-content')
	{!! Form::open(array('class' => 'form-inline',  'method' => 'DELETE', 'route' => array('hostelCat.destroy', $hostelCat->id))) !!}
		Do you really want to delete {{ $hostelCat->catTitle }} ?
        <a href="{{ route('hostelCat.index') }}"class="btn btn-default">Cancel</a>
        {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
    {!! Form::close() !!}
@endsection
