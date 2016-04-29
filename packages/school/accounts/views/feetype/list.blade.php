@extends('app')
@section('contentheader_title')
    <i class="fa fa-money"></i> Fee Types
@endsection

@section('main-content')

    <div class="row">
        <div class="col-xs-12">
            @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">List fee types</h3>
                    <div class="box-tools">
                        <a href="{{ route('feetype.create') }}" class="btn btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Fee Type</a>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>Fee Type</th>
                            <th>Default amount</th>
                            <th>Operations</th>
                        </tr>
                         @foreach ($feetypes as $key => $value)
                            <tr>
                                <td>{{ $value->feeTitle  }}</td>
                                <td>
                                    {{ $value->feeDefault }}
                                </td>
                                <td>
                                    <a class="btn btn-flat btn-primary" href="{{ route('feetype.edit', $value->id) }}" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                                    <a class="btn btn-flat btn-danger" href="{{ route('feetype.confirm', $value->id) }}" title="Delete"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
@endsection
