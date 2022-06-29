<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
//use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

   // use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {   
        $this->middleware('guest');
    }


    public function index()
    {   
        return view('auth/Password/forgotpassword');
    }

    public function validate_user(Request $request)
    {  
      $id =$request->post('id');
      $user=User::where('id',$id)->first();
      $email= $user->email;
      $flag=false;
      if($user!=null)
      {
        $flag=true;
        return response()->json(['success'=>$flag,'email'=>$email]);
      }
      else{

        return response()->json(['success'=>$flag]);
      }
      
      
    }

    public function UpdatePassword(Request $request)
    {        
       $request->validate([
             'user_id'=>['required'],
             'email'=>['required'],
             'new_password'=>['required'],
             'confirm_password'=>['same:new_password'],
        ]);
      $user = User::where('id',$request->user_id)->first();
      $user->user_id = request('user_id');
      $user->email = request('email');
      $user->password = Hash::make(request('new_password')); 
      $user->save();    
      return redirect('login');
      
    }
  
   
}
   

