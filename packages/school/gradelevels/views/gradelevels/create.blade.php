@extends('app')
@section('contentheader_title')
    <i class="fa fa-check-square-o"></i> Add Grade level
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
            {!! Form::open(['route' => 'gradelevels.store']) !!}
                <div class="box-body">
                    <div class="form-group">
                        {!! Form::label('gradeName', 'Grade Name *') !!}
                        {!! Form::text('gradeName', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('gradeDescription', 'Grade Description') !!}
                        {!! Form::textarea('gradeDescription', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('gradePoints', 'Grade Points *') !!}
                        {!! Form::text('gradePoints', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('gradeFrom', 'Grade From *') !!}
                        {!! Form::text('gradeFrom', null, ['class' => 'form-control', 'required' => 'required'] ) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('gradeTo', 'Grade To *') !!}
                        {!! Form::text('gradeTo', null, ['class' => 'form-control', 'required' => 'required'] ) !!}
                    </div>
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <a href="{{ route('gradelevels.index')}}" class="btn btn-default pull-left">Cancel</a>
                    <button type="submit" class="btn btn-info pull-right">Add Grade Level</button>
                </div><!-- /.box-footer -->
            {!! Form::close(); !!}<!-- /form -->
        </div><!-- /.box -->
    </div>
</div>
@endsection
