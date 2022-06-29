<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Model\admin\Admin;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

 

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'admin/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    { 
        $this->middleware('guest:admin')->except('logout');
    }

     public function showLoginForm()
    {

    
        return view('admin.auth.login');
    }

    public function login(Request $request)
    { 
        $this->validateLogin($request); 
 
        if ($this->attemptLogin($request))

         {
            Auth::logoutOtherDevices($request->get('password'));
            return $this->sendLoginResponse($request);
        } 

        return $this->sendFailedLoginResponse($request);
    } 
   
    protected function guard()
    {
        return Auth::guard('admin'); 
    }
    public function logout(Request $request) {
        $this->guard()->logout();
        $request->session()->invalidate();
        $request->session()->flash('errors', 'test');
        if($request->ajax()) {
            return Response::json(array(
                'success' => true,
                'data'   => 'test'
            )); 
        }
        else {
            return redirect('/');
        }
    }
  
 
}