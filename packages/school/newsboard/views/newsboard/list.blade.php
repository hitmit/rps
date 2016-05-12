@extends('app')
@section('contentheader_title')
<i class="fa fa-bullhorn"></i> News Borad
@endsection

@section('main-content')

<div class="row">
    <div class="col-xs-12">
        @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">List News</h3>
                <div class="box-tools">
                    <a href="{{ route('newsboard.create') }}" class="btn btn-primary btn-flat">Add News</a>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                        <th>ID</th>
                        <th>News Title</th>
                        <th>News content</th>
                        <th>For</th>
                        <th>Operations</th>
                    </tr>
                    @foreach ($news as $key => $value)
                    <tr>
                        <td>{{ ($key+1)  }}</td>
                        <td>{!! $value->newsTitle  !!}</td>
                        <td>{!! $value->newsText  !!}</td>
                        <td>{!! $value->newsFor  !!}</td>
                        <td>
                            <a href="{{ route('newsboard.edit', $value->id) }}" class="btn btn-flat btn-primary" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                            <a href="{{ route('newsboard.confirm', $value->id) }}" class="btn btn-flat btn-danger" title="Delete"><i class="fa fa-trash-o"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </table>
                <div class="text-center">
                    {!! $news->render() !!}
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
