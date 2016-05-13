<?php

namespace School\Classes\Http\Controller;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use School\Classes\Models\ClassModel;
use School\Classes\Models\ClassScheduleModel;
use School\Subjects\Models\SubjectsModel as Subjects;
use Redirect;

class ClassScheduleController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = ClassModel::where('dormitoryId', 1)->get();
        return view('class::classschedule.list', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $schedule = ClassScheduleModel::where('classId', $id)->get()->toArray();
        $days = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thrusday', 'Friday', 'Saturday');
        $data = [];
        foreach ($days as $key => $value)
        {

            $data[$key]['day'] = $value;
            foreach ($schedule as $k => $val)
            {
                if($key == $val['dayOfWeek'])
                {
                    $data[$key]['schedule'][] = $val;
                }
            }
        }
        $class_id = $id;
        // dd($data);
        return view('class::classschedule.schedule', compact('data', 'class_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createSchedule()
    {
        $days = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thrusday', 'Friday', 'Saturday');
        $subjects = Subjects::lists('subjectTitle', 'id')->toArray();
        return view('class::classschedule.add', compact('days', 'subjects'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function storeSchedule(Request $request, $id)
    {
        $data = $request->all();
        $data['classId'] = $id;
        ClassScheduleModel::create($data);
        return Redirect::route('class.schedule.create', $id)->withMessage('Schedule added successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editSchedule($id)
    {
        $days = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thrusday', 'Friday', 'Saturday');
        $subjects = Subjects::lists('subjectTitle', 'id')->toArray();
        $schedule = ClassScheduleModel::where('id', $id)->first();
        return view('class::classschedule.edit', compact('schedule', 'days', 'subjects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateSchedule(Request $request, $id)
    {
        $classId = ClassScheduleModel::where('id', $id)->lists('classId')->first();
        $data = $request->only('subjectId', 'dayOfWeek', 'startTime', 'endTime');
        ClassScheduleModel::where('id', $id)->update($data);
        return Redirect::route('class.schedule.create', $classId)->withMessage('Schedule updated successfully');
    }

    /**
     * Confirm Delete the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirm($id)
    {
        $schedule = ClassScheduleModel::where('id', $id)->first();
        return view('class::classschedule.confirm', compact('schedule'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $classId = ClassScheduleModel::where('id', $id)->lists('classId')->first();
        ClassScheduleModel::where('id', $id)->delete();
        return Redirect::route('class.schedule.create', $classId)->withMessage('Schedule Deleted successfully!!');
    }
}
