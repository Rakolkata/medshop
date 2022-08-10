<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Model\admin\Product;
use Illuminate\Support\Facades\Auth;
use App\Model\Cart;
use Session;


class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); 
    }

    public function showcart()
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
        return view('cart',compact('cartlist'));
    }

    public function updateProductQuantity(Request $request)
    {         
        $userId=Auth::user()->user_id;
        $productDta = Cart::where('user_id', $userId)->where('product_id',$request->productid)->first();
        $productDta->quantity=$request->quantity;            
        $res=$productDta->save();
        $status=false;
        if($res)
        {
            $status=true;
        }
        //return json_encode(['invoice'=>$invoice,'items'=>$item]);
        return response()->json(['success'=>$status]);
    }
    public function removeProductFromCart($id)
    {
        $userId=Auth::user()->user_id;
        $status=false;
        if(Cart::where('user_id','=',$userId)->where('product_id','=',$id)->exists())
        {
            $status=Cart::where('user_id','=',$userId)->where('product_id','=',$id)->delete();           
        }
        if($status)
        {
            session()->forget('cartcount');
            $count=Cart::where('user_id', $userId)->get()->count();
            session()->put('cartcount', $count);
            $item=Cart::where('user_id', $userId)->get();
            $total=0;
            foreach($item as $list)
            {
              $productdta=Product::where('id',$list->product_id)->get();
              $total=$total+($productdta[0]->price*$list->quantity); 
            }
            session()->forget('totalCartprice');
            session()->put('totalCartprice', $total);
            return redirect()->back()->with('success', 'Product removed cart successfully!');
        }
        return redirect()->back();
    }
    public function addProductToCart($id)
    {
        $userId=Auth::user()->user_id;
        if(!Cart::where('user_id','=',$userId)->where('product_id','=',$id)->exists())
        {
            $cart = new Cart;
            $cart->user_id= $userId;
            $cart->product_id=$id;
            $status=$cart->save();
        }
        $list=Cart::where('user_id', $userId)->get(); 
        session()->forget('cartcount');
        $count=Cart::where('user_id', $userId)->get()->count();
        session()->put('cartcount', $count);
        $cartlist = (new Cart)->newCollection();
        foreach($list as $item)
        {
            $product=Product::where('id',$item->product_id)->first();
            $cartlist->add($product);
        }
        $total=0;
        foreach($list as $item)
        {
          $productdta=Product::where('id',$item->product_id)->get();
          $total=$total+($productdta[0]->price*$item->quantity); 
        }
        session()->forget('totalCartprice');
        session()->put('totalCartprice', $total);
        return redirect()->back()->with('success', 'Product added to cart successfully!');

    }
    
    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }


}
