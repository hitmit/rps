@extends('app')
@section('contentheader_title')
    <i class="fa fa-building"></i> Subjects
@endsection

@section('main-content')

    <div class="row">
        <div class="col-xs-12">
            @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">List Subjects</h3>
                    <div class="box-tools">
                        <a href="{{ route('subjects.create') }}" class="btn btn-primary">+Add Subject</a>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>Subject Name</th>
                            <th>Teacher</th>
                            <th>Pass grade/Final grade</th>
                            <th>Operations</th>
                        </tr>
                         @foreach ($subjects as $key => $value)
                            <tr>
                                <td>{{ $value->subjectTitle  }}</td>
                                <td>{{ $value->first_name . ' ' . $value->last_name }}</td>
                                <td>{{ $value->passGrade . '/' . $value->finalGrade }}</td>
                                <td>
                                    <a class="btn btn-flat btn-primary" href="{{ route('subjects.edit', $value->id) }}" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                                    <a class="btn btn-flat btn-danger" href="{{ route('subjects.confirm', $value->id) }}" title="Delete"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
@endsection
