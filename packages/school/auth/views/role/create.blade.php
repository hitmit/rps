@extends('app')
@section('contentheader_title')
    Create Role
@endsection
@section('main-content')
  <div class="row">
    <div class="col-md-12">
      @if (isset($errors) && count($errors) > 0)
        <div class="alert alert-danger">
          <strong>Whoops!</strong> There were some problems with your input.<br><br>
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      <div class="box box-info">
              <!-- form start -->
              <form role="form" method="POST" class="form-horizontal" action="{{ route('admin.role.store') }}">
                {!! csrf_field() !!}
                  <div class="box-body">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Role</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" required="required" placeholder="Role" name="name" />
                        </div>
                    </div>
                  </div><!-- /.box-body -->
                	<div class="box-footer">
                    <a href="{{ route('admin.role.index') }}" class="btn btn-default pull-left">Cancel</a>
                    <button type="submit" class="btn btn-info pull-right">Create</button>
                	</div><!-- /.box-footer -->
              </form>
          </div><!-- /.box -->
    </div>
  </div>
@endsection
