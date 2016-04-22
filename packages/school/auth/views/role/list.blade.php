@extends('app')
@section('contentheader_title')
    <i class="fa fa-calendar"></i> User Roles
@endsection

@section('main-content')

    <div class="row">
        <div class="col-xs-12">
            @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">List academic years</h3>
                    <div class="box-tools">
                        <a href="{{ route('admin.role.create') }}" class="btn btn-primary">+Add Role</a>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>Role</th>
                            <th>Operations</th>
                        </tr>
                         @foreach ($roles as $key => $value)
                            <tr>
                                <td>{{ $value->name  }}</td>
                                <td>
                                    <a href="{{ route('admin.role.edit', $value->id) }}" title="Edit"><i class="fa fa-pencil-square-o"></i></a>/
                                    <a href="{{ route('admin.role.confirm', $value->id) }}" title="Delete"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
@endsection
