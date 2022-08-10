<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); 
    }
    public function create(Request $request)
    {  
       $User=new User;
       $User->name = $request->name;
       $User->mobile = $request->mobile;
       $User->user_name = $request->email;
       $User->password = $request->password;
       $User->email = $request->email;
       $User->save();
       return redirect()->route('welcome')
       ->with('success','user has been created successfully.');
       
    }
}
