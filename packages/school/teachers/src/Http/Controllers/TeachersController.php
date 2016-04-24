<?php

namespace School\Teachers\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use School\Teachers\Http\Requests\TeacherCreateRequest;
use School\Teachers\Http\Requests\TeacherEditRequest;
use Session;
use Redirect;
use DB;
use Sentinel;
use Activation;
use School\Auth\Models\UserAttributesModel as UserAttributes;

class TeachersController extends Controller {

    /**
     * List Teacher Users.
     */
    public function index() {
        $role = Sentinel::findRoleBySlug('teacher');
        $teachers = $role->users()->with('roles')->get();
        return View('teacher::teacher.list', compact('teachers'));
    }

    /**
     * Create Teacher form.
     */
    public function create() {
        $transportations = DB::table('transportation')->get();
        return View('teacher::teacher.create', compact('transportations'));
    }

    /**
     * Store Teacher to system.
     */
    public function store(TeacherCreateRequest $request) {
        $user = $request->only('first_name', 'last_name', 'email', 'password');
        $sentinelUser = Sentinel::registerAndActivate($user);

        $role = Sentinel::findRoleBySlug('teacher');

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

        return Redirect::route('teachers.index')->withMessage('Teacher Created Successfully.');
    }

    /**
     * update Teacher.
     */
    public function show($id) {
        $userAttributes = UserAttributes::where('id', $id)->first();
        $user = Sentinel::findById($id);
        $transportations = DB::table('transportation')->get();
        return View('teacher::teacher.show', ['userAttributes' => $userAttributes, 'user' => $user]);
    }

    /**
     * Edit Teacher form.
     */
    public function edit($id) {
        $userAttributes = UserAttributes::where('id', $id)->first();
        $user = Sentinel::findById($id);
        $transportations = DB::table('transportation')->get();
        return View('teacher::teacher.edit', ['transportations' => $transportations, 'userAttributes' => $userAttributes, 'user' => $user]);
    }

    /**
     * update Teacher.
     */
    public function update(TeacherEditRequest $request, $userId) {
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

        return Redirect::route('teachers.index')->withMessage('Teacher Updated Successfully.');
    }
    
    /**
     * Confirm Teacher delete form.
     */
    public function confirm($id) {
        $user = Sentinel::findById($id);
        return View('teacher::teacher.confirm', ['user' => $user]);
    }
    
    /**
     * Edit Teacher form.
     */
    public function destroy($id) {
        // Find user based on ID.
        $user = Sentinel::findById($id);
        if($user) {
            // Find user role from slug.
            $role = Sentinel::findRoleBySlug('teacher');
            // Remove user roles.
            $role->users()->detach($user);
            // Delete User.
            $user->delete();
            // Find User attributes.
            $user_attributes = UserAttributes::find($id);
            if ($user_attributes) {
                // Delete User attributes.
                $user_attributes->delete();
            }
            return Redirect::route('teachers.index')->withMessage('Teacher Deleted Successfully.');
        } else {
            return Redirect::route('teachers.index')->withMessage('Teacher Not Found.');
        }
    }
}
