<?php

namespace School\Classes\Http\Controller;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use School\Classes\Models\ClassModel;
use School\Classes\Http\Requests\CreateClassRequest;
use Redirect;

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
        $classes = $this->class->all();
        return view('class::class.list', ['classes' => $classes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('account::feetype.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateClassRequest $request)
    {
        $this->feeType->create($request->all());
        return Redirect::route('feetype.index')->withMessage('Fee type Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $feetype = $this->feeType->where('id', $id)->first();
        if($feetype) {
            return Redirect::route('feetype.edit', $id);
        }
        return Redirect::route('feetype.index')->withMessage('Fee Type not found!!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $feetype = $this->feeType->where('id', $id)->first();
        if($feetype) {
            return view('account::feetype.edit', ['feetype' => $feetype]);
        }
        return Redirect::route('feetype.index')->withMessage('Fee Type not found!!');
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
        $this->feeType->where('id', $id)->update($request->only('feeTitle', 'feeDefault', 'feeNotes'));
        return Redirect::route('feetype.index')->withMessage('Fee Type Updated Successfully');
    }

    /**
     * Confirm Delete the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirm($id)
    {
        $feetype = $this->feeType->where('id', $id)->first();
        if($feetype) {
            return view('account::feetype.confirm', compact('feetype') );
        }
        Redirect::route('feetype.index')->withMessage('Fee Type not found!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->feeType->where('id', $id)->delete();
        return Redirect::route('feetype.index')->withMessage('Fee Type Deleted successfully!!');
    }
}
