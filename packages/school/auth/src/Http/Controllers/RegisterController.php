<?php

namespace School\Auth\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use School\Academic\Models\Academic;
use School\Academic\Http\Requests\CreateAcademicYearRequest;
use Session;
use Redirect;
use DB;
use Sentinel;
use School\Auth\Models\StudentAcademicYears;

class RegisterController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('auth::auth.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        if ($request->get('role') == "") {
            return array('error' => 'User Role must be selected');
        }

        if ($request->get('password') == "") {
            return array('error' => 'User Password is required');
        }

        if ($request->get('first_name') == "") {
            return array('error' => 'User First Name required');
        }

        if ($request->get('email') == "") {
            return array('error' => 'User Email is required');
        }

        if (!filter_var($request->get('email'), FILTER_VALIDATE_EMAIL) AND $request->get('email') != "") {
            return array('error' => 'Email is not valid');
        }
        if (DB::table('users')->where('email', $request->get('email'))->count() > 0) {
            return array('error' => 'Email Address already exists');
        }

        $user = array(
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'studentRollId' => $request->get('studentRollId'),
            'gender' => $request->get('gender'),
            'address' => $request->get('address'),
            'phoneNo' => $request->get('phoneNo'),
            'mobileNo' => $request->get('mobileNo'),
            'parentProfession' => $request->get('parentProfession'),
        );

        if ($request->get('birthday') != "") {
            $birthday = explode("/", $request->get('birthday'));
            $birthday = mktime(0, 0, 0, $birthday['0'], $birthday['1'], $birthday['2']);
            $user['birthday'] = $birthday;
        }

        if ($request->get('studentClass') != "") {
            $user['studentAcademicYear'] = 2;
            $user['studentClass'] = $request->get('studentClass');
        }

        if ($request->get('studentInfo') != "") {
            $user['parentOf'] = json_encode($request->get('studentInfo'));
        }

        $sentinelUser = Sentinel::register($user);

        $role = Sentinel::findRoleByName($request->get('role'));

        $role->users()->attach($sentinelUser);

        if ($request->get('role') == "student") {
            $studentAcademicYears = new StudentAcademicYears();
            $studentAcademicYears->studentId = $sentinelUser->id;
            $studentAcademicYears->academicYearId = 2;
            $studentAcademicYears->classId = $request->get('studentClass');
            $studentAcademicYears->save();
        }

        $array = array("id" => $sentinelUser->id);
        return $array;
    }

    /**
     * Register classes to student.
     */
    public function registerClasses() {
        return DB::table('classes')->where('classAcademicYear', 2)->get();
    }

    public function searchStudents($student) {
        $students = DB::table('users')->where('first_name', 'like', '%' . $student . '%')->orWhere('email', 'like', '%' . $student . '%')->get();
        $retArray = array();
        foreach ($students as $student) {
            $retArray[$student->id] = array(
                "id" => $student->id,
                "name" => $student->first_name,
                "email" => $student->email
            );
        }
        return json_encode($retArray);
    }
}
