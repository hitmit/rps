<?php

namespace School\Subjects\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use School\Subjects\Models\SubjectsModel;
use School\Subjects\Http\Requests\CreateSubjectRequest;
use Sentinel;
use Redirect;
use DB;


class SubjectsController extends Controller
{

    private $subject;

    public function __construct(SubjectsModel $subject)
    {
        //$this->middleware('auth');
        $this->subject = $subject;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = DB::table('subject')
            ->leftJoin('users', 'users.id', '=', 'subject.teacherId')
            ->select('subject.id as id',
                'subject.subjectTitle as subjectTitle',
                'subject.passGrade as passGrade',
                'subject.finalGrade as finalGrade',
                'subject.teacherId as teacherId',
                'users.first_name as first_name',
                'users.last_name as last_name')
            ->get();
        return View('subject::subject.list', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = Sentinel::findRoleBySlug('teacher');
        $teachers = $role->users()->with('roles')->get();
        return view('subject::subject.create', ['teachers' => $teachers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSubjectRequest $request)
    {
        $data = $request->only('subjectTitle', 'teacherId', 'passGrade', 'finalGrade');
        $this->subject->create($data);
        return Redirect::route('subjects.index')->withMessage('Subject Created Successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subject = $this->subject->where('id', $id)->first();
        $role = Sentinel::findRoleBySlug('teacher');
        $teachers = $role->users()->with('roles')->get();
        $options = array();
        foreach ($teachers as $teacher) {
            $options[$teacher->id] = $teacher->first_name . ' ' . $teacher->last_name;
        }
        return View('subject::subject.edit', ['subject' => $subject, 'teachers' => $options]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateSubjectRequest $request, $id)
    {
        $data = $request->only('subjectTitle', 'teacherId', 'passGrade', 'finalGrade');
        $this->subject->where('id', $id)->update($data);
        return Redirect::route('subjects.index')->withMessage('Subject Updated Successfully.');
    }

    /**
     * Confirm Delete the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirm($id)
    {
        $subject = $this->subject->where('id', $id)->first();
        return view('subject::subject.confirm', compact('subject') );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->subject->where('id', $id)->delete();
        return Redirect::route('subjects.index')->withMessage('Subject Deleted successfully');
    }
}
