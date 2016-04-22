@extends('app')
@section('contentheader_title')
    <i class="fa fa-calendar"></i> Academic Years
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
                        <a href="{{ route('admin.academic.create') }}" class="btn btn-primary">+Add Vocabulary</a>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>Year Title</th>
                            <th>Year Status</th>
                            <th>Operations</th>
                        </tr>
                         @foreach ($academics as $key => $value)
                            <tr>
                                <td>{{ $value->yearTitle  }}</td>
                                <td>
                                    {{ ($value->isDefault == 1) ? 'Default year' : 'Inactive' }}
                                </td>
                                <td>
                                    <a href="{{ route('admin.academic.edit', $value->id) }}" title="Edit"><i class="fa fa-pencil-square-o"></i></a>/
                                    <a href="{{ route('admin.academic.confirm', $value->id) }}" title="Delete"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
@endsection
