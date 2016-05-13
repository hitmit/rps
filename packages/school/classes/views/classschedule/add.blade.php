<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title">Add Schedule</h4>
</div>
<div class="modal-body">
  {!! Form::open(['class' => 'form-horizontal']) !!}
    <div class="form-group" >
      {!! Form::label('subjectId', 'Subject *', ['class' => 'col-sm-3 control-label']) !!}
      <div class="col-sm-9">
        {!! Form::select('subjectId', $subjects, null, ['class' => 'form-control', 'required' => 'required']) !!}
      </div>
    </div>
    <div class="form-group">
      {!! Form::label('dayOfWeek', 'Day *', ['class' => 'col-sm-3 control-label']) !!}
      <div class="col-sm-9">
        {!! Form::select('dayOfWeek', $days, null, ['class' => 'form-control', 'required' => 'required']) !!}
      </div>
    </div>
    <div class="form-group">
      {!! Form::label('startTime', 'Start Time *', ['class' => 'col-sm-3 control-label']) !!}
      <div class="col-sm-9">
        <div class="row">
          <div class="col-xs-4">
            {!! Form::time('startTime', null, ['class' => 'form-control', 'required' => 'required']) !!}
          </div>
        </div>
      </div>
    </div>
    <div class="form-group">
      {!! Form::label('endTime', 'End Time *', ['class' => 'col-sm-3 control-label']) !!}
      <div class="col-sm-9">
        <div class="row">
          <div class="col-xs-4">
            {!! Form::time('endTime', null, ['class' => 'form-control', 'required' => 'required']) !!}
          </div>
        </div>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-12">
        <button type="submit" class="btn btn-default">Add Schedule</button>
      </div>
    </div>
  {!! Form::close() !!}
</div>
