<?php

namespace App\Http\Controllers\Admin\Auth;
use App\Rules\MatchOldPassword;
use App\Http\Controllers\Controller;
use App\Model\admin\Admin;
use App\Model\API\CustomerMasterModel;
use App\Model\API\InvoiceMasters;
use App\Model\API\SaleSubscription;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\tblstate;
use Illuminate\Support\Facades\File;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('guest', ['except' => ['edit', 'update','ImageUpload','ChangePassword','ShowChangePassword']]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:3', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return Admin::create([
            'name'=>$data['name'],
            'mobile'=>$data['mobile'],
            'user_name'=>$data['email'],
            'email'=>$data['email'],
            'password'=>Hash::make($data['password']),

        ]);
    }


    public function edit($id)
    {         
        $user =Admin::where('id',$id)->first();
        $headData = $this->deshboard_count();
        $StateList = tblstate::all(['PK', 'State']);
        return view('admin.profile',compact('user','headData','StateList'));   
    }


    public function ShowChangePassword()
    {
        //$id = Auth::user()->user_id; 
        //$admin = Admin::where('id',$id)->first();
        $headData = $this->deshboard_count();
        return view('admin/ChangePassword',compact('headData'));
    }

   public function ChangePassword(Request $request)
   {
         $request->validate([
             'current_password' => ['required', new MatchOldPassword],
             'new_password' => ['required'],
             'new_confirm_password' => ['same:new_password'],
        ]);
        Admin::find(Auth::user()->id)->update(['password'=> Hash::make($request->new_password)]);
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OurServices  $ourServices
     * @return \Illuminate\Http\Response
     */
     public function ImageUpload(Request $request)
    { 
        if($request->hasFile('image'))
        {
            $fileNameExt = $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($fileNameExt, PATHINFO_FILENAME);
            $fileExt = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$fileExt;
            $pathToStore = $request->file('image')->storeAs('public/images',$fileNameToStore);

            $imagestored=Auth::user()->image;
            if($imagestored!=null)
            {                
                $imagepath ='storage/app/'.$imagestored;
                if(File::exists($imagepath))
                {                    
                    File::delete($imagepath);
                }                
            }
            $id=Auth::user()->id;
            $user =  Admin::where('id',$id)->first();           
            $user->image = $pathToStore;
            $user->save();
           
        }
       echo ('<script type="text/javascript">alert("Image uploaded successfully!")</script>');    
        return back();
     }

    public function update(Admin $user)
    {
         $data = $this->validator([  
           'name'=>['required', 'string'],       
           'mobile'=> ['required', 'string'],
           'address'=> ['required', 'string','max:255'],
           'state'=>['required','string','max:30'],
           'pincode'=>['required','string','min:6','max:6'],
        ]);
         
        $user->name = request('name');
        $user->address = request('address');
        $user->mobile = request('mobile');
        $user->state = request('state'); 
        $user->pincode = request('pincode');
       // if(request('password'))$user->password = Hash::make(request('password'));
        $user->save();

        return back();
    }
    public function deshboard_count()
    {
        $paid=0;
        $unpaid=0;
        $totalamt=0;
        $recamt=0;
        $id=Auth::user()->id;
        $Subscriptionquery=SaleSubscription::where('id',$id)->count();
        $Invoicequery=InvoiceMasters::where('customer_id',$id)->get();
        $balance=0;


        foreach($Invoicequery as $row)
        {
          $totalamt=isset(InvoiceMasters::find($row->id)->ledgers()->first()->amount)?InvoiceMasters::find($row->id)->ledgers()->first()->amount:"0";
           $recamt =InvoiceMasters::find($row->id)->receipt()->sum('amount');
            if($totalamt==$recamt)
            {
             $paid++;
            }
            else{
             $unpaid ++;
            }
        }



        return array(
            'subscription'=>$Subscriptionquery,
            'invoice'=>$Invoicequery->count(),
            'paid'=>$paid,
            'unpaid'=>$unpaid,
            'balance'=>$balance
        );

    }
}
