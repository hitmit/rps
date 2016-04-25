@extends('app')
@section('contentheader_title')
<i class="fa fa-building-o"></i> Edit {{ $dormitory->dormitory }} Dormitory
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
            {!! Form::model($dormitory, array('route' => array('dormitory.update', $dormitory->id), 'method' => 'PUT', 'class' => 'form-horizontal' )) !!}
            <div class="box-body">

                <div class="form-group">
                    {!! Form::label('dormitory', 'Dormitory Name', array('class' => 'col-sm-2 control-label')) !!}
                    <div class="col-sm-10">
                        {!! Form::text('dormitory', null, array('class' => 'form-control' )) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('dormDesc', 'Dormitory Description', array('class' => 'col-sm-2 control-label')) !!}
                    <div class="col-sm-10">
                        {!! Form::text('dormDesc', null, array('class' => 'form-control' )) !!}
                    </div>
                </div>

            </div>
            <div class="box-footer">
                <a href="{{ route('dormitory.index') }}" class="btn btn-default pull-left">Cancel</a>
                {!! Form::submit('Edit Dormitory', array('class' => 'btn btn-info pull-right')) !!}
            </div>
            {!! Form::close() !!}
        </div><!-- /.box -->
    </div>
</div>
@endsection
