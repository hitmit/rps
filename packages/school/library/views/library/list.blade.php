@extends('app')
@section('contentheader_title')
<i class="fa fa-folder-open"></i> Library
@endsection

@section('main-content')
<div class="row">
    <div class="col-xs-12">
        @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">List Books</h3>
                <div class="box-tools">
                    <a href="{{ route('library.create') }}" class="btn btn-primary btn-flat">Add Book</a>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                        <th>ID</th>
                        <th>Book Title</th>
                        <th>Book Author</th>
                        <th>Book Price / State</th>
                        <th>Operations</th>
                    </tr>
                    @foreach ($books as $key => $value)
                    <tr>
                        <td>{{ ($key + 1)  }}</td>
                        <td>{{ $value->bookName }}</td>
                        <td>{{ $value->bookAuthor }}</td>
                        <td>{{ $value->bookPrice . ' / ' . $value->bookState }}</td>
                        <td>
                            <a href="{{ route('library.edit', $value->id) }}" class="btn btn-flat btn-primary"><i class="fa fa-pencil-square-o"></i></a>
                            <a href="{{ route('library.confirm', $value->id) }}" class="btn btn-flat btn-danger"><i class="fa fa-trash-o"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </table>
                <div class="text-center">
                    {!! $books->render() !!}
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div>
@endsection
