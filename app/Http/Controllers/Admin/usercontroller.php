<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Model\admin\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\admin\Product;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Model\admin\state;
use App\Model\admin\country;
use Illuminate\Support\Facades\hash;
use Illuminate\Support\Facades\Validator;

class usercontroller extends Controller
{
    public function __construct()
    {
       $this->middleware('auth:admin');            
    }


     public function create()
    { 

        $id = Auth::user()->id; 
        $user = Admin::where('id',$id)->first();
        $StateList = state::all(['PK', 'State']);
        $CountryList = country::all(['PK','country']);
        return view('admin.addCustomer',compact('StateList','CountryList'));
    }

    public function GetUserByName(Request $request)
     {        
       $name=$request->post('name');
       $Userlist=User::select("id","name")
                    ->where('name','LIKE',"%$name%")
                   
                    ->get();          
      if($Userlist!=null)
      {
        return json_encode($Userlist);
      }
      else{
        $flag=false;
        return response()->json(['success'=>$flag]);
      }
        
    }

    //store user
    public function store(Request $request)
     { 
           $request->validate([
            'name' =>'required', 'string', 'max:255',
            'user_id'=>'required',
            'user_name'=>'required','string',
            'mobile'=>'max:10',
            'email'=>'email:rfc,dns',
            'alternate_email'=>'email:rfc,dns',
            'address' =>'required','string',
            'country' =>'required','string',
            'State'=>'required','string',
            'pincode'=>'required','min:6','max:6',
         ]);
       $user = new User;
       $user->name = $request->name;
       $user->user_id = $request->user_id;
       $user->user_name = $request->user_name;
       $user->password = Hash::make(request('password'));
       $user->mobile = $request->mobile;
       $user->email = $request->email;
       $user->alternate_email = $request->alternate_email;
       $user->address = $request->address;
       $user->country = $request->country;
       if(request('country')=="India"){
           $user->State=request('state');
         }
         else{
           $user->State=request('foreignerState');
         }
       $user->pincode = $request->pincode;
       $user->save();
            return redirect()->route('user.create')
            ->with('success','Customer has been created successfully.');
       
 }
        public function show()
    {        
               $query=User::all();
              return Datatables::of($query)
                    ->addIndexColumn()
                    ->addColumn('action',function($row){
                    $btn = '<a href="#" onclick="myfunction('.$row->id.')";>
                           <span style="color:green;"><i class="fas fa-edit "></i></span></a>'.'&nbsp;<a href="'.route('user.delete',$row->id).'">
                           <span style="color:red;"><i class="fa fa-trash"></i></span></a>';
                        return $btn;
                    })
                    ->make(true);
    }

    public function delete(Request $request)
    {
        $com =User::where('id',$request->id)->delete();
        return back();        
    }
    
    public function edit(Request $request)
     {  
      $id=$request->post('item');
      $item =User::where('id',$id)->first();      
      if($item!=null)
      {
        return json_encode($item);
      }
      else{
            $flag=false;
        return response()->json(['success'=>$flag]);
      }
   }

   public function update(Request $request) 
   {   
       $request->validate([
            'name' =>'required', 'string', 'max:255',
            'user_id'=>'required',
            'user_name'=>'required','string',
            'mobile'=>'max:10',
            'email'=>'email:rfc,dns',
            'alternate_email'=>'email:rfc,dns',
            'address' =>'required','string',
            'country' =>'required','string',
            'State'=>'required','string',
            'pincode'=>'required','min:6','max:6',
         ]);

       $user=User::where('id',$request->id)->first();
       $user->name = $request->name;
       $user->mobile = $request->mobile;
       $user->email = $request->email;
       $user->alternate_email = $request->alternate_email;
       $user->address = $request->address;
       $user->country = $request->country;
       $user->state = $request->state;
       $user->pincode = $request->pincode;
       $result=$user->save();

       if($result)
       {
        $flag=true;
       return response()->json(['status'=>$flag]);
       }else{
        $flag=false;
       return response()->json(['status'=>$flag]);
       }
    }



}
