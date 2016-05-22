<?php

namespace School\GradeLevels\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use School\GradeLevels\Models\GradeLevelsModel;
use School\GradeLevels\Http\Requests\CreateGradeLevelsRequest;
use Redirect;

class GradeLevelsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagination = 10;
        $gradelevels = GradeLevelsModel::paginate($pagination);
        return view('gradelevels::gradelevels.list', compact('gradelevels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gradelevels::gradelevels.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateGradeLevelsRequest $request)
    {
        $data = $request->only('gradeName', 'gradeDescription', 'gradePoints', 'gradeFrom', 'gradeTo');
        GradeLevelsModel::create($data);
        return Redirect::route('gradelevels.index')->withMessage('Grade Levels Created Successfully!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $gradelevel = GradeLevelsModel::where('id', $id)->first();
        if ($gradelevel) {
            return Redirect::route('gradelevels.edit', $gradelevel->id);
        } else {
            return Redirect::route('gradelevels.index')->withMessage('No grade levels Found!!');
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
        $gradelevel = GradeLevelsModel::where('id', $id)->first();
        if ($gradelevel) {
            return view('gradelevels::gradelevels.edit', compact('gradelevel'));
        } else {
            return Redirect::route('gradelevels.index')->withMessage('No grade level Found!!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateGradeLevelsRequest $request, $id)
    {
        $data = $request->only('gradeName', 'gradeDescription', 'gradePoints', 'gradeFrom', 'gradeTo');
        GradeLevelsModel::where('id', $id)->update($data);
        return Redirect::route('gradelevels.index')->withMessage('Gradelevel Updated Successfully.');
    }

    /**
     * Confirm remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirm($id)
    {
        $gradelevel = GradeLevelsModel::where('id', $id)->first();
        if ($gradelevel)
        {
            return view('gradelevels::gradelevels.confirm', compact('gradelevel'));
        }
        else
        {
            return Redirect::route('gradelevels.index')->withMessage('No Grade level Found!!');
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
        GradeLevelsModel::where('id', $id)->delete();
        return Redirect::route('gradelevels.index')->withMessage('Grade Level Deleted successfully');
    }
}
