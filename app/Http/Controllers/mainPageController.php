<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\admin\Product;


class mainPageController extends Controller
{
    public function  welcomeindex()
    {
      $productlist=Product::all();
      return view('welcome',compact('productlist'));
    }

    public function  about()
    {
          return view('about');
    }

    public function  cart()
    {
          return view('cart');
    }

    public function  checkout()
    {
          return view('checkout');
    }

    public function  contact()
    {
        return view('contact');
    }

    public function  main()
    {
        return view('main');
    }
    
    public function shop_single()
    {
      return view('shop-single');
    }
    public function shop()
    {
        
      return view('shop');
    }
    public function thankyou()
    {
        
      return view('thankyou');
    }


}

