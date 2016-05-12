@extends('app')
@section('contentheader_title')
<i class="fa fa-clock-o"></i> Events
@endsection

@section('main-content')

<div class="row">
    <div class="col-xs-12">
        @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">List Events</h3>
                <div class="box-tools">
                    <a href="{{ route('events.create') }}" class="btn btn-primary btn-flat">Add Event</a>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                        <th>ID</th>
                        <th>Event Title</th>
                        <th>Event Description</th>
                        <th>Event Place</th>
                        <th>For</th>
                        <th>Date</th>
                        <th>Operations</th>
                    </tr>
                    @foreach ($events as $key => $value)
                    <tr>
                        <td>{{ ($key+1)  }}</td>
                        <td>{!! $value->eventTitle  !!}</td>
                        <td>{!! $value->eventDescription  !!}</td>
                        <td>{!! $value->enentPlace  !!}</td>
                        <td>{!! $value->eventFor  !!}</td>
                        <td>{!! $value->eventDate  !!}</td>
                        <td>
                            <a href="{{ route('events.edit', $value->id) }}" class="btn btn-flat btn-primary" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                            <a href="{{ route('events.confirm', $value->id) }}" class="btn btn-flat btn-danger" title="Delete"><i class="fa fa-trash-o"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </table>
                <div class="text-center">
                    {!! $events->render() !!}
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
