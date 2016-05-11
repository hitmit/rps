<?php

namespace School\Hostel\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use School\Hostel\Models\HostelModel;
use School\Hostel\Http\Requests\CreateHostelRequest;
use Redirect;

class HostelController extends Controller
{
    
    private $hostel;
    /**
     * Contrructor funtion
     */
    public function __construct(HostelModel $hostel) {
        $this->hostel = $hostel;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagination = 10;
        $hostels = $this->hostel->paginate($pagination);
        return view('hostel::hostel.list', compact('hostels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hostel::hostel.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateHostelRequest $request)
    {
        $this->hostel->create($request->only('hostelTitle', 'hostelType', 'hostelAddress', 'hostelManager', 'hostelNotes'));
        return Redirect::route('hostel.index')->withMessage('Hostel Created Successfully!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hostel = $this->hostel->where('id', $id)->first();
        if ($hostel) {
            return Redirect::route('hostel.edit', $hostel->id);
        } else {
            return Redirect::route('hostel.index')->withMessage('No hostel Found!!');
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
        $hostel = $this->hostel->where('id', $id)->first();
        if ($hostel) {
            return view('hostel::hostel.edit', compact('hostel'));
        } else {
            return Redirect::route('hostel.index')->withMessage('No hostel Found!!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateHostelRequest $request, $id)
    {
        $data = $request->only('hostelTitle', 'hostelType', 'hostelAddress', 'hostelManager', 'hostelNotes');
        $this->hostel->where('id', $id)->update($data);
        return Redirect::route('hostel.index')->withMessage('Hostel Updated Successfully.');
    }
    
    /**
     * Confirm remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirm($id)
    {
        $hostel = $this->hostel->where('id', $id)->first();
        if ($hostel) {
            return view('hostel::hostel.confirm', compact('hostel'));
        } else {
            return Redirect::route('hostel.index')->withMessage('No hostel Found!!');
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
        $this->hostel->where('id', $id)->delete();
        return Redirect::route('hostel.index')->withMessage('Hostel Deleted successfully');
    }
}
