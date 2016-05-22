<?php

namespace School\Assignments\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use School\Assignments\Models\AssignmentsModel;
use School\Assignments\Http\Requests\CreateAssignmentsRequest;
use School\Classes\Models\ClassModel;
use School\Subjects\Models\SubjectsModel;
use Redirect;
use Sentinel;

class AssignmentsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagination = 10;
        $assignments = AssignmentsModel::paginate($pagination);
        return view('assignments::assignments.list', compact('assignments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = ClassModel::lists('className', 'id')->toArray();
        $subjects = SubjectsModel::lists('subjectTitle', 'id')->toArray();
        return view('assignments::assignments.create', compact('classes', 'subjects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAssignmentsRequest $request)
    {
        $data = $request->only('AssignTitle', 'AssignDescription', 'AssignDescription', 'subjectId', 'AssignDeadLine');
        $user = Sentinel::getUser();
        $data['teacherId'] = $user->id;
        $data['classId'] = json_encode($request->get('classId'));

        if ($request->hasFile('AssignFile'))
        {
            $destinationPath = 'uploads/assignments'; // upload path
            $fileInstance = $request->file('AssignFile');
            $extension = $fileInstance->getClientOriginalExtension();

            $newFileName = rand(11111,99999).'.'.$extension; // renaming image
            $fileInstance->move($destinationPath, $newFileName);
            $data['AssignFile'] = $newFileName;
        }

        AssignmentsModel::create($data);
        return Redirect::route('assignments.index')->withMessage('Assignments Created Successfully!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $assignment = AssignmentsModel::where('id', $id)->first();
        if ($assignment)
        {
            return Redirect::route('assignments.edit', $assignment->id);
        }
        else
        {
            return Redirect::route('assignments.index')->withMessage('No Assignments Found!!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $assignment = AssignmentsModel::where('id', $id)->first();
        if ($assignment)
        {
            $assignment->classId = json_decode($assignment->classId);
            $classes = ClassModel::lists('className', 'id')->toArray();
            $subjects = SubjectsModel::lists('subjectTitle', 'id')->toArray();
            return view('assignments::assignments.edit', compact('assignment', 'classes', 'subjects'));
        }
        else
        {
            return Redirect::route('assignments.index')->withMessage('No Assignment Found!!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateAssignmentsRequest $request, $id)
    {
        $data = $request->only('AssignTitle', 'AssignDescription', 'AssignDescription', 'subjectId', 'AssignDeadLine');
        $user = Sentinel::getUser();
        $data['teacherId'] = $user->id;
        $data['classId'] = json_encode($request->get('classId'));
        if ($request->hasFile('AssignFile'))
        {
            $destinationPath = 'uploads/assignments'; // upload path
            $fileInstance = $request->file('AssignFile');
            $extension = $fileInstance->getClientOriginalExtension();

            $newFileName = rand(11111,99999).'.'.$extension; // renaming image
            $fileInstance->move($destinationPath, $newFileName);
            $data['AssignFile'] = $newFileName;
        }
        AssignmentsModel::where('id', $id)->update($data);
        return Redirect::route('assignments.index')->withMessage('Assignment Updated Successfully!!');
    }

    /**
     * Confirm remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirm($id)
    {
        $assignment = AssignmentsModel::where('id', $id)->first();
        if ($assignment)
        {
            return view('assignments::assignments.confirm', compact('assignment'));
        }
        else
        {
            return Redirect::route('assignments.index')->withMessage('No Assignment Found!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AssignmentsModel::where('id', $id)->delete();
        return Redirect::route('assignments.index')->withMessage('Assignment Deleted successfully');
    }
}
