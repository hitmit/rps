@extends('app')
@section('contentheader_title')
<i class="fa fa-sitemap"></i> Edit {{ $section['sectionName'] }}
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
            {!! Form::model($section, array('route' => array('sections.update', $section['id']), 'method' => 'PUT', 'class' => 'form-horizontal' )) !!}
            <div class="box-body">

                <div class="form-group">
                    {!! Form::label('sectionName', 'Section Name *', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('sectionName', null, ['class' => 'form-control' ]) !!}
                    </div>
                </div>
                
                <div class="form-group">
                    {!! Form::label('sectionTitle', 'Section Title *', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('sectionTitle', null, ['class' => 'form-control' ]) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('classId', 'Class *', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::select('classId', $classes, null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('teacherId', 'Teacher *', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::select('teacherId[]', $teachers, null, ['class' => 'form-control', 'multiple' => 'multiple' ]) !!}
                    </div>
                </div>

            </div>
            <div class="box-footer">
                <a href="{{ route('sections.index') }}" class="btn btn-default pull-left">Cancel</a>
                {!! Form::submit('Edit Section', array('class' => 'btn btn-info pull-right')) !!}
            </div>
            {!! Form::close() !!}
        </div><!-- /.box -->
    </div>
</div>
@endsection
