@extends('app')
@section('contentheader_title')
    <i class="fa fa-file-pdf-o"></i> Edit Study Material
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
            {!! Form::model($assignment, ['route' => array('assignments.update', $assignment->id), 'method' => 'PUT', 'files' => true ]) !!}
                <div class="box-body">

                    <div class="form-group">
                        {!! Form::label('AssignTitle', 'Assignment Title *') !!}
                        {!! Form::text('AssignTitle', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('AssignDescription', 'Assignment Description') !!}
                        {!! Form::textarea('AssignDescription', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('AssignDeadLine', 'Assignment Deadline *') !!}
                        {!! Form::date('AssignDeadLine', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('AssignFile', 'Assignment File') !!}
                        {!! Form::file('AssignFile', ['class' => 'form-control']) !!}
                        @if($assignment->AssignFile)
                            <img src="{{ asset('uploads/assignments/' . $assignment->AssignFile) }}" height="150" width="150" />
                        @endif
                    </div>

                    <div class="form-group">
                        {!! Form::label('classId', 'Class *') !!}
                        {!! Form::select('classId[]', $classes, null, ['class' => 'form-control', 'multiple' => 'multiple', 'required' => 'required'] ) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('subjectId', 'Subject *') !!}
                        {!! Form::select('subjectId', $subjects, null, ['class' => 'form-control', 'required' => 'required'] ) !!}
                    </div>
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <a href="{{ route('assignments.index')}}" class="btn btn-default pull-left">Cancel</a>
                    <button type="submit" class="btn btn-info pull-right">Edit Assignment</button>
                </div><!-- /.box-footer -->
            {!! Form::close() !!}
        </div><!-- /.box -->
    </div>
</div>
@endsection
