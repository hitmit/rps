@extends('auth.auth')

@section('htmlheader_title')
Register
@endsection

@section('content')

<body class="register-page"  ng-app="schoex">
    <div ng-controller="registeration">


        <div class="register-box">
            <div class="register-logo">
                <a href="{{ url('/home')}}"><b>Admin</b>LTE</a>
            </div>
            
            <div ng-show="(submitted && error)" >
                <div class="alert alert-danger" ng-hide="regId">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <{ errorMessage }>
                </div>
            </div>

            <div class="register-box-body">
                <p class="login-box-msg">Register a new membership</p>

                <form ng-submit="tryRegister()" method="post" role="form" name="registerationForm" novalidate>
                    <input type="hidden" name="_token" value="{{ csrf_token()}}">
                    <section class="content" ng-show="views.register">

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4"><label><input type="radio" style="margin-right:0px !important" name="role" value="teacher" ng-model="form.role" /> Teacher </label></div>
                                <div class="col-md-4"><label><input type="radio" style="margin-right:0px !important" name="role" value="student" ng-model="form.role"/> Student </label></div>
                                <div class="col-md-4"><label><input type="radio" style="margin-right:0px !important" name="role" value="parent" ng-model="form.role"/> Parent </label></div>
                            </div>
                        </div>

                        <div class="form-group" ng-class="{'has-error': registerationForm.email.$invalid}">
                            <input type="text" name="email" class="form-control" placeholder="Email" ng-model="form.email" ng-pattern="/^[_a-z0-9]+(\.[_a-z0-9]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/"/>
                        </div>
                        <div class="form-group" ng-class="{'has-error': registerationForm.password.$invalid}">
                            <input type="password" name="password" class="form-control" required placeholder="Password" ng-model="form.password" required/>
                        </div>
                        <div class="form-group" ng-class="{'has-error': registerationForm.first_name.$invalid}">
                            <input type="text" name="first_name" class="form-control" required placeholder="First Name" ng-model="form.first_name"/>
                        </div>
                        <div class="form-group">
                            <input type="text" name="last_name" class="form-control" placeholder="Last Name" ng-model="form.last_name"/>
                        </div>

                        <div class="form-group" ng-show="form.role == 'parent'">
                            <input type="text" name="parentProfession" class="form-control" placeholder="Profession" ng-model="form.parentProfession"/>
                        </div>

                        <div class="form-group" ng-show="form.role == 'student'">
                            <input type="text" name="studentRollId" class="form-control" placeholder="Roll No" ng-model="form.studentRollId"/>
                        </div>
                        <div class="form-group" ng-show="form.role == 'student'">
                            <select class="form-control" name="studentClass" ng-model="form.studentClass" >
                                <option ng-repeat="class in classes" value="<{class.id}>"><{class.className}></option>
                            </select>
                        </div>

                        <div class="form-group">
                            <input type="text" name="birthday" class="form-control datemask" placeholder="Birthday" ng-model="form.birthday"/>
                        </div>
                        <div date-picker selector=".datemask" ></div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4"><input type="radio" name="gender" value="male" ng-model="form.gender"/> Male</div>
                                <div class="col-md-4"><input type="radio" name="gender" value="female" ng-model="form.gender"/> Female</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" name="address" class="form-control" placeholder="Address" ng-model="form.address"/>
                        </div>
                        <div class="form-group">
                            <input type="text" name="phoneNo" class="form-control" placeholder="Phone No" ng-model="form.phoneNo"/>
                        </div>
                        <div class="form-group" ng-class="{'has-error': registerationForm.mobileNo.$invalid}">
                            <input type="text" mobile-number name="mobileNo" class="form-control" placeholder="Mobile No" ng-model="form.mobileNo"/>
                        </div>
                        <div class="form-group" ng-show="form.role == 'parent'">

                            <div class="row">
                                <label for="inputPassword3" class="col-sm-6">Student Details</label>
                                <div class="col-sm-6">
                                    <a type="button" ng-click="linkStudent()" class="btn btn-danger btn-flat">Link Student</a>
                                </div>
                            </div>
                            <div class="row" ng-repeat="studentOne in form.studentInfo track by $index" style="padding-top:5px;">
                                <div class="col-xs-4"><input type="text" class="form-control" disabled="disabled" ng-model="studentOne.student"></div>
                                <div class="col-xs-4"><input type="text" class="form-control" ng-model="studentOne.relation" placeholder="<{phrase.Relation}>"></div>
                                <a type="button" ng-click="removeStudent(studentOne.id)" class="btn btn-danger btn-flat"><i class="fa fa-trash-o"></i></a></li>
                            </div>

                        </div>

                        <button type="submit" ng-disabled="registerationForm.$invalid" class="btn bg-olive btn-block">Register New Account</button><br/>

                    </section>
                    <section class="content" ng-show="views.thanks">
                        Thank you for register, please contact school for activating your account with id : <span ng-bind="regId"></span><br/>
                    </section>
                </form>

            </div>

        </div><!-- /.register-box -->

        <modal visible="showModalLink" style="color:#000;">
            <div class="row">
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="searchLink" placeholder="Type student name / username / E-mail address">
                </div>
                <div class="col-sm-2">
                    <a type="button" ng-click="linkStudentButton()" class="btn btn-danger btn-flat">Search</a>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12" style="padding-top:10px;">
                    <div class="box-body table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr ng-repeat="studentOne in searchResults">
                                    <td><{studentOne.name}></td>
                                    <td><{studentOne.email}></td>
                                    <td class="no-print">
                                        <a type="button" ng-click="linkStudentFinish(studentOne)" class="btn btn-success btn-flat">Link</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </modal>



        @include('auth.scripts')

        <link rel="stylesheet" type="text/css" href="{{ asset('/plugins/datepicker/datepicker3.css')}}" />
        <script src="{{ asset('/plugins/datepicker/bootstrap-datepicker.js')}}"></script>

        <script type="text/javascript" src="{{ asset('/js/Angular/angular.min.js')}}"></script>
        <script type="text/javascript" src="{{ asset('/js/Angular/AngularModules.js')}}"></script>
        <script type="text/javascript" src="{{ asset('/js/Angular/register.js')}}"></script>

        <script>
                    $(function () {
                    $('.datemask').datepicker();
                    });


        </script>
    </div>
</body>

@endsection
