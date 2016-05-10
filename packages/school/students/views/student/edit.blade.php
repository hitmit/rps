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
            {!! Form::model($user, ['route' => array('students.update', $user->id), 'method' => 'PUT' ]) !!}
                <div class="box-body">
                    <div class="form-group">
                        {!! Form::label('first_name', 'First Name *') !!}
                        {!! Form::text('first_name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('last_name', 'Last Name') !!}
                        {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('email', 'Email Address *') !!}
                        {!! Form::email('email', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('gender', 'Gender') !!}
                        {!! Form::select('gender', ['male' => 'Male', 'female' => 'Female'], null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('birthday', 'Birthday') !!}
                        {!! Form::date('birthday', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('address', 'Address') !!}
                        {!! Form::text('address', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('phoneNo', 'Phone Number') !!}
                        {!! Form::text('phoneNo', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('mobileNo', 'Mobile Number') !!}
                        {!! Form::text('mobileNo', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('studentRollId', 'Roll No') !!}
                        {!! Form::text('studentRollId', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                         {!! Form::label('studentClass', 'Class *') !!}
                        {!! Form::select('studentClass', $classes, null, ['required' => 'required', 'class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                         {!! Form::label('transport', 'Transportation') !!}
                        {!! Form::select('transport', $transportations, null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('photo', 'Photo') !!}
                        {!! Form::file('photo', null, ['class' => 'form-control']) !!}
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
