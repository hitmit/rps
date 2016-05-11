<?php

namespace School\Hostel\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use School\Hostel\Models\HostelModel;
use School\Hostel\Models\HostelCategoryModel;
use School\Hostel\Http\Requests\CreateHostelCategoryRequest;
use Redirect;

class HostelCategoryController extends Controller
{
    
    private $category;
    /**
     * Contrructor funtion
     */
    public function __construct(HostelCategoryModel $category) {
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagination = 10;
        $hostels = HostelModel::lists('hostelTitle', 'id')->toArray();
        $hostelCats = $this->category->paginate($pagination);
        foreach ($hostelCats as $key => &$value) {
            $value->catTypeId = $hostels[$value->catTypeId];
        }
        return view('hostel::category.list', compact('hostelCats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hostels = HostelModel::lists('hostelTitle', 'id')->toArray();
        return view('hostel::category.create', compact('hostels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateHostelCategoryRequest $request)
    {
        $this->category->create($request->only('catTypeId', 'catTitle', 'catFees', 'catNotes'));
        return Redirect::route('hostelCat.index')->withMessage('Hostel Category Created Successfully!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hostelCat = $this->category->where('id', $id)->first();
        if ($hostelCat) {
            return Redirect::route('hostelCat.edit', $hostelCat->id);
        } else {
            return Redirect::route('hostelCat.index')->withMessage('No Hostel Category Found!!');
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
        $hostelCat = $this->category->where('id', $id)->first();
        if ($hostelCat) {
            $hostels = HostelModel::lists('hostelTitle', 'id')->toArray();
            return view('hostel::category.edit', compact('hostelCat', 'hostels'));
        } else {
            return Redirect::route('hostelCat.index')->withMessage('No Hostel Category Found!!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateHostelCategoryRequest $request, $id)
    {
        $data = $request->only('catTypeId', 'catTitle', 'catFees', 'catNotes');
        $this->category->where('id', $id)->update($data);
        return Redirect::route('hostelCat.index')->withMessage('Hostel Category Updated Successfully.');
    }
    
    /**
     * Confirm remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirm($id)
    {
        $hostelCat = $this->category->where('id', $id)->first();
        if ($hostelCat) {
            return view('hostel::category.confirm', compact('hostelCat'));
        } else {
            return Redirect::route('hostelCat.index')->withMessage('No Hostel Category Found!!');
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
        $this->category->where('id', $id)->delete();
        return Redirect::route('hostelCat.index')->withMessage('Hostel Category Deleted successfully');
    }
}
