@extends('app')
@section('contentheader_title')
<i class="fa fa-bus"></i> Transports
@endsection

@section('main-content')

<div class="row">
    <div class="col-xs-12">
        @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">List Transports</h3>
                <div class="box-tools">
                    <a href="{{ route('transports.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                    </tr>
                    @foreach ($users as $key => $value)
                    <tr>
                        <td>{{ $value->first_name . ' ' . $value->last_name  }}</td>
                        <td>{{ $value->email }}</td>
                        <td>{!! $value->mobileNo . '<br/>' . $value->phoneNo !!}</td>
                    </tr>
                    @endforeach
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div>
@endsection
