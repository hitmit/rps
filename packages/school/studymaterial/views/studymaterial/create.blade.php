@extends('app')
@section('contentheader_title')
    <i class="fa fa-book"></i> Add Study Material
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
            {!! Form::open(['route' => 'studymaterials.store', 'files' => true]) !!}
                <div class="box-body">
                    <div class="form-group">
                        {!! Form::label('material_title', 'Material Title *') !!}
                        {!! Form::text('material_title', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('material_description', 'Material Description') !!}
                        {!! Form::textarea('material_description', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('material_file', 'Material File') !!}
                        {!! Form::file('material_file', ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('class_id', 'Class *') !!}
                        {!! Form::select('class_id[]', $classes, null, ['class' => 'form-control', 'multiple' => 'multiple', 'required' => 'required'] ) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('subject_id', 'Subject *') !!}
                        {!! Form::select('subject_id', $subjects, null, ['class' => 'form-control', 'required' => 'required'] ) !!}
                    </div>
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <a href="{{ route('studymaterials.index')}}" class="btn btn-default pull-left">Cancel</a>
                    <button type="submit" class="btn btn-info pull-right">Add Study Material</button>
                </div><!-- /.box-footer -->
            {!! Form::close(); !!}<!-- /form -->
        </div><!-- /.box -->
    </div>
</div>
@endsection
