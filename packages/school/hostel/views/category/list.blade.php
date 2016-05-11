@extends('app')
@section('contentheader_title')
<i class="fa fa-check-square-o"></i> Hostel Category
@endsection

@section('main-content')

<div class="row">
    <div class="col-xs-12">
        @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">List Hostel Category</h3>
                <div class="box-tools">
                    <a href="{{ route('hostelCat.create') }}" class="btn btn-primary btn-flat">Add Hostel Category</a>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                 <table class="table table-hover">
                    <tr>
                        <th>ID</th>
                        <th>Category Title</th>
                        <th>Hostel</th>
                        <th>Fee</th>
                        <th>Operations</th>
                    </tr>
                    @foreach ($hostelCats as $key => $value)
                    <tr>
                        <td>{{ ($key+1)  }}</td>
                        <td>{!! $value->catTitle  !!}</td>
                        <td>{!! $value->catTypeId  !!}</td>
                        <td>{!! $value->catFees  !!}</td>
                        <td>
                            <a href="{{ route('hostelCat.edit', $value->id) }}" class="btn btn-flat btn-primary" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                            <a href="{{ route('hostelCat.confirm', $value->id) }}" class="btn btn-flat btn-danger" title="Delete"><i class="fa fa-trash-o"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </table>
                <div class="text-center">
                    {!! $hostelCats->render() !!}
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
