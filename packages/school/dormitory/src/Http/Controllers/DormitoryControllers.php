<?php

namespace School\Dormitory\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use School\Dormitory\Models\DormitoryModel;
use School\Dormitory\Http\Requests\CreateDormitoryRequest;
use Session;
use Redirect;
use DB;

class DormitoryController extends Controller
{

    private $dormitory;

    public function __construct(DormitoryModel $dormitory)
    {
        //$this->middleware('auth');
        $this->dormitory = $dormitory;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dormitories = $this->dormitory->all();
        return View('dormitory::dormitory.list', compact('dormitories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dormitory::dormitory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateDormitoryRequest $request)
    {
        $data = $request->only('dormitory', 'dormDesc');
        $this->dormitory->create($data);
        return Redirect::route('dormitory.index')->withMessage('Dormitory Created Successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dormitory = $this->dormitory->where('id', $id)->first();
        return View('dormitory::dormitory.edit', compact('dormitory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateDormitoryRequest $request, $id)
    {
        $data = $request->only('dormitory', 'dormDesc');
        $this->dormitory->where('id', $id)->update($data);
        return Redirect::route('dormitory.index')->withMessage('Dormitory Updated Successfully.');
    }

    /**
     * Confirm Delete the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirm($id)
    {
        $dormitory = $this->dormitory->where('id', $id)->first();
        return view('dormitory::dormitory.confirm', compact('dormitory') );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->dormitory->where('id', $id)->delete();
        return Redirect::route('dormitory.index')->withMessage('Dormitory Deleted successfully');
    }
}
