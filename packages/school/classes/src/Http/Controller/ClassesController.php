<?php

namespace School\Classes\Http\Controller;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use School\Classes\Models\ClassModel;
use School\Classes\Http\Requests\CreateClassRequest;
use School\Subjects\Models\SubjectsModel as Subjects;
use School\Dormitory\Models\DormitoryModel as Dormitory;
use Redirect;
use Sentinel;
use DB;

class ClassesController extends Controller
{
    private $class;

    public function __construct(ClassModel $class) {
        $this->class = $class;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = Sentinel::findRoleBySlug('teacher');
        $teachers = $role->users()->with('roles')->lists('first_name', 'id')->toArray();

        $subject = new Subjects();
        $subjects = $subject->lists('subjectTitle', 'id')->toArray();

        $classes = DB::table('classes')
            ->leftJoin('dormitories', 'dormitories.id', '=', 'classes.dormitoryId')
            ->select('classes.id as id',
                'classes.className as className',
                'classes.classTeacher as classTeacher',
                'classes.classSubjects as classSubjects',
                'dormitories.id as dormitory',
                'dormitories.dormitory as dormitoryName')
            ->where('classAcademicYear', 1)
            ->get();
        foreach ($classes as $key => $value) {
            $teacher = json_decode($value->classTeacher);
            $teacherArray = [];
            foreach ($teacher as $val) {
                $teacherArray[] = $teachers[$val];
            }

            $subject = json_decode($value->classSubjects);
            $subjectArray = [];
            foreach ($subject as $val) {
                $subjectArray[] = $subjects[$val];
            }

            $classes[$key]->classTeacher = implode(", ", $teacherArray);
            $classes[$key]->classSubjects = implode(", ", $subjectArray);
        }
        return view('class::class.list', ['classes' => $classes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = Sentinel::findRoleBySlug('teacher');
        $teachers = $role->users()->with('roles')->lists('first_name', 'id')->toArray();
        $subject = new Subjects();
        $subjects = $subject->lists('subjectTitle', 'id')->toArray();
        $dormitory = new Dormitory();
        $dormitories = $dormitory->lists('dormitory', 'id')->toArray();
        return view('class::class.create', ['teachers' => $teachers, 'subjects' => $subjects, 'dormitories' => $dormitories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateClassRequest $request)
    {
        $data = [
            'className' => $request->get('className'),
            'classTeacher' => json_encode($request->get('classTeacher')),
            'classAcademicYear' => 1,
            'classSubjects' => json_encode($request->get('classSubjects')),
            'dormitoryId' => $request->get('dormitoryId'),
        ];
        $this->class->create($data);
        return Redirect::route('classes.index')->withMessage('Class Created Successfully!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $class = $this->class->where('id', $id)->first();
        if($class) {
            return Redirect::route('classes.edit', $id);
        }
        return Redirect::route('classes.index')->withMessage('Class not found!!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $class = $this->class->where('id', $id)->first()->toArray();
        if($class) {
            $class['classTeacher'] = json_decode($class['classTeacher']);
            $class['classSubjects'] = json_decode($class['classSubjects']);

            $role = Sentinel::findRoleBySlug('teacher');
            $teachers = $role->users()->with('roles')->lists('first_name', 'id')->toArray();

            $subject = new Subjects();
            $subjects = $subject->lists('subjectTitle', 'id')->toArray();


            $dormitory = new Dormitory();
            $dormitories = $dormitory->lists('dormitory', 'id')->toArray();

            $dormitories = [];
            foreach ($dormitory->all() as $key => $value) {
                $dormitories[$value->id] = $value->dormitory;
            }
            return view('class::class.edit', ['class' => $class,'teachers' => $teachers, 'subjects' => $subjects, 'dormitories' => $dormitories]);
        }
        return Redirect::route('classes.index')->withMessage('Class not found!!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateClassRequest $request, $id)
    {
        $data = [
            'className' => $request->get('className'),
            'classTeacher' => json_encode($request->get('classTeacher')),
            'classAcademicYear' => 1,
            'classSubjects' => json_encode($request->get('classSubjects')),
            'dormitoryId' => $request->get('dormitoryId'),
        ];
        $this->class->where('id', $id)->update($data);
        return Redirect::route('classes.index')->withMessage('Class Updated Successfully!!');
    }

    /**
     * Confirm Delete the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirm($id)
    {
        $class = $this->class->where('id', $id)->first();
        if($class) {
            return view('class::class.confirm', compact('class') );
        }
        Redirect::route('classes.index')->withMessage('Class not found!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->class->where('id', $id)->delete();
        return Redirect::route('classes.index')->withMessage('Class Deleted successfully!!');
    }
}
