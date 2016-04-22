<?php

namespace School\Auth\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Session;
use Redirect;
use DB;
use Sentinel;
use Activation;

class LoginController extends Controller
{
    
    /**
     * Home Page after login.
     */
    public function home() {
        return view('home');
    }

    /**
     * Login page.
     */
    public function getLogin() {
        //$user = Sentinel::findById(1);
        //Activation::complete($user, 'LKvrfEXoHPKhqt4MTd1RWjchLWkkU453');
        return view('auth::auth.login');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request) {
        $input = $request->only('email', 'password');

        try {
            // validate the data
            $this->validate($request, array(
                'email' => 'required|exists:users',
                'password' => 'required'
                    )
            );
            // authentication
            Sentinel::authenticate($input, $request->has('remember'));
        } catch (\Cartalyst\Sentinel\Checkpoints\NotActivatedException $e) {
            return Redirect::back()->withInput()->withErrors(array('User Not Activated.'));
        } catch (\Cartalyst\Sentinel\Checkpoints\ThrottlingException $e) {
            return Redirect::back()->withInput()->withErrors(array('Your account has been suspended.'));
        }
        // check for the login
        if (Sentinel::check()) {
            return Redirect::to('home');
        } else {
            return Redirect::back()
                ->withInput()
                ->withErrors(array('Invalid credentials provided'));
        }
    }
    
    /**
     * Logout from site.
     */
    public function logout() {
        Sentinel::logout();
        return Redirect::to('login');
    }

}
