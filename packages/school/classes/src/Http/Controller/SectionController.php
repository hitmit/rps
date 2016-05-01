<?php

namespace School\Classes\Http\Controller;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use School\Classes\Models\ClassModel;
use School\Classes\Models\SectionModel;
use School\Classes\Http\Requests\CreateSectionRequest;
use Redirect;
use Sentinel;


class SectionController extends Controller{

    private $section;

    public function __construct(SectionModel $section) {
        $this->section = $section;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = $this->section->all()->toArray();
        $class = new ClassModel();
        $classes = $class->lists('className', 'id')->toArray();
        $role = Sentinel::findRoleBySlug('teacher');
        $teachers = $role->users()->with('roles')->lists('first_name', 'id')->toArray();
        foreach ($sections as $key => $value) {
            $teacher = json_decode($value['teacherId']);
            $teachersArray = [];
            foreach ($teacher as $val) {
                $teachersArray[] = $teachers[$val];
            }
            $sections[$key]['classId'] = $classes[$value['classId']];
            $sections[$key]['teacherId'] = implode(", ", $teachersArray);
        }
        
        return view('class::section.list', ['sections' => $sections]);
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
        $class = new ClassModel();
        $classes = $class->lists('className', 'id')->toArray();
        return view('class::section.create', ['teachers' => $teachers, 'classes' => $classes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSectionRequest $request)
    {
        $data = [
            'sectionName' => $request->get('sectionName'),
            'sectionTitle' => $request->get('sectionTitle'),
            'classId' => $request->get('classId'),
            'teacherId' => json_encode($request->get('teacherId')),
        ];
        $this->section->create($data);
        return Redirect::route('sections.index')->withMessage('Section Created Successfully!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $section = $this->section->where('id', $id)->first();
        if($section) {
            return Redirect::route('sections.edit', $id);
        }
        return Redirect::route('sections.index')->withMessage('Section not found!!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $section = $this->section->where('id', $id)->first()->toArray();
        if($section) {
            $section['teacherId'] = json_decode($section['teacherId']);
            $role = Sentinel::findRoleBySlug('teacher');
            $teachers = $role->users()->with('roles')->lists('first_name', 'id')->toArray();
            $class = new ClassModel();
            $classes = $class->lists('className', 'id')->toArray();
            return view('class::section.edit', ['section' => $section, 'classes' => $classes, 'teachers' => $teachers]);
        }
        return Redirect::route('sections.index')->withMessage('Section not found!!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateSectionRequest $request, $id)
    {
        $data = [
            'sectionName' => $request->get('sectionName'),
            'sectionTitle' => $request->get('sectionTitle'),
            'classId' => $request->get('classId'),
            'teacherId' => json_encode($request->get('teacherId')),
        ];
        $this->section->where('id', $id)->update($data);
        return Redirect::route('sections.index')->withMessage('Section Updated Successfully!!');
    }

    /**
     * Confirm Delete the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirm($id)
    {
        $section = $this->section->where('id', $id)->first();
        if($section) {
            return view('class::section.confirm', compact('section') );
        }
        Redirect::route('sections.index')->withMessage('Section not found!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->section->where('id', $id)->delete();
        return Redirect::route('sections.index')->withMessage('Section Deleted successfully!!');
    }
} 