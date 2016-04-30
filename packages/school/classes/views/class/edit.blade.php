@extends('app')
@section('contentheader_title')
<i class="fa fa-sitemap"></i> Edit {{ $class['className'] }}
@endsection

@section('main-content')
<div class="row">
    <div class="col-md-12">
        @if (isset($errors) && count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="box box-info">
            <!-- form start -->
            {!! Form::model($class, array('route' => array('classes.update', $class['id']), 'method' => 'PUT', 'class' => 'form-horizontal' )) !!}
            <div class="box-body">

                <div class="form-group">
                    {!! Form::label('className', 'Class Name', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('className', null, ['class' => 'form-control' ]) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('classTeacher', 'Class Teacher', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::select('classTeacher[]', $teachers, null, ['class' => 'form-control', 'multiple' => 'multiple']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('classSubjects', 'Class Subjects', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::select('classSubjects[]', $subjects, null, ['class' => 'form-control', 'multiple' => 'multiple' ]) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('dormitoryId', 'Dormitory', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::select('dormitoryId', [''=>'Select Dormitory'] + $dormitories, null, ['class' => 'form-control' ]) !!}
                    </div>
                </div>

            </div>
            <div class="box-footer">
                <a href="{{ route('classes.index') }}" class="btn btn-default pull-left">Cancel</a>
                {!! Form::submit('Edit Class', array('class' => 'btn btn-info pull-right')) !!}
            </div>
            {!! Form::close() !!}
        </div><!-- /.box -->
    </div>
</div>
@endsection
