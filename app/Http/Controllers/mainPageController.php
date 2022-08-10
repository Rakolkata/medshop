<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\admin\Product;
use Illuminate\Support\Facades\Auth;
use App\Model\Cart;
use Session;


class mainPageController extends Controller
{
    public function  welcomeindex()
    {
      $productlist=Product::all();
      $itemcount=0;      
      if (Auth::check()) {
        $userId=Auth::user()->user_id;
        $item=Cart::where('user_id', $userId)->get();
        $total=0;
        foreach($item as $list)
        {
          $productdta=Product::where('id',$list->product_id)->get();
          $total=$total+($productdta[0]->price*$list->quantity); 
        }
        $count= Cart::where('user_id', $userId)->get()->count();
        Session::put('cartcount',$count);
        Session::put('totalCartprice',$total);
      }
      return view('welcome',compact('productlist'));
    }

    public function  about()
    {
      return view('about');
    }
    public function  contact()
    {
        return view('contact');
    }

    public function  main()
    {
        return view('main');
    }
    
    public function shop_single($id)
    {
      $product=Product::where('id',$id)->first();
      return view('shop-single',compact('product'));
    }
    public function shop()
    {
      $productlist=Product::all();
      return view('shop',compact('productlist'));
    }
    public function thankyou()
    {
        
      return view('thankyou');
    }


}

