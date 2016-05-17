@extends('app')
@section('contentheader_title')
    <i class="fa fa-user"></i> Edit Parent
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
            {!! Form::model($user, ['route' => array('parents.update', $user->id), 'method' => 'PUT' ]) !!}
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
                        {!! Form::email('email', null, ['class' => 'form-control', 'required' => 'required']) !!}
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
                        {!! Form::label('parentProfession', 'Profession') !!}
                        {!! Form::text('parentProfession', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('photo', 'Photo') !!}
                        {!! Form::file('photo', ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        <a  role="menuitem" tabindex="-1" class="btn btn-success" data-toggle="modal" data-target="#UserModal" href="{{ route('students.search') }}">Link Student</a>
                    </div>

                    <div class="form-group">
                        {!! Form::hidden('parentOf', null, ['id' => 'studentInfo']) !!}
                        <div class="studentInfo" style="padding-top:5px;">

                        </div>
                    </div>
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <a href="{{ route('students.index')}}" class="btn btn-default pull-left">Cancel</a>
                    <button type="submit" class="btn btn-info pull-right">Edit Parent</button>
                </div><!-- /.box-footer -->
            {!! Form::close() !!}
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
@section('script')
<script type="text/javascript" src="{{ asset('/js/Angular/parent.js')}}"></script>
@endsection
