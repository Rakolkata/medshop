<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Model\admin\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;

class ProductController extends Controller
{
     public function __construct()
    {
       $this->middleware('auth:admin');            
    }


     public function index()
    { 
        $id = Auth::user()->id; 
        $user = Admin::where('id',$id)->first();
        return view('admin.product');
        
    }
}
