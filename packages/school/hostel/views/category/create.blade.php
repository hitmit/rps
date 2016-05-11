@extends('app')
@section('contentheader_title')
<i class="fa fa-check-square-o"></i> Create Hostel
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
            {!! Form::open(['route' => 'hostelCat.store']) !!}
            <div class="box-body">

                <div class="form-group">
                    {!! Form::label('catTitle', 'Category Title *') !!}
                    {!! Form::text('catTitle', null, ['class' => 'form-control', 'required' => 'required']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('catTypeId', 'Hostel *') !!}
                    {!! Form::select('catTypeId', $hostels, null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('catFees', 'Fee *') !!}
                    {!! Form::text('catFees', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('catNotes', 'Notes') !!}
                    {!! Form::textarea('catNotes', null, ['class' => 'form-control']) !!}
                </div>
            </div><!-- /.box-body -->
            <div class="box-footer">
                <a href="{{ route('hostel.index')}}" class="btn btn-default pull-left">Cancel</a>
                <button type="submit" class="btn btn-info pull-right">Add Hostel Category</button>
            </div><!-- /.box-footer -->
            {!! Form::close(); !!}
        </div><!-- /.box -->
    </div>
</div>
@endsection
