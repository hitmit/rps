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
                    <h3 class="box-title">Classes</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>S.No</th>
                            <th>Class Name</th>
                            <th>Operations</th>
                        </tr>
                         @foreach ($classes as $key => $value)
                            <tr>
                                <td>{{ ($key + 1)  }}</td>
                                <td>{{ $value->className  }}</td>

                                <td>
                                    <a class="btn btn-flat btn-primary" href="{{ route('class.schedule.create', $value->id) }}" title="Edit"><i class="fa fa-fw fa-th-list"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
@endsection
