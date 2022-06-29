<?php

namespace App\Http\Controllers;

use App\User;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables; 


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
        $id = Auth::user()->user_id; 
        $user = User::where('id',$id)->first();
        return view('user.home',compact('user'));
    }
    
}
   
 