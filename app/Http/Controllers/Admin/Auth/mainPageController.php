<?php

namespace App\Http\Controllers\admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class mainPageController extends Controller
{
     public function __construct()
    { 
        $this->middleware('guest:admin')->except('logout');
    }

    public function  welcomeindex()
    {
        return view('welcomefg');
    }
}
