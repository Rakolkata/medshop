<?php 
  
namespace App\Http\Controllers\Admin\Auth; 
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Model\admin\Admin;
//use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Hash;
class ForgotPasswordController extends Controller
{
      /**
       * Write code on Method
       *
       * @return response()
       */
    public function __construct()
    {   
      $this->middleware('guest');
    }


    public function index()
    {   //$SubscriptionData= companyregisters::where('is_primary',1)->first();
        return view('admin/auth/passwords/forgetPassword');
    }

    public function validate_user(Request $request)
    { 
      $id =$request->post('id');
      $admin=Admin::where('id',$id)->first();
      $email= $admin->email;
      $flag=false;
      if($admin!=null)
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
             'id'=>['required'],
             'email'=>['required'],
             'new_password'=>['required'],
             'confirm_password'=>['same:new_password'],
        ]);
      $admin = Admin::where('id',$request->id)->first();
      $admin->id = request('id');
      $admin->email = request('email');
      $admin->password = Hash::make(request('new_password')); 
      $admin->save();    
      
      return redirect('admin-login')->with('success', 'Password successfully changed!');

    }
  
   
}
