@extends('app')
@section('contentheader_title')
<i class="fa fa-money"></i> Edit {{ $feetype->feeTitle }} Fee Type
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
            {!! Form::model($feetype, array('route' => array('feetype.update', $feetype->id), 'method' => 'PUT', 'class' => 'form-horizontal' )) !!}
            <div class="box-body">

                <div class="form-group">
                    {!! Form::label('feeTitle', 'Fee Title', array('class' => 'col-sm-2 control-label')) !!}
                    <div class="col-sm-10">
                        {!! Form::text('feeTitle', null, array('class' => 'form-control' )) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('feeDefault', 'Default Amount', array('class' => 'col-sm-2 control-label')) !!}
                    <div class="col-sm-10">
                        {!! Form::text('feeDefault', null, array('class' => 'form-control' )) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('feeNotes', 'Notes', array('class' => 'col-sm-2 control-label')) !!}
                    <div class="col-sm-10">
                        {!! Form::textarea('feeNotes', null, array('class' => 'form-control' )) !!}
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <a href="{{ route('feetype.index') }}" class="btn btn-default pull-left">Cancel</a>
                {!! Form::submit('Edit', array('class' => 'btn btn-info pull-right')) !!}
            </div>
            {!! Form::close() !!}
        </div><!-- /.box -->
    </div>
</div>
@endsection
