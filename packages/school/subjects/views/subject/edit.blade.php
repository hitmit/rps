@extends('app')
@section('contentheader_title')
<i class="fa fa-book"></i> Edit {{ $subject->subjectTitle }} Subject
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
            {!! Form::model($subject, array('route' => array('subjects.update', $subject->id), 'method' => 'PUT', 'class' => 'form-horizontal' )) !!}
            <div class="box-body">

                <div class="form-group">
                    {!! Form::label('subjectTitle', 'Subject Name', array('class' => 'col-sm-2 control-label')) !!}
                    <div class="col-sm-10">
                        {!! Form::text('subjectTitle', null, array('class' => 'form-control' )) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('teacherId', 'Teacher *', array('class' => 'col-sm-2 control-label')) !!}
                    <div class="col-sm-10">
                        {!! Form::select('teacherId',$teachers, null, ['class' => 'form-control']) !!}

                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('passGrade', 'Pass grade *', array('class' => 'col-sm-2 control-label')) !!}
                    <div class="col-sm-10">
                        {!! Form::text('passGrade', null, array('class' => 'form-control' )) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('finalGrade', 'Final grade *', array('class' => 'col-sm-2 control-label')) !!}
                    <div class="col-sm-10">
                        {!! Form::text('finalGrade', null, array('class' => 'form-control' )) !!}
                    </div>
                </div>

            </div>
            <div class="box-footer">
                <a href="{{ route('subjects.index') }}" class="btn btn-default pull-left">Cancel</a>
                {!! Form::submit('Edit Subject', array('class' => 'btn btn-info pull-right')) !!}
            </div>
            {!! Form::close() !!}
        </div><!-- /.box -->
    </div>
</div>
@endsection
