@extends('app')
@section('contentheader_title')
    <i class="fa fa-users"></i> Edit Student
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
            <form role="form" method="POST" class="form-horizontal" action="{{ route('students.update', $user->id)}}" enctype="multipart/form-data" encoding="multipart/form-data">
                {!! csrf_field() !!}
                <input name="_method" type="hidden" value="PUT">
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">First name * </label>
                        <div class="col-sm-10">
                            <input type="text" name="first_name" class="form-control" required="required" value="{{ $user->first_name }}" placeholder="First name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label ">Last name</label>
                        <div class="col-sm-10">
                            <input type="text" name="last_name" class="form-control" value="{{ $user->last_name }}" placeholder="Last name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Email address *</label>
                        <div class="col-sm-10">
                            <input type="email" name="email" class="form-control" value="{{ $user->email }}" placeholder="Email address" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Gender</label>
                        <div class="col-sm-10">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="gender" value="male" {{ ($userAttributes->gender == 'male') ? 'checked' : '' }} >
                                    Male
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="gender" value="female" {{ ($userAttributes->gender == 'female') ? 'checked' : '' }}>
                                    Female
                                </label>
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Birthday</label>
                        <div class="col-sm-10">
                            <input type="text" id="datemask" name="birthday" value="{{ $userAttributes->bitrhday }}" class="form-control datemask">
                        </div>
                    </div>
                    <div date-picker="" selector=".datemask"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Address</label>
                        <div class="col-sm-10">
                            <input type="text" name="address" value="{{ $userAttributes->address }}" class="form-control" placeholder="Address">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Phone No</label>
                        <div class="col-sm-10">
                            <input type="text" name="phoneNo" value="{{ $userAttributes->phoneNo }}" class="form-control" placeholder="Phone No">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Mobile No</label>
                        <div class="col-sm-10">
                            <input type="text" name="mobileNo" value="{{ $userAttributes->mobileNo }}" class="form-control" placeholder="Mobile No"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Transportation</label>
                        <div class="col-sm-10">
                            <select name="transport" class="form-control">
                                <option value="">No Transportation</option>
                                @foreach ($transportations as $transportation)
                                <option value="{{ $transportation->id }}" {{ ($userAttributes->transport == $transportation->id) ? 'selected' : '' }}>{{ $transportation->transportTitle }}</option>
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
                    <button type="submit" class="btn btn-info pull-right">Edit Student</button>
                </div><!-- /.box-footer -->
            </form>
        </div><!-- /.box -->
    </div>
</div>
@endsection
