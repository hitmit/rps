@extends('app')
@section('contentheader_title')
<i class="fa fa-sitemap"></i> Sections
@endsection

@section('main-content')

<div class="row">
    <div class="col-xs-12">
        @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">List Sections</h3>
                <div class="box-tools">
                    <a href="{{ route('sections.create') }}" class="btn btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Section</a>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                        <th>Section Name</th>
                        <th>Section Title</th>
                        <th>Class</th>
                        <th>Teacher</th>
                        <th>Operations</th>
                    </tr>
                    @foreach ($sections as $key => $value)
                    <tr>
                        <td>{{ $value['sectionName']  }}</td>
                        <td>{{ $value['sectionTitle']  }}</td>
                        <td>{{ $value['classId']  }}</td>
                        <td>{{ $value['teacherId']  }}</td>
                        <td>
                            <a class="btn btn-flat btn-primary" href="{{ route('sections.edit', $value['id']) }}" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                            <a class="btn btn-flat btn-danger" href="{{ route('sections.confirm', $value['id']) }}" title="Delete"><i class="fa fa-trash-o"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div>
@endsection
