@extends('app')
@section('contentheader_title')
    <i class="fa fa-building"></i> Dormitories
@endsection

@section('main-content')

    <div class="row">
        <div class="col-xs-12">
            @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">List Dormitories</h3>
                    <div class="box-tools">
                        <a href="{{ route('dormitory.create') }}" class="btn btn-primary">+Add Dormitory</a>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>Dormitory Name</th>
                            <th>Dormitory Description</th>
                            <th>Operations</th>
                        </tr>
                         @foreach ($dormitories as $key => $value)
                            <tr>
                                <td>{{ $value->dormitory  }}</td>
                                <td>{{ $value->dormDesc }}</td>
                                <td>
                                    <a class="btn btn-flat btn-primary" href="{{ route('dormitory.edit', $value->id) }}" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                                    <a class="btn btn-flat btn-danger" href="{{ route('dormitory.confirm', $value->id) }}" title="Delete"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
@endsection
