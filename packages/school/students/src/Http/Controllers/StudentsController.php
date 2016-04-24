<?php

namespace School\Students\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use School\Students\Http\Requests\StudentCreateRequest;
use School\Students\Http\Requests\StudentEditRequest;
use Session;
use Redirect;
use DB;
use Sentinel;
use Activation;
use School\Auth\Models\UserAttributesModel as UserAttributes;

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
        $transportations = DB::table('transportation')->get();
        return View('student::student.create', compact('transportations'));
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
        if ($request->get('birthday') != "") {
            $birthday = strtotime(date('Y-m-d', $request->get('birthday')));
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
        $userAttributes = UserAttributes::where('id', $id)->first();
        $user = Sentinel::findById($id);
        $transportations = DB::table('transportation')->get();
        return View('student::student.edit', ['transportations' => $transportations, 'userAttributes' => $userAttributes, 'user' => $user]);
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

        if ($request->get('birthday') != "") {
            $birthday = strtotime(date('Y-m-d', $request->get('birthday')));
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
}
