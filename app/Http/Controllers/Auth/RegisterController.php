<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\RegistersUsers; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\File;
use App\model\admin\state;
use App\model\admin\country;


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

    public $UserCode=0;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware('guest', ['except' => ['edit', 'update','ImageUpload','ChangePassword','ShowChangePassword']]);
        $this->middleware('auth'); 
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
            'name' =>['required', 'string', 'max:255'],
            'email' =>['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' =>['required', 'string', 'min:3', 'confirmed'],
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
        return User::create([
            'name'=>$data['name'],
            'mobile'=>$data['mobile'],
            'user_name'=>$data['email'],
            'password'=> Hash::make($data['password']),
            'email'=>$data['email'],
        ]);
    }

    
    public function edit($id)
    {        
        $user = User::where('id',$id)->first();  
        $UserCode = $user->user_id; 
        $StateList = state::all(['PK', 'State']);
        $CountryList = country::all(['PK','country']);       
        return view('user.profile',compact('user','StateList','CountryList'));
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
            $id=Auth::user()->user_id;
            $user =  User::where('user_id',$id)->first();           
            $user->image = $pathToStore;
            $user->save();

            $imagestored=Auth::user()->image;
            if($imagestored!=null)
            {                
                $imagepath ='storage/app/'.$imagestored;
                if(File::exists($imagepath))
                {                    
                    File::delete($imagepath);
                }                
            }
        }
        echo '<script type="text/javascript">alert("Image uploaded successfully!")</script>';     
        return back();
     }

    public function update(User $user)
    { 
          $data = $this->validator([ 
           'name' => ['required', 'string', 'max:255'],          
           'mobile' => ['required', 'string'],
           'address' => ['required', 'string','max:255'],
           'state'=>['required','string','max:30'],
           'pincode'=>['required','string','min:6','max:6'],
        ]);
        $user->name = request('name');
        $user->mobile = request('mobile');
        $user->address = request('address');
        $user->state = request('state'); 
        $user->pincode = request('pincode'); 
        $user->save();    
        return back();
    }
  
   
      
}

