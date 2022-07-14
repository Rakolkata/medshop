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


class ProductController extends Controller
{
     public function __construct()
    {
       $this->middleware('auth:admin');            
    }


     public function create()
    { 

        $id = Auth::user()->id; 
        $user = Admin::where('id',$id)->first();
        
       return view('admin.product');
    }


    //store product
    public function store(Request $request)
     { 
       $product = new Product;
       $product->gematricName = $request->gematricName;
       $product->brand = $request->brand;
       $product->stock = $request->stock;
       $product->title = $request->title;
       $product->quantity = $request->quantity;
       $product->price = $request->price;
       $product->sellPrice = $request->sellPrice;
       $product->description = $request->description;
        if($request->hasfile('image'))
        {
            $fileNameExt = $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($fileNameExt, PATHINFO_FILENAME);
            $fileExt = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$fileExt;
            $pathToStore = $request->file('image')->storeAs('public/images',$fileNameToStore);
            $product->image=$pathToStore;
        }
       $product->save();
       return redirect()->route('product.create')
       ->with('success','Product has been created successfully.');
       }
     public function getProduct()
    {        
               $query=Product::all();
              return Datatables::of($query)
                    ->addIndexColumn()
                    ->addColumn('action',function($row){
                    $btn = '<a href="#" onclick="myfunction('.$row->id.')";>
                           <span style="color:green;"><i class="fas fa-edit "></i></span></a>'.'&nbsp;<a href="'.route('delete.Product',$row->id).'">
                           <span style="color:red;"><i class="fa fa-trash"></i></span></a>';
                        return $btn;
                    })
                    ->make(true);
    }

     public function deleteProduct(Request $request)
    {
        $com =Product::where('id',$request->id)->delete();
        return back();        
    }

    public function editProduct(Request $request)
     {  
      $id=$request->post('item');
      $item =Product::where('id',$id)->first();      
      if($item!=null)
      {
        return json_encode($item);
      }
      else{
            $flag=false;
        return response()->json(['success'=>$flag]);
      }
   }
   
   public function updateProduct(Request $request) 
   {  
       $product=Product::where('id',$request->id)->first();
       if($request->hasFile('image'))
      {

        if($request->image!=null){
            $imagepath ='storage/app/'.$product->image;
            if(File::exists($imagepath))
            {                    
                File::delete($imagepath);            
            }
        }
        $fileNameExt = $request->file('image')->getClientOriginalName();
        $fileName = pathinfo($fileNameExt, PATHINFO_FILENAME);
        $fileExt = $request->file('image')->getClientOriginalExtension();
        $fileNameToStore = $fileName.'_'.time().'.'.$fileExt;
        $pathToStore = $request->file('image')->storeAs('public/images',$fileNameToStore);
        $product->image=$pathToStore;
      }
       $product->gematricName = $request->gematricName;
       $product->brand = $request->brand;
       $product->stock = $request->stock;
       $product->title = $request->title;
       $product->quantity = $request->quantity;
       $product->price = $request->price;
       $product->sellPrice = $request->sellPrice;
       $product->description = $request->description;
       $result=$product->save();
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
