@extends('app')
@section('contentheader_title')
<i class="fa fa-file-pdf-o"></i> Assignments
@endsection

@section('main-content')
<div class="row">
    <div class="col-xs-12">
        @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">List Assignments</h3>
                <div class="box-tools">
                    <a href="{{ route('assignments.create') }}" class="btn btn-primary btn-flat">Add Assignment</a>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                        <th>ID</th>
                        <th>Assignment Title</th>
                        <th>Assignment Deadline</th>
                        <th>Operations</th>
                    </tr>
                    @foreach ($assignments as $key => $value)
                    <tr>
                        <td>{{ ($key + 1)  }}</td>
                        <td>{{ $value->AssignTitle }}</td>
                        <td>{{ $value->AssignDeadLine }}</td>
                        <td>
                            <a href="{{ route('assignments.edit', $value->id) }}" class="btn btn-flat btn-primary"><i class="fa fa-pencil-square-o"></i></a>
                            <a href="{{ route('assignments.confirm', $value->id) }}" class="btn btn-flat btn-danger"><i class="fa fa-trash-o"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </table>
                <div class="text-center">
                    {!! $assignments->render() !!}
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div>
@endsection
