<?php

namespace School\Parents\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use School\Parents\Http\Requests\ParentCreateRequest;
use School\Parents\Http\Requests\ParentEditRequest;
use Session;
use Redirect;
use DB;
use Sentinel;
use Activation;
use School\Auth\Models\UserAttributesModel as UserAttributes;

class ParentsController extends Controller {

    /**
     * List Teacher Users.
     */
    public function index() {
        $role = Sentinel::findRoleBySlug('parent');
        $parents = $role->users()->with('roles')->get();
        return View('parent::parent.list', compact('parents'));
    }

    /**
     * Create Teacher form.
     */
    public function create() {
        return View('parent::parent.create', compact('transportations'));
    }

    /**
     * Store Teacher to system.
     */
    public function store(ParentCreateRequest $request) {
        $user = $request->only('first_name', 'last_name', 'email', 'password');
        $sentinelUser = Sentinel::registerAndActivate($user);

        $role = Sentinel::findRoleBySlug('parent');

        $role->users()->attach($sentinelUser);
        //Getting user Attributes from request object
        $user_attributes = new UserAttributes;
        $user_attributes->id = $sentinelUser->id;
        $user_attributes->gender = $request->get('gender');
        $user_attributes->address = $request->get('address');
        $user_attributes->phoneNo = $request->get('phoneNo');
        $user_attributes->mobileNo = $request->get('mobileNo');
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

        return Redirect::route('parents.index')->withMessage('Parent Created Successfully.');
    }

    /**
     * update Teacher.
     */
    public function show($id) {
        $userAttributes = UserAttributes::where('id', $id)->first();
        $user = Sentinel::findById($id);
        $transportations = DB::table('transportation')->get();
        return View('parent::parent.show', ['userAttributes' => $userAttributes, 'user' => $user]);
    }

    /**
     * Edit Teacher form.
     */
    public function edit($id) {
        $userAttributes = UserAttributes::where('id', $id)->first();
        $user = Sentinel::findById($id);
        $transportations = DB::table('transportation')->get();
        return View('parent::parent.edit', ['transportations' => $transportations, 'userAttributes' => $userAttributes, 'user' => $user]);
    }

    /**
     * update Teacher.
     */
    public function update(ParentEditRequest $request, $userId) {
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

        return Redirect::route('parents.index')->withMessage('Parent Updated Successfully.');
    }

    /**
     * Confirm Teacher delete form.
     */
    public function confirm($id) {
        $user = Sentinel::findById($id);
        return View('parent::parent.confirm', ['user' => $user]);
    }

    /**
     * Edit Teacher form.
     */
    public function destroy($id) {
        // Find user based on ID.
        $user = Sentinel::findById($id);
        if($user) {
            // Find user role from slug.
            $role = Sentinel::findRoleBySlug('parent');
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
            return Redirect::route('parents.index')->withMessage('Parent Deleted Successfully.');
        } else {
            return Redirect::route('parents.index')->withMessage('Parent Not Found.');
        }
    }
}
