@extends('app')
@section('contentheader_title')
<i class="fa fa-bus"></i> Edit {{ $transport->transportTitle }} Transport
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
            {!! Form::model($transport, array('route' => array('transports.update', $transport->id), 'method' => 'PUT', 'class' => 'form-horizontal' )) !!}
            <div class="box-body">

                <div class="form-group">
                    {!! Form::label('transportTitle', 'Transport Title', array('class' => 'col-sm-2 control-label')) !!}
                    <div class="col-sm-10">
                        {!! Form::text('transportTitle', null, array('class' => 'form-control' )) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('transportDescription', 'Transport Description', array('class' => 'col-sm-2 control-label')) !!}
                    <div class="col-sm-10">
                        {!! Form::textarea('transportDescription', null, array('class' => 'form-control' )) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('transportDriverContact', 'Driver Contact', array('class' => 'col-sm-2 control-label')) !!}
                    <div class="col-sm-10">
                        {!! Form::textarea('transportDriverContact', null, array('class' => 'form-control' )) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('transportFare', 'Fare', array('class' => 'col-sm-2 control-label')) !!}
                    <div class="col-sm-10">
                        {!! Form::text('transportFare', null, array('class' => 'form-control' )) !!}
                    </div>
                </div>

                
            </div>
            <div class="box-footer">
                <a href="{{ route('transports.index') }}" class="btn btn-default pull-left">Cancel</a>
                {!! Form::submit('Edit', array('class' => 'btn btn-info pull-right')) !!}
            </div>
            {!! Form::close() !!}
        </div><!-- /.box -->
    </div>
</div>
@endsection
