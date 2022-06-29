<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\User;

class ResetPasswordController extends Controller
{
   

    public function ShowChangePassword()
    {
        $deshboard_count = new HomeController();
        $id = Auth::user()->user_id; 
        $user = User::where('id',$id)->first();
        $headData = $deshboard_count->deshboard_count();
       return view('changePassword',compact('headData','user'));
    }

    public function UpdatePassword(Request $request)
    {   
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
   
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
        return redirect(route('home'));
    }
}
