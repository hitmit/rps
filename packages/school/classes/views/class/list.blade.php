@extends('app')
@section('contentheader_title')
    <i class="fa fa-sitemap"></i> Classes
@endsection

@section('main-content')

    <div class="row">
        <div class="col-xs-12">
            @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">List Classes</h3>
                    <div class="box-tools">
                        <a href="{{ route('classes.create') }}" class="btn btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Class</a>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>Class Name</th>
                            <th>Class Teacher</th>
                            <th>Associated Subjects</th>
                            <th>Class Dormitory</th>
                            <th>Operations</th>
                        </tr>
                         @foreach ($classes as $key => $value)
                            <tr>
                                <td>{{ $value->className  }}</td>
                                <td>{{ $value->classTeacher  }}</td>
                                <td>{{ $value->classSubjects  }}</td>
                                <td>{{ $value->dormitoryName  }}</td>
                                <td>
                                    <a class="btn btn-flat btn-primary" href="{{ route('classes.edit', $value->id) }}" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                                    <a class="btn btn-flat btn-danger" href="{{ route('classes.confirm', $value->id) }}" title="Delete"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
@endsection
