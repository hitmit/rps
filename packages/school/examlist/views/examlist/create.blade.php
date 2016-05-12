@extends('app')
@section('contentheader_title')
<i class="fa fa-graduation-cap"></i> Create Exam
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
            {!! Form::open(['route' => 'examlist.store']) !!}
            <div class="box-body">

                <div class="form-group">
                    {!! Form::label('examTitle', 'Exam Title *') !!}
                    {!! Form::text('examTitle', null, ['class' => 'form-control', 'required' => 'required']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('examDescription', 'Exam Description') !!}
                    {!! Form::textarea('examDescription', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('examDate', 'Date *') !!}
                    {!! Form::date('examDate', null, ['class' => 'form-control', 'required' => 'required']) !!}
                </div>

            </div><!-- /.box-body -->
            <div class="box-footer">
                <a href="{{ route('examlist.index')}}" class="btn btn-default pull-left">Cancel</a>
                <button type="submit" class="btn btn-info pull-right">Add Exam</button>
            </div><!-- /.box-footer -->
            {!! Form::close(); !!}
        </div><!-- /.box -->
    </div>
</div>
@endsection
