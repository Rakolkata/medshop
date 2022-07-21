<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Model\admin\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\admin\Product;
use App\Model\admin\Order;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Support\Facades\Validator;
class orderController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth:admin');            
    }


     public function create()
     { 

        $id = Auth::user()->id; 
        $user = Admin::where('id',$id)->first();
        
       return view('admin.order');
    }

     //store Order Details
     public function store(Request $request)
     { 
        $request->validate([
            'customerName' =>'required', 'string', 'max:255',
            'orderId'=>'required',
            'productId'=>'required',
            'productName'=>'required',
            'orderNumber'=>'required','string',
            'quantity'=>'required',
            'price'=>'required',
            'totalPrice'=>'required',
            'paymentMode' =>'required','string',
            'deliveryDate' =>'date',
            'deliveryNote'=>'required','string',
            
         ]);

       $orderDetail = new Order;
       $orderDetail->customerName = $request->customerName;
       $orderDetail->orderId = $request->orderId;
       $orderDetail->orderNumber = $request->orderNumber;
       $orderDetail->productId = $request->productId;
       $orderDetail->productName =$request->productName;
       $orderDetail->quantity = $request->quantity;
       $orderDetail->price = $request->price;
       $orderDetail->totalPrice = $request->totalPrice;
       $orderDetail->paymentMode = $request->paymentMode;
       $orderDetail->deliveryDate = $request->deliveryDate;
       $orderDetail->deliveryNote = $request->deliveryNote;
       $orderDetail->save();
       
       return redirect()->route('order.create')
       ->with('success','Order has been created successfully.');
       }

       public function show()
       {        
            $query=Order::all();
            return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('action',function($row){
            $btn = '<a href="#" onclick="myfunction('.$row->id.')";>
            <span style="color:green;"><i class="fas fa-edit "></i></span></a>'.'&nbsp;<a href="'.route('order.delete',$row->id).'">
            <span style="color:red;"><i class="fa fa-trash"></i></span></a>';
            return $btn;
            })
            ->make(true);
      }
      public function Destroy(Request $request)
      {
        $com =Order::where('id',$request->id)->delete();
        return back();        
      }

      public function edit(Request $request)
     {  
      $id=$request->post('item');
      $item =Order::where('id',$id)->first();      
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
            'customerName' =>'required', 'string', 'max:255',
            'orderId'=>'required',
            'productId'=>'required',
            'productName'=>'required',
            'orderNumber'=>'required','string',
            'quantity'=>'required',
            'price'=>'required',
            'totalPrice'=>'required',
            'paymentMode' =>'required','string',
            'deliveryDate' =>'date',
            'deliveryNote'=>'required','string',
            
         ]);
       $orderDetail=Order::where('id',$request->id)->first();
       $orderDetail->customerName = $request->customerName;
       $orderDetail->orderId = $request->orderId;
       $orderDetail->orderNumber = $request->orderNumber;
       $orderDetail->productId = $request->productId;
       $orderDetail->productName =$request->productName;
       $orderDetail->quantity = $request->quantity;
       $orderDetail->price = $request->price;
       $orderDetail->totalPrice = $request->totalPrice;
       $orderDetail->paymentMode = $request->paymentMode;
       $orderDetail->deliveryDate = $request->deliveryDate;
       $orderDetail->deliveryNote = $request->deliveryNote;
       $result=$orderDetail->save();
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
