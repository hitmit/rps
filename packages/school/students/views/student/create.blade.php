@extends('app')
@section('contentheader_title')
    <i class="fa fa-users"></i> Create Student
@endsection
@section('main-content')
<div class="row">
    <div class="col-md-12">
        @if (isset($errors) && count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error}}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="box box-info">
            <!-- form start -->
            <form role="form" method="POST" class="form-horizontal" action="{{ route('students.store')}}" enctype="multipart/form-data" encoding="multipart/form-data">
                {!! csrf_field() !!}
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">First name * </label>
                        <div class="col-sm-10">
                            <input type="text" name="first_name" class="form-control" required="required" placeholder="First name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label ">Last name</label>
                        <div class="col-sm-10">
                            <input type="text" name="last_name" class="form-control " placeholder="Last name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Email address *</label>
                        <div class="col-sm-10">
                            <input type="email" name="email" class="form-control" placeholder="Email address" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Password *</label>
                        <div class="col-sm-10">
                            <input type="password" name="password"class="form-control" required="" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Gender</label>
                        <div class="col-sm-10">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="gender" value="male" checked="checked">
                                    Male
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="gender" value="female">
                                    Female
                                </label>
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Birthday</label>
                        <div class="col-sm-10">
                            <input type="text" id="datemask" name="birthday" class="form-control datemask">
                        </div>
                    </div>
                    <div date-picker="" selector=".datemask"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Address</label>
                        <div class="col-sm-10">
                            <input type="text" name="address" class="form-control" placeholder="Address">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Phone No</label>
                        <div class="col-sm-10">
                            <input type="text" name="phoneNo" class="form-control" placeholder="Phone No">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Mobile No</label>
                        <div class="col-sm-10">
                            <input type="text" name="mobileNo" class="form-control" placeholder="Mobile No"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Transportation</label>
                        <div class="col-sm-10">
                            <select name="transport" class="form-control">
                                <option value="">No Transportation</option>
                                @foreach ($transportations as $transportation)
                                <option value="{{ $transportation->id }}">{{ $transportation->transportTitle }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Photo</label>
                        <div class="col-sm-10">
                            <input type="file" name="photo">
                        </div>
                    </div>
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <a href="{{ route('students.index')}}" class="btn btn-default pull-left">Cancel</a>
                    <button type="submit" class="btn btn-info pull-right">Add Student</button>
                </div><!-- /.box-footer -->
            </form>
        </div><!-- /.box -->
    </div>
</div>
@endsection
