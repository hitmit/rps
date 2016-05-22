@extends('app')
@section('contentheader_title')
<i class="fa fa-book"></i> Study Materials
@endsection

@section('main-content')
<div class="row">
    <div class="col-xs-12">
        @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">List Study Materials</h3>
                <div class="box-tools">
                    <a href="{{ route('studymaterials.create') }}" class="btn btn-primary btn-flat">Add Study Material</a>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                        <th>ID</th>
                        <th>Material Title</th>
                        <th>Material Description</th>
                        <th>Operations</th>
                    </tr>
                    @foreach ($studymaterials as $key => $value)
                    <tr>
                        <td>{{ ($key + 1)  }}</td>
                        <td>{{ $value->material_title }}</td>
                        <td>{{ $value->material_description }}</td>
                        <td>
                            <a href="{{ route('studymaterials.edit', $value->id) }}" class="btn btn-flat btn-primary"><i class="fa fa-pencil-square-o"></i></a>
                            <a href="{{ route('studymaterials.confirm', $value->id) }}" class="btn btn-flat btn-danger"><i class="fa fa-trash-o"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </table>
                <div class="text-center">
                    {!! $studymaterials->render() !!}
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div>
@endsection
