@extends('app')
@section('contentheader_title')
<i class="fa fa-bus"></i> Create Transports
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
            <form role="form" method="POST" class="form-horizontal" action="{{ route('transports.store')}}">
                {!! csrf_field() !!}
                <div class="box-body">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Transport title *</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" required="required" placeholder="Transport title" name="transportTitle" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-sm-2 control-label">Transport Description</label>
                        <div class="col-sm-10">
                            <textarea name="transportDescription" class="form-control" placeholder="Transport Description"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-2 control-label">Driver Contact</label>
                        <div class="col-sm-10">
                            <textarea name="transportDriverContact" class="form-control" placeholder="Driver Contact" ></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Fare</label>
                        <div class="col-sm-10">
                            <input type="text" name="transportFare" class="form-control" required="required" placeholder="Fare">
                        </div>
                    </div>
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <a href="{{ route('transports.index')}}" class="btn btn-default pull-left">Cancel</a>
                    <button type="submit" class="btn btn-info pull-right">Create</button>
                </div><!-- /.box-footer -->
            </form>
        </div><!-- /.box -->
    </div>
</div>
@endsection
