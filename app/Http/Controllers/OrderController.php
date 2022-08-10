<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Model\admin\Product;
use App\Model\Order;
use Illuminate\Support\Facades\Auth;
use App\Model\Cart;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); 
    }

    public function checkout()
    {
        $userId=Auth::user()->user_id;
        $list=Cart::where('user_id', $userId)->get(); 
        $cartlist = (new Cart)->newCollection();
        foreach($list as $item)
        {
            $product=Product::where('id',$item->product_id)->first();
            $product->quantity=$item->quantity;
            $cartlist->add($product);
        }
        return view('checkout',compact('cartlist'));
    }

    public function orders_create(Request $request)
    {  
       $orders=new Order;
       $orders->c_country = $request->c_country;
       $orders->user_id = Auth::user()->user_id;
       $orders->c_fname = $request->c_fname;
       $orders->c_lname = $request->c_lname;
       $orders->c_address =$request->c_address;
       $orders->c_state_country = $request->c_state_country;
       $orders->c_postal_zip = $request->c_postal_zip;
       $orders->c_email_address = $request->c_email_address;
       $orders->c_phone = $request->c_phone;
       $orders->c_order_notes = $request->c_order_notes;
       $orders->payment_mode = $request->payment_mode;
       $orders->totalAmount = $request->totalAmount;
       $orders->save();
       return redirect()->route('thankyou')
       ->with('success','Order has been created successfully.');
      
    }


}
