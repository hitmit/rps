<?php

namespace School\Transports\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use School\Transports\Http\Models\TransportsModel;
use Illuminate\Support\Facades\View;
use Redirect;
use DB;

class TransportsController extends Controller {

    private $transport;

    public function __construct(TransportsModel $transport) {
        $this->transport = $transport;
    }

    /**
     * List Transportations.
     */
    public function index() {
        $transports = $this->transport->all();
        return View('transport::transport.list', ['transports' => $transports]);
    }

    /**
     * Create Transport form.
     */
    public function create() {
        return View('transport::transport.create');
    }

    /**
     * Store Transportations to system.
     */
    public function store(Request $request) {
        // Request transports fields and create transports.
        $transport = $request->only('transportTitle', 'transportDescription', 'transportDriverContact', 'transportFare');
        $this->transport->create($transport);

        return Redirect::route('transports.index')->withMessage('Transports Created Successfully.');
    }

    /**
     * Edit Transport form.
     */
    public function edit($id) {
        $transport = $this->transport->where('id', $id)->first();
        return View('transport::transport.edit', ['transport' => $transport]);
    }

    /**
     * update Transportations.
     */
    public function update(Request $request, $id) {
        $data = $request->only('transportTitle', 'transportDescription', 'transportDriverContact', 'transportFare');

        $this->transport->where('id', $id)->update($data);
        return Redirect::route('transports.index')->withMessage('Transports updated Successfully.');
    }

    /**
     * Confirm Transportations delete form.
     */
    public function confirm($id) {
        $transport = $this->transport->where('id', $id)->first();
        return view('transport::transport.confirm', compact('transport') );
    }

    /**
     * Destroy Teacher form.
     */
    public function destroy($id) {
        $this->transport->where('id', $id)->delete();
        return Redirect::route('transports.index')->withMessage('Transports Deleted Successfully.');
    }
    
    /**
     * Fetch Transport Users.
     */
    public function fetchSubs($id) {
        $users = DB::table('users')
            ->join('user_attributes', 'users.id', '=', 'user_attributes.id')
            ->select('users.first_name','users.last_name', 'users.email', 'user_attributes.mobileNo', 'user_attributes.phoneNo')
            ->where('user_attributes.transport', $id)
            ->get();
        return View('transport::transport.transport_users', ['users' => $users]);
    }
}
