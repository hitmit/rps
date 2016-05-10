<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title ng-binding">{{$user->first_name . ' ' . $user->last_name }}</h4>
</div>
<div class="modal-body" ng-transclude="">
    <div ng-bind-html="modalContent" class="ng-binding ng-scope">
        <div class="text-center">
            @if(!empty($userAttributes->photo))
                <img alt="{{ $user->first_name }}" class="user-image img-circle" style="width:70px; height:70px;" src="{{asset('uploads/profile/' . $userAttributes->photo)}}">
            @endif
        </div>
        <h4>Student Information</h4>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td>First name</td>
                    <td>{{ $user->first_name }}</td>
                </tr>
                <tr>
                    <td>Last name</td>
                    <td>{{ $user->last_name }}</td>
                </tr>
                <tr>
                    <td>Email address</td>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <td>Birthday</td>
                    <td>{{ date('Y-m-d', $userAttributes->birthday) }}</td>
                </tr>
                <tr>
                    <td>Gender</td>
                    <td>{{ $userAttributes->gender }}</td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td>{{ $userAttributes->address }}</td>
                </tr>
                <tr>
                    <td>Phone No</td>
                    <td>{{ $userAttributes->phoneNo }}</td>
                </tr>
                <tr>
                    <td>Mobile No</td>
                    <td>{{ $userAttributes->mobileNo }}</td>
                </tr>
                <tr>
                    <td>Roll No</td>
                    <td>{{ $userAttributes->studentRollId }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
