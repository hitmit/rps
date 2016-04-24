@extends('app')
@section('contentheader_title')
Edit {{ $academicYear->yearTitle }} Academic Year
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
            {!! Form::model($academicYear, array('route' => array('admin.academic.update', $academicYear->id), 'method' => 'PUT', 'class' => 'form-horizontal' )) !!}
            <div class="box-body">

                <div class="form-group">
                    {!! Form::label('yearTitle', 'Year Title', array('class' => 'col-sm-2 control-label')) !!}
                    <div class="col-sm-10">
                        {!! Form::text('yearTitle', null, array('class' => 'form-control' )) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('isDefault', 'Default academic year', array('class' => 'col-sm-2 control-label')) !!}
                    <div class="col-sm-10">
                        {!! Form::checkbox('isDefault', null) !!}
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <a href="{{ url('/admin/vocabulary') }}" class="btn btn-default pull-left">Cancel</a>
                {!! Form::submit('Edit', array('class' => 'btn btn-info pull-right')) !!}
            </div>
            {!! Form::close() !!}
        </div><!-- /.box -->
    </div>
</div>
@endsection
