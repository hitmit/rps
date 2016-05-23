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
            {!! Form::open(['route' => 'library.store', 'files' => true]) !!}
                <div class="box-body">
                    <div class="form-group">
                        {!! Form::label('bookName', 'Book Title *') !!}
                        {!! Form::text('bookName', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('bookDescription', 'Book Description') !!}
                        {!! Form::textarea('bookDescription', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('bookAuthor', 'Book Author') !!}
                        {!! Form::text('bookAuthor', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                            {!! Form::label('bookType', 'Book Type *') !!}
                        {!! Form::select('bookType',['traditional' => 'Traditional Book', 'electronic' => 'Electronic Book'], null, ['class' => 'form-control', 'id' => 'bookType']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('bookPrice', 'Book Price') !!}
                        {!! Form::text('bookPrice', null, ['class' => 'form-control', 'id' => 'bookPrice']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('bookFile', 'Upload book') !!}
                        {!! Form::file('bookFile', ['class' => 'form-control', 'id' => 'bookFile']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('bookState', 'State') !!}
                        {!! Form::select('bookState', ['Available', 'Unavailable'], null, ['class' => 'form-control'] ) !!}
                    </div>

                </div><!-- /.box-body -->
                <div class="box-footer">
                    <a href="{{ route('library.index')}}" class="btn btn-default pull-left">Cancel</a>
                    <button type="submit" class="btn btn-info pull-right">Add Book</button>
                </div><!-- /.box-footer -->
            {!! Form::close(); !!}<!-- /form -->
        </div><!-- /.box -->
    </div>
</div>
@endsection
