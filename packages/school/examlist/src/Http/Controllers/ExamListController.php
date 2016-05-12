<?php

namespace School\ExamList\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use School\ExamList\Models\ExamListModel;
use School\ExamList\Http\Requests\CreateExamListRequest;
use Redirect;

class ExamListController extends Controller
{

    private $examlist;
    /**
     * Contrructor funtion
     */
    public function __construct(ExamListModel $examlist) {
        $this->examlist = $examlist;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagination = 10;
        $examlists = $this->examlist->paginate($pagination);
        return view('examlist::examlist.list', compact('examlists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('examlist::examlist.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateExamListRequest $request)
    {
        $data = $request->only('examTitle', 'examDescription', 'examDate');
        $data['examAcYear'] = 1;
        $this->examlist->create($data);
        return Redirect::route('examlist.index')->withMessage('Exam Created Successfully!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $examlist = $this->examlist->where('id', $id)->first();
        if ($examlist)
        {
            return Redirect::route('examlist.edit', $examlist->id);
        }
        else
        {
            return Redirect::route('examlist.index')->withMessage('No Exam Found!!');
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
        $examlist = $this->examlist->where('id', $id)->first();
        if ($examlist)
        {
            return view('examlist::examlist.edit', compact('examlist'));
        }
        else
        {
            return Redirect::route('examlist.index')->withMessage('No exam Found!!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateExamListRequest $request, $id)
    {
        $data = $request->only('examTitle', 'examDescription', 'examDate');
        $data['examAcYear'] = 1;
        $this->examlist->where('id', $id)->update($data);
        return Redirect::route('examlist.index')->withMessage('Exam Updated Successfully.');
    }

    /**
     * Confirm remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirm($id)
    {
        $examlist = $this->examlist->where('id', $id)->first();
        if ($examlist)
        {
            return view('examlist::examlist.confirm', compact('examlist'));
        }
        else
        {
            return Redirect::route('examlist.index')->withMessage('No exam Found!!');
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
        $this->examlist->where('id', $id)->delete();
        return Redirect::route('examlist.index')->withMessage('Exam Deleted successfully');
    }
}
