<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Admin\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Admin\HomeController;
use App\Model\admin\Admin;
use Illuminate\Support\Facades\Auth;

class ResetPasswordController extends Controller
{
     public function __construct()
    {
       $this->middleware('auth:admin');
    }

    public function ShowResetPassword()
    {
        $deshboard_count = new HomeController();
        $id = Auth::user()->id; 
        $user = Admin::where('id',$id)->first();
    
        $headData = $deshboard_count->deshboard_count();
        return view('admin/ChangePassword',compact('user','headData'));
    } 
   
    public function UpdatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
   
        Admin::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);

        return redirect(route('admin.home'));

    }

}
