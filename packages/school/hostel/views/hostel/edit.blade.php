@extends('app')
@section('contentheader_title')
    <i class="fa fa-check-square-o"></i> Edit Hostel
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
            {!! Form::model($hostel, ['route' => array('hostel.update', $hostel->id), 'method' => 'PUT' ]) !!}
                <div class="box-body">
                    <div class="form-group">
                        {!! Form::label('hostelTitle', 'Hostel Title *') !!}
                        {!! Form::text('hostelTitle', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('hostelType', 'Hostel Type *') !!}
                        {!! Form::select('hostelType', ['Boys' => 'Boys', 'Girls' => 'Girls', 'Mixed' => 'Mixed'], null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('hostelAddress', 'Address') !!}
                        {!! Form::text('hostelAddress', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('hostelManager', 'Manager') !!}
                        {!! Form::text('hostelManager', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('hostelNotes', 'Notes') !!}
                        {!! Form::textarea('hostelNotes', null, ['class' => 'form-control']) !!}
                    </div>
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <a href="{{ route('hostel.index')}}" class="btn btn-default pull-left">Cancel</a>
                    <button type="submit" class="btn btn-info pull-right">Edit Hostel</button>
                </div><!-- /.box-footer -->
            </form>
        </div><!-- /.box -->
    </div>
</div>
@endsection
