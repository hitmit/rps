@extends('app')
@section('contentheader_title')
    <i class="fa fa-sitemap"></i> Class Schedule
@endsection

@section('main-content')
    <div class="row">
        <div class="col-xs-12">
            @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Class Schedule</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th >Day</th>
                                <th >Class Schedule</th>
                                <th >Add</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $key => $value)
                                <tr>
                                <td>{!! $value['day'] !!}</td>
                                <td>
                                    @if (isset($value['schedule']))
                                        @foreach ($value['schedule'] as $k => $val)
                                            <div class="btn-group" >
                                                <button type="button" class="btn btn-default">Maths - {!! $val['startTime'] !!} -&gt; {!! $val['endTime'] !!}</button>
                                                <button  type="button" class="btn btn-default dropdown-toggle " data-toggle="dropdown" aria-expanded="false">
                                                    <span class="caret"></span>
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <ul class="dropdown-menu ng-scope" role="menu">
                                                    <li><a role="menuitem" tabindex="-1" data-toggle="modal" data-target="#ScheduleModal" href="{{ route('class.schedule.edit', $val['id']) }}">Edit</a></li>
                                                    <li><a role="menuitem" tabindex="-1" data-toggle="modal" data-target="#ScheduleModal" href="{{ route('class.schedule.confirm', $val['id']) }}">Remove</a></li></li>
                                                </ul>
                                            </div>
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                  <a class="btn btn-info btn-flat" role="menuitem" tabindex="-1" data-toggle="modal" data-target="#ScheduleModal" href="{{ route('class.schedule.add', $class_id) }}"><i class="fa fa-fw fa-plus"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="ScheduleModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content"></div>
        </div>
    </div>
@endsection
