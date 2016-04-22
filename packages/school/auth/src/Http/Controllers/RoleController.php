<?php

namespace School\Auth\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Session;
use Redirect;
use Sentinel;

class RoleController extends Controller
{

    //private $role;

    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Sentinel::getRoleRepository()->all();
        return view('auth::role.list', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth::role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $request->get('name');
        $slug = strtolower(str_replace(' ', '_', $name));
        $role = array(
            'name' => $name,
            'slug' => $slug,
        );
        $role = Sentinel::getRoleRepository()->createModel()->create($role);
        Session::flash('message', 'Role created successfully!');
        return Redirect::to('admin/role');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Sentinel::findRoleById($id);
        if ($role)
        {
            return View('auth::role.edit', compact('role'));
        }
        else
        {
            Session::flash('message', 'No Role found!');
            return Redirect::to('admin/role');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $name = $request->get('name');
        $slug = strtolower(str_replace(' ', '_', $name));
        $role = array(
            'name' => $name,
            'slug' => $slug,
        );

        Sentinel::getRoleRepository()->where('id', $id)->update($role);
        Session::flash('message', 'Role Updated successfully');
        return Redirect::to('admin/role');
    }

    /**
     * Confirm Delete the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirm($id)
    {
        $role = Sentinel::findRoleById($id);
        if ($role)
        {
            return view('auth::role.confirm', compact('role'));
        }
        else
        {
            Session::flash('message', 'No Role found!');
            return Redirect::to('admin/role');
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
        Sentinel::getRoleRepository()->where('id', $id)->delete();
        Session::flash('message', 'Role Deleted successfully');
        return Redirect::to('admin/role');
    }
}
