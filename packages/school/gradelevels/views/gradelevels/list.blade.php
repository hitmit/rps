@extends('app')
@section('contentheader_title')
<i class="fa fa-check-square-o"></i> Grade levels
@endsection

@section('main-content')
<div class="row">
    <div class="col-xs-12">
        @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">List Grades</h3>
                <div class="box-tools">
                    <a href="{{ route('gradelevels.create') }}" class="btn btn-primary btn-flat">Add Grade Level</a>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                        <th>ID</th>
                        <th>Grade Name</th>
                        <th>Grade Point</th>
                        <th>From -> To</th>
                        <th>Operations</th>
                    </tr>
                    @foreach ($gradelevels as $key => $value)
                    <tr>
                        <td>{{ ($key + 1)  }}</td>
                        <td>{{ $value->gradeName }}</td>
                        <td>{{ $value->gradePoints }}</td>
                        <td>{{ $value->gradeFrom . ' -> ' . $value->gradeTo }}</td>
                        <td>
                            <a href="{{ route('gradelevels.edit', $value->id) }}" class="btn btn-flat btn-primary"><i class="fa fa-pencil-square-o"></i></a>
                            <a href="{{ route('gradelevels.confirm', $value->id) }}" class="btn btn-flat btn-danger"><i class="fa fa-trash-o"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </table>
                <div class="text-center">
                    {!! $gradelevels->render() !!}
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div>
@endsection
