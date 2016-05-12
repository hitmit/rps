@extends('app')
@section('contentheader_title')
<i class="fa fa-clock-o"></i> Create Event
@endsection
@section('main-content')
<div class="row">
    <div class="col-md-12">
        @if (isset($errors) && count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error}}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="box box-info">
            <!-- form start -->
            {!! Form::open(['route' => 'events.store']) !!}
            <div class="box-body">

                <div class="form-group">
                    {!! Form::label('eventTitle', 'Event Title *') !!}
                    {!! Form::text('eventTitle', null, ['class' => 'form-control', 'required' => 'required']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('eventDescription', 'Event Description') !!}
                    {!! Form::textarea('eventDescription', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('enentPlace', 'Event Place') !!}
                    {!! Form::text('enentPlace', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('eventFor', 'For *') !!}
                    {!! Form::select('eventFor', ['all' => 'all', 'students' => 'students', 'parents' => 'parents', 'teachers' => 'teachers'], null, ['class' => 'form-control', 'required' => 'required']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('eventDate', 'Date *') !!}
                    {!! Form::date('eventDate', null, ['class' => 'form-control', 'required' => 'required']) !!}
                </div>
            </div><!-- /.box-body -->
            <div class="box-footer">
                <a href="{{ route('events.index')}}" class="btn btn-default pull-left">Cancel</a>
                <button type="submit" class="btn btn-info pull-right">Add Event</button>
            </div><!-- /.box-footer -->
            {!! Form::close(); !!}
        </div><!-- /.box -->
    </div>
</div>
@endsection
