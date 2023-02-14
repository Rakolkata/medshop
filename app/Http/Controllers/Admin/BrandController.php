<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    public function index(){
     return view('admin.add_brand');
    }

    public function view(){
    $brand = Brand::paginate(25);
    return view('admin.view_brand')->with(compact('brand'));
    }
    public function store(Request $req){
    $req->validate([
    'name'=>'required|unique:brands'
    ]);
    echo $req['name'];
    $brand = new Brand;
    $brand->Name = $req['name'];
    $brand->save();
    return redirect()->route('admin.view_brand')->with('msg','Brand Added!');


    }

    public function delete($id){
    $brand = Brand::find($id);
    if ($brand != null) {
        $brand->delete();
    }
    return redirect()->back()->with('msg-dleted','Brand Deleted!');
    }
}
