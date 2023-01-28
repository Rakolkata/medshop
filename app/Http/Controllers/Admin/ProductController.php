<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\Category;
use  App\Models\Brand; 
use  App\Models\Med_Function;
use  App\Models\Schedule;  
use  App\Models\Product;

class ProductController extends Controller
{
    public function index(){
    $category = Category::all();
    $brand = Brand::all();
    $function = Med_Function::all();
    $schedule = Schedule::all();
    return view('admin.add_product')->with(compact('category','brand','function','schedule'));
    }
    public function view(Request $req){
    $search=$req['search'] ??"";
    if ($search !="") {
        $product=Product::where('Title','=',$search)->orWhere('Function', '=', $search)->get();
    }else {
        $product = Product::with('category','brand','function','schedule')->get();
    }
    return view('admin.view_product')->with(compact('product'));
    }

    public function store(Request $req){
    $product = new Product;
    $product->Title = $req['title'];
    $product->SKU = $req['sku'];
    $product->MRP = $req['mrp'];
    $product->Price_unit = $req['price'];
    $product->Stock = $req['stock'];
    $product->Exp_date = $req['exp_date'];
    $product->Categories_id = $req['category'];
    $product->Brand = $req['brand'];
    $product->Box_No = $req['box_no'];
    $product->Function = $req['function'];
    $product->Generic_name = $req['generic_name'];
    $product->Ingredients = $req['infredients'];
    $product->Schedule = $req['schedule'];
    $product->Description = $req['description'];
    $product->Categories_id;
    $product->Title;
    $product->save();
    return redirect()->route('admin.view_product')->with('msg','Product Added!');
    }

    public function delete($id){
    $product = Product::find($id);
    if ($product != null) {
        $product->delete();
    }
    return redirect()->route('admin.view_product')->with('msg-deleted','Product Deleted!');
    }
}
