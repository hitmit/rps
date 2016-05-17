<?php

namespace School\Students\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use School\Students\Http\Requests\StudentCreateRequest;
use School\Students\Http\Requests\StudentEditRequest;
use School\Transports\Http\Models\TransportsModel;
use School\Hostel\Models\HostelModel;
use School\Classes\Models\ClassModel;
use School\Auth\Models\UserAttributesModel as UserAttributes;
use School\Auth\Models\StudentAcademicYears;
use Session;
use Redirect;
use DB;
use Sentinel;
use Activation;

class StudentsController extends Controller {

    /**
     * List student Users.
     */
    public function index() {
        $role = Sentinel::findRoleBySlug('student');
        $students = $role->users()->with('roles')->get();
        return View('student::student.list', compact('students'));
    }

    /**
     * Create student form.
     */
    public function create() {
        $transportations = TransportsModel::lists('transportTitle', 'id')->toArray();
        $classes = ClassModel::lists('className', 'id')->toArray();
        $hostels = HostelModel::lists('hostelTitle', 'id')->toArray();
        return View('student::student.create', compact('transportations', 'classes', 'hostels'));
    }

    /**
     * Store student to system.
     */
    public function store(StudentCreateRequest $request) {
        $user = $request->only('first_name', 'last_name', 'email', 'password');
        $sentinelUser = Sentinel::registerAndActivate($user);

        $role = Sentinel::findRoleBySlug('student');

        $role->users()->attach($sentinelUser);
        //Getting user Attributes from request object
        $user_attributes = new UserAttributes;
        $user_attributes->id = $sentinelUser->id;
        $user_attributes->gender = $request->get('gender');
        $user_attributes->address = $request->get('address');
        $user_attributes->phoneNo = $request->get('phoneNo');
        $user_attributes->mobileNo = $request->get('mobileNo');
        $user_attributes->transport = $request->get('transport');
        $user_attributes->studentClass = $request->get('studentClass');
        $user_attributes->studentRollId = $request->get('studentRollId');
        $user_attributes->hostel = $request->get('hostel');
        if ($request->get('birthday') != "") {
            $birthday = strtotime($request->get('birthday'));
            $user_attributes->birthday = $birthday;
        }
        if ($request->hasFile('photo')) {
            $fileInstance = $request->file('photo');
            $extension = $fileInstance->getClientOriginalExtension();

            $newFileName = "profile_" . $sentinelUser->id . "." . $extension;
            $file = $fileInstance->move('uploads/profile/', $newFileName);

            $user_attributes->photo = $newFileName;
        }

        $user_attributes->save();

        $studentAcademicYears = new StudentAcademicYears();
        $studentAcademicYears->studentId = $sentinelUser->id;
        $studentAcademicYears->academicYearId = 1;
        $studentAcademicYears->classId = $request->get('studentClass');
        $studentAcademicYears->save();

        return Redirect::route('students.index')->withMessage('Student Created Successfully.');
    }

    /**
     * update student.
     */
    public function show($id) {
        $userAttributes = UserAttributes::where('id', $id)->first();
        $user = Sentinel::findById($id);
        return View('student::student.show', ['userAttributes' => $userAttributes, 'user' => $user]);
    }

    /**
     * Edit student form.
     */
    public function edit($id) {
        $userAttributes = UserAttributes::where('id', $id)->first()->toArray();
        $account = Sentinel::findById($id)->toArray();
        $data = $account + $userAttributes;
        $user = (object)$data;
        $transportations = TransportsModel::lists('transportTitle', 'id')->toArray();
        $classes = ClassModel::lists('className', 'id')->toArray();
        $hostels = HostelModel::lists('hostelTitle', 'id')->toArray();
        return View('student::student.edit', compact('classes', 'transportations', 'user', 'hostels'));
    }

    /**
     * update student.
     */
    public function update(StudentEditRequest $request, $userId) {
        $user = Sentinel::findById($userId);

        $credentials = $request->only('first_name', 'last_name', 'email');
        $user = Sentinel::update($user, $credentials);

        $user_attributes = UserAttributes::firstOrNew(['id' => $userId]);
        $user_attributes->gender = $request->get('gender');
        $user_attributes->address = $request->get('address');
        $user_attributes->phoneNo = $request->get('phoneNo');
        $user_attributes->mobileNo = $request->get('mobileNo');
        $user_attributes->transport = $request->get('transport');
        $user_attributes->studentClass = $request->get('studentClass');
        $user_attributes->studentRollId = $request->get('studentRollId');
        $user_attributes->hostel = $request->get('hostel');

        if ($request->get('birthday') != "") {
            $birthday = strtotime($request->get('birthday'));
            $user_attributes->birthday = $birthday;
        }
        if ($request->hasFile('photo')) {
            $fileInstance = $request->file('photo');
            $extension = $fileInstance->getClientOriginalExtension();

            $newFileName = "profile_" . $sentinelUser->id . "." . $extension;
            $file = $fileInstance->move('uploads/profile/', $newFileName);

            $user_attributes->photo = $newFileName;
        }

        $user_attributes->save();

        return Redirect::route('students.index')->withMessage('Student Updated Successfully.');
    }

    /**
     * Confirm student delete form.
     */
    public function confirm($id) {
        $user = Sentinel::findById($id);
        return View('student::student.confirm', ['user' => $user]);
    }

    /**
     * Edit student form.
     */
    public function destroy($id) {
        // Find user based on ID.
        $user = Sentinel::findById($id);
        // Find user role from slug.
        $role = Sentinel::findRoleBySlug('student');
        // Remove user roles.
        $role->users()->detach($user);
        // Delete User.
        $user->delete();
        // Find User attributes.
        $user_attributes = UserAttributes::find($id);
        // Delete User attributes.
        $user_attributes->delete();
        return Redirect::route('students.index')->withMessage('Student Deleted Successfully.');
    }

    public function search()
    {
        return view('student::student.search');
    }
}
