<?php

namespace School\StudyMaterial\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use School\StudyMaterial\Models\StudyMaterialModel;
use School\StudyMaterial\Http\Requests\CreateStudyMaterialRequest;
use Redirect;
use Sentinel;
use School\Classes\Models\ClassModel;
use School\Subjects\Models\SubjectsModel;

class StudyMaterialController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagination = 10;
        $studymaterials = StudyMaterialModel::paginate($pagination);
        return view('studymaterial::studymaterial.list', compact('studymaterials'));
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
        return view('studymaterial::studymaterial.create', compact('classes', 'subjects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateStudyMaterialRequest $request)
    {
        $data = $request->only('subject_id', 'material_title', 'material_description');
        $user = Sentinel::getUser();
        $data['teacher_id'] = $user->id;
        $data['class_id'] = json_encode($request->get('class_id'));

        if ($request->hasFile('material_file'))
        {
            $destinationPath = 'uploads/studymaterials'; // upload path
            $fileInstance = $request->file('material_file');
            $extension = $fileInstance->getClientOriginalExtension();

            $newFileName = rand(11111,99999).'.'.$extension; // renaming image
            $fileInstance->move($destinationPath, $newFileName);
            $data['material_file'] = $newFileName;
        }

        StudyMaterialModel::create($data);
        return Redirect::route('studymaterials.index')->withMessage('Study Material Created Successfully!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $studymaterial = StudyMaterialModel::where('id', $id)->first();
        if ($studymaterial)
        {
            return Redirect::route('studymaterials.edit', $studymaterial->id);
        }
        else
        {
            return Redirect::route('studymaterials.index')->withMessage('No Study Material levels Found!!');
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
        $studymaterial = StudyMaterialModel::where('id', $id)->first();
        if ($studymaterial)
        {
            $studymaterial->class_id = json_decode($studymaterial->class_id);
            $classes = ClassModel::lists('className', 'id')->toArray();
            $subjects = SubjectsModel::lists('subjectTitle', 'id')->toArray();
            return view('studymaterial::studymaterial.edit', compact('studymaterial', 'classes', 'subjects'));
        }
        else
        {
            return Redirect::route('studymaterials.index')->withMessage('No Study Material level Found!!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateStudyMaterialRequest $request, $id)
    {
        $data = $request->only('subject_id', 'material_title', 'material_description');
        $user = Sentinel::getUser();
        $data['teacher_id'] = $user->id;
        $data['class_id'] = json_encode($request->get('class_id'));
        if ($request->hasFile('material_file'))
        {
            $destinationPath = 'uploads/studymaterials'; // upload path
            $fileInstance = $request->file('material_file');
            $extension = $fileInstance->getClientOriginalExtension();

            $newFileName = rand(11111,99999).'.'.$extension; // renaming image
            $fileInstance->move($destinationPath, $newFileName);
            $data['material_file'] = $newFileName;
        }
        StudyMaterialModel::where('id', $id)->update($data);
        return Redirect::route('studymaterials.index')->withMessage('Study Material Updated Successfully.');
    }

    /**
     * Confirm remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirm($id)
    {
        $studymaterial = StudyMaterialModel::where('id', $id)->first();
        if ($studymaterial)
        {
            return view('studymaterial::studymaterial.confirm', compact('studymaterial'));
        }
        else
        {
            return Redirect::route('studymaterials.index')->withMessage('No Study Material level Found!!');
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
        StudyMaterialModel::where('id', $id)->delete();
        return Redirect::route('studymaterials.index')->withMessage('Study Material Deleted successfully');
    }
}
