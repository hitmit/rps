@extends('app')
@section('contentheader_title')
<i class="fa fa-sitemap"></i> Create Section
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
            <form role="form" method="POST" class="form-horizontal" action="{{ route('sections.store') }}">
                {!! csrf_field() !!}
                <div class="box-body">
                    <div class="form-group">
                        <label for="sectionName" class="col-sm-2 control-label">Section Name*</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" required="required" placeholder="Section Name" name="sectionName" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="sectionTitle" class="col-sm-2 control-label">Section Title*</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" required="required" placeholder="Section title" name="sectionTitle" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="classId" class="col-sm-2 control-label">Class*</label>
                        <div class="col-sm-10">
                            <select class="form-control" required="required" name="classId">
                                @foreach($classes as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Teacher*</label>
                        <div class="col-sm-10">
                            <select class="form-control" required="required" name="teacherId[]" multiple="multiple">
                                @foreach($teachers as $k => $val)
                                <option value="{{ $k }}">{{ $val }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div><!-- /.box-body -->
                <div class="box-footer">
                    <a href="{{ route('sections.index') }}" class="btn btn-default pull-left">Cancel</a>
                    <button type="submit" class="btn btn-info pull-right">Add Section</button>
                </div><!-- /.box-footer -->
            </form>
        </div><!-- /.box -->
    </div>
</div>
@endsection
