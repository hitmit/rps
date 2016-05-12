@extends('app')
@section('contentheader_title')
<i class="fa fa-bullhorn"></i> Create News
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
            {!! Form::open(['route' => 'newsboard.store']) !!}
            <div class="box-body">

                <div class="form-group">
                    {!! Form::label('newsTitle', 'News Title *') !!}
                    {!! Form::text('newsTitle', null, ['class' => 'form-control', 'required' => 'required']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('newsText', 'News content *') !!}
                    {!! Form::textarea('newsText', null, ['class' => 'form-control', 'required' => 'required']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('newsFor', 'For') !!}
                    {!! Form::select('newsFor', ['all' => 'all', 'students' => 'students', 'parents' => 'parents', 'teachers' => 'teachers'], null, ['class' => 'form-control', 'required' => 'required']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('newsDate', 'Date') !!}
                    {!! Form::date('newsDate', null, ['class' => 'form-control', 'required' => 'required']) !!}
                </div>

            </div><!-- /.box-body -->
            <div class="box-footer">
                <a href="{{ route('newsboard.index')}}" class="btn btn-default pull-left">Cancel</a>
                <button type="submit" class="btn btn-info pull-right">Add News</button>
            </div><!-- /.box-footer -->
            {!! Form::close(); !!}
        </div><!-- /.box -->
    </div>
</div>
@endsection
