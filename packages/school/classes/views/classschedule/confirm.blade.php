<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title">Delete Schedule</h4>
</div>
<div class="modal-body">
  {!! Form::open(['class' => 'form-inline',  'method' => 'DELETE', 'route' => ['class.schedule.destroy', $schedule->id]]) !!}
    Do you really want to delete?
        <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cancel</button>
        {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
    {!! Form::close() !!}
</div>
