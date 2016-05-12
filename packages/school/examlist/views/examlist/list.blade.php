@extends('app')
@section('contentheader_title')
<i class="fa fa-graduation-cap"></i> Exams
@endsection

@section('main-content')

<div class="row">
    <div class="col-xs-12">
        @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Exams List</h3>
                <div class="box-tools">
                    <a href="{{ route('examlist.create') }}" class="btn btn-primary btn-flat">Add Exam</a>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                        <th>ID</th>
                        <th>Exam Name</th>
                        <th>Exam Description</th>
                        <th>Date</th>
                        <th>Operations</th>
                    </tr>
                    @foreach ($examlists as $key => $value)
                    <tr>
                        <td>{{ ($key+1)  }}</td>
                        <td>{!! $value->examTitle  !!}</td>
                        <td>{!! $value->examDescription  !!}</td>
                        <td>{!! $value->examDate  !!}</td>
                        <td>
                            <a href="{{ route('examlist.edit', $value->id) }}" class="btn btn-flat btn-primary" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                            <a href="{{ route('examlist.confirm', $value->id) }}" class="btn btn-flat btn-danger" title="Delete"><i class="fa fa-trash-o"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </table>
                <div class="text-center">
                    {!! $examlists->render() !!}
                </div>
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
