@extends('app')
@section('contentheader_title')
<i class="fa fa-users"></i> Teachers
@endsection

@section('main-content')

<div class="row">
    <div class="col-xs-12">
        @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">List Teachers</h3>
                <div class="box-tools">
                    <a href="{{ route('students.create') }}" class="btn btn-primary btn-flat">Add Student</a>
                    <a href="#" class="btn btn-primary btn-flat">Waiting approval</a>
                    <div class="btn-group">
                        <a href="#" class="btn btn-primary btn-flat">Export</a>
                        <button type="button" class="btn btn-primary btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <span class="caret"></span>
                            <span class="sr-only ng-binding">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="teachers/export">Export to Excel</a></li>
                            <li><a href="teachers/exportpdf" target="_BLANK">Export to PDF</a></li>
                        </ul>
                    </div>
                    <div class="btn-group">
                        <a type="button" class="btn btn-primary btn-flat">Import</a>
                        <button type="button" class="btn btn-primary btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <span class="caret"></span>
                            <span class="sr-only ng-binding">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Import from Excel</a></li>
                        </ul>
                    </div>
                    <a href="#" class="btn btn-primary btn-flat">Print</a>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Email Address</th>
                        <th>Operations</th>
                    </tr>
                    @foreach ($students as $key => $value)
                    <tr>
                        <td>{{ $value->id  }}</td>
                        <td>
                            {{ $value->first_name . ' ' . $value->last_name   }}
                        </td>
                        <td>
                            <a  role="menuitem" tabindex="-1" data-toggle="modal" data-target="#UserModal" href="{{ route('students.show', $value->id) }}">{{ $value->email  }}</a>
                        </td>
                        <td>
                            <a href="{{ route('students.edit', $value->id) }}" title="Edit"><i class="fa fa-pencil-square-o"></i></a>/
                            <a href="{{ route('students.confirm', $value->id) }}" title="Delete"><i class="fa fa-trash-o"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="UserModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content"></div>
    </div>
</div>
@endsection
