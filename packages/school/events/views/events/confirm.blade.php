@extends('app')
@section('contentheader_title')
    Delete Event
@endsection
@section('main-content')
	{!! Form::open(array('class' => 'form-inline',  'method' => 'DELETE', 'route' => array('events.destroy', $event->id))) !!}
		Do you really want to delete {{ $event->eventTitle }} ?
        <a href="{{ route('events.index') }}"class="btn btn-default">Cancel</a>
        {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
    {!! Form::close() !!}
@endsection
