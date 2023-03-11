<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('shopkeepar.dashboard');
    }

    public function adminHome()
    {
        return view('admin.dashboard');
    }

    public function shopownerHome()
    {
        return view('shopowner.dashboard');
    }

    public function registration_success(){
    
    return view('registration_completed');
    }


}
