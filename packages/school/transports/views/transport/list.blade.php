@extends('app')
@section('contentheader_title')
<i class="fa fa-bus"></i> Transports
@endsection

@section('main-content')

<div class="row">
    <div class="col-xs-12">
        @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">List Transports</h3>
                <div class="box-tools">
                    <a href="{{ route('transports.create') }}" class="btn btn-primary">+Add Transport</a>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                        <th>Title</th>
                        <th>Contact</th>
                        <th>Fare</th>
                        <th>Operations</th>
                    </tr>
                    @foreach ($transports as $key => $value)
                    <tr>
                        <td>{{ $value->transportTitle  }}</td>
                        <td>{{ $value->transportDriverContact }}</td>
                        <td>{{ $value->transportFare }}</td>
                        <td>
                            <a class="btn btn-info btn-flat" href="{{ route('transports.list.fetchSubs', $value->id) }}"><i class="fa fa-th-list"></i></a>
                            <a class="btn btn-flat btn-info" href="{{ route('transports.edit', $value->id) }}" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                            <a class="btn btn-flat btn-danger"href="{{ route('transports.confirm', $value->id) }}" title="Delete"><i class="fa fa-trash-o"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div>
@endsection
