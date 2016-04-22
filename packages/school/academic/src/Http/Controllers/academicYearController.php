<?php

namespace School\Academic\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use School\Academic\Models\Academic;
use School\Academic\Http\Requests\CreateAcademicYearRequest;
use Session;
use Redirect;
use DB;

class academicYearController extends Controller
{

    private $academic;

    public function __construct(Academic $academic)
    {
        //$this->middleware('auth');
        $this->academic = $academic;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $academics = $this->academic->all();
      return View('academic::academic.list', compact('academics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('academic::academic.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAcademicYearRequest $request)
    {
        if($request->get('isDefault') && $request->get('isDefault') == 'on')
        {
            DB::table('academicYear')->update(array('isDefault' => 0));
            $isDefault = 1;
        }
        else
        {
            $isDefault = 0;
        }

        $data = array(
            'yearTitle' => $request->get('yearTitle'),
            'isDefault' => $isDefault,
        );

        $this->academic->create($data);
        Session::flash('message', 'Academic Year created successfully');
        return Redirect::to('admin/academic');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($academic)
    {
        if(is_numeric($academic))
        {
            $academicYear = $this->academic->where('id', $academic)->first();
            return View('academic::academic.edit', compact('academicYear'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateAcademicYearRequest $request, $academic)
    {

        if($request->get('isDefault') && $request->get('isDefault') == 'on')
        {
            DB::table('academicYear')->update(array('isDefault' => 0));
            $isDefault = 1;
        }
        else
        {
            $isDefault = 0;
        }

        $data = array(
            'yearTitle' => $request->get('yearTitle'),
            'isDefault' => $isDefault,
        );

        $this->academic->where('id', $academic)->update($data);

        Session::flash('message', 'Academic Year updated successfully');
        return Redirect::to('admin/academic');
    }

    /**
     * Confirm Delete the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirm($academic)
    {
        if(is_numeric($academic))
        {
            $academicYear = $this->academic->where('id', $academic)->first();
            return view('academic::academic.confirm', compact('academicYear') );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($academic)
    {
        if(is_numeric($academic))
        {
            if ($postDelete = $this->academic->where('id', $academic)->first())
            {
                if ($postDelete->isDefault == 1)
                {
                    Session::flash('message', "Can't delete default academic year!");
                }
                else
                {
                    $this->academic->where('id', $academic)->delete();
                    Session::flash('message', 'Academic Year Deleted sucessfully!');
                }
            }
            else
            {
                Session::flash('message', 'Some problem with deleting the vocabulary!');
            }
        }
        else
        {
            Session::flash('message', 'Some problem with deleting the vocabulary!');
        }
        return Redirect::to('admin/academic');
    }
}
