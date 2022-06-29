<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Model\admin\Admin;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use App\User;
use App\Model\admins;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware('auth:admin');            
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    { 
        $id = Auth::user()->id; 
        $user = Admin::where('id',$id)->first();
        return view('admin.home',compact('user'));
        
    }

    public function ProfileUpdate(Request $request)
    {

        $id=request('id');
        $user=User::where('id',$id)->first();
        $user->user_name = request('user_name');
        $user->email = request('email');
        $user->name = request('name');
        $user->address = request('address');
        $user->mobile = request('mobile');
        $user->state = request('state'); 
        $user->pincode = request('pincode');
       // if(request('password'))$user->password = Hash::make(request('password'));
        $user->save();

        return back();
    }     
}