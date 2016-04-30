<?php

namespace School\Accounts\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use School\Accounts\Models\FeeAllocationModel;
use School\Accounts\Http\Requests\CreateFeeTypeRequest;
use Redirect;

class FeeAllocationController extends Controller
{
    private $feeAllocation;

    public function __construct(FeeAllocationModel $feeAllocation) {
        $this->feeAllocation = $feeAllocation;
    }

    public function listAll()
    {
        $toReturn = array();
        $toReturn['classes'] = array();
        $toReturn['classAllocation'] = array();
        $classesIn = array();

        $classes = classes::where('classAcademicYear',$this->panelInit->selectAcYear)->select('id','className')->get();
        foreach ($classes as $class) {
            $toReturn['classes'][$class->id] = $class->className;
            $classesIn[] = $class->id;
        }

        if(count($classesIn) > 0){
            $toReturn['classAllocation'] = feeAllocation::where('allocationType','class')->whereIn('allocationId',$classesIn)->get()->toArray();
        }

        $toReturn['StudentAllocation'] = \DB::table('feeAllocation')
            ->leftJoin('users', 'users.id', '=', 'feeAllocation.allocationId')
            ->select('feeAllocation.id as id',
                'feeAllocation.allocationId as userId',
                'users.fullName as fullName')
            ->where('feeAllocation.allocationType','student')->get();

        $toReturn['feeType'] = feeType::get()->toArray();
        return $toReturn;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feeAllocations = $this->feeAllocation->all();
        return view('account::feeAllocation.list', ['feeAllocations' => $feeAllocations]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('account::feeAllocation.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateFeeTypeRequest $request)
    {
        $this->feeAllocation->create($request->all());
        return Redirect::route('feeAllocation.index')->withMessage('Fee Allocation Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $feeAllocation = $this->feeAllocation->where('id', $id)->first();
        if($feeAllocation) {
            return Redirect::route('feeAllocation.edit', $id);
        }
        return Redirect::route('feeAllocation.index')->withMessage('Fee Type not found!!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $feeAllocation = $this->feeAllocation->where('id', $id)->first();
        if($feeAllocation) {
            return view('account::feeAllocation.edit', ['feeAllocation' => $feeAllocation]);
        }
        return Redirect::route('feeAllocation.index')->withMessage('Fee Allocation not found!!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateFeeTypeRequest $request, $id)
    {
        $data = array();
        $this->feeAllocation->where('id', $id)->update($data);
        return Redirect::route('feetype.index')->withMessage('Fee Allocation Updated Successfully');
    }

    /**
     * Confirm Delete the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirm($id)
    {
        $feeAllocation = $this->feeAllocation->where('id', $id)->first();
        if($feeAllocation) {
            return view('account::feeAllocation.confirm', compact('feeAllocation') );
        }
        Redirect::route('feeAllocation.index')->withMessage('Fee Allocation not found!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->feeAllocation->where('id', $id)->delete();
        return Redirect::route('feeAllocation.index')->withMessage('Fee Allocation Deleted successfully!!');
    }
}
