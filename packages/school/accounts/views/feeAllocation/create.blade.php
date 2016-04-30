@extends('app')
@section('contentheader_title')
    <i class="fa fa-money"></i> Create Allocation
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
                <form class="form-horizontal" name="addGrade" role="form" ng-submit="saveAdd()" novalidate>
                    <div class="form-group" ng-class="{'has-error': addGrade.allocationType.$invalid}">
                        <label for="inputEmail3" class="col-sm-2 control-label">{{phrase.allocationType}} * </label>
                        <div class="col-sm-10">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="allocationType" value="class" ng-model="form.allocationType" required>
                                      {{phrase.class}}
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="allocationType" value="student" ng-model="form.allocationType" required>
                                      {{phrase.student}}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" ng-class="{'has-error': addGrade.allocationId.$invalid}" ng-show="form.allocationType == 'class'">
                        <label for="inputEmail3" class="col-sm-2 control-label">{{phrase.class}} * </label>
                        <div class="col-sm-10">
                            <select class="form-control" ng-model="form.allocationId" name="allocationId" ng-required="form.allocationType == 'class'">
                                <option ng-repeat="(key,value) in classes" value="{{key}}">{{value}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" ng-class="{'has-error': addGrade.allocationId.$invalid}" ng-show="form.allocationType == 'student'">
                        <label for="inputEmail3" class="col-sm-2 control-label">{{phrase.student}} * </label>
                        <div class="col-sm-10">
                            <a type="button" ng-click="linkStudent()" class="btn btn-danger btn-flat">{{phrase.searchUsers}}</a>
                            <small>{{phrase.paymentSelectMultiple}}</small>

                            <table class="table table-bordered">
                                <tr ng-repeat="student in form.paymentStudent track by $index">
                                    <td>{{student.name}}</td>
                                    <td>
                                        <a type="button" ng-click="removeStudent(student.id)" class="btn btn-danger btn-flat"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">{{phrase.feeDetails}}</label>
                        <div class="col-sm-10">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>{{phrase.FeeTypes}}</th>
                                        <th>{{phrase.value}}</th>
                                    </tr>
                                    <tr ng-repeat="type in feeTypes">
                                        <td>{{type.feeTitle}}</td>
                                        <td>
                                            <input type="text" name="allocationValues" ng-model="type.feeDefault" class="form-control" required>
                                        </td>
                                    </tr>
                                    <tr ng-show="!feeTypes.length"><td class="noTableData" colspan="6">{{phrase.noFeeTypesAv}}</td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default" ng-disabled="addGrade.$invalid">{{phrase.addFeeAllocation}}</button>
                        </div>
                    </div>
                </form><!-- form close -->
            </div><!-- /.box -->
    	</div>
    </div>
@endsection
