<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\IOFactory;
use  App\Models\Category;
use  App\Models\Brand;
use  App\Models\Med_Function;
use  App\Models\Schedule;
use  App\Models\Product;
use Carbon\Carbon;
use  App\Models\ProductVeriant;
use  App\Models\IncomingInvoice;

 
class ProductController extends Controller
{
    public function index()
    {
        $category = Category::all();
        $brand = Brand::all();
        $function = Med_Function::all();
        $schedule = Schedule::all();
        return view('admin.add_product')->with(compact('category', 'brand', 'function', 'schedule'));
//   dev
//     }
//     public function view(Request $req)
//     {
//         $search = $req['search'] ?? "";
//         if ($search != "") {
//             $product = Product::where('Title', 'LIKE', '%' . $search . '%')->orWhere('Function', '=', $search)->paginate(5);
//         } else {
//             $product = Product::with('category', 'brand', 'function', 'schedule')->orderBy('Title', 'ASC')->paginate(5);
//         }
//         return view('admin.view_product')->with(compact('product'));
//     }

//     public function store(Request $req)
//     {
//         $req->validate([
//             'title' => 'required',
//             'schedule' => 'required',
//         ]);
//         //$sku_find = Product::where('SKU', $req['sku'])->first();
//         //if ($sku_find == null) {
//             $product = new Product;

//             $product->Title = $req['title'];
//             // $product->MRP = $req['mrp'];
//             $product->Categories_id = $req['category'];
//             $product->Brand = $req['brand'];
//             $product->Box_No = $req['box_no'];
//             $product->Function = $req['function'];
//             $product->Generic_name = $req['generic_name'];
//             $product->Ingredients = $req['infredients'];
//             $product->Schedule = $req['schedule'];
//             // $product->SKU = $req['sku'];
//             // $product->Stock = $req['stock'];
//             // $product->Exp_date = $req['exp_date'];
//            // $product->TripSize = $req['packsize'];
//             // if ($product->TripSize == null) {
//             //     $product->Price_unit = 0;
//             // } else {
//             //     $product->Price_unit = $product->MRP / $product->TripSize;
//             // }
//             $product->Description = $req['description'];
//             $product->save();
//             return redirect()->route('admin.view_product')->with('msg', 'Product Added!');
//        // } 
//         // else {

//         //     $product = Product::find($sku_find->id);
//         //     $product->Stock = $sku_find->Stock +  $req['stock'];
//         //     $product->save();
//         //     return redirect()->route('admin.view_product')->with('msg', 'Stock Updated!');
            
//         // }
//     } 

//   production
    }
    public function view(Request $req)
    {
        $search = $req['search'] ?? "";
        if ($search != "") {

            $product = Product::select('*')
            ->with('category', 'brand', 'function', 'schedule', 'ProductVeriant')
            ->where('products.Title', 'like', "{$search}%")
            ->orderBy('products.Title', 'asc')
            ->paginate(25);

           
           

        } else {

            $product = Product::select('*')->with('category', 'brand', 'function', 'schedule','ProductVeriant')->orderBy('products.Title', 'asc')->paginate(25);
            
        }
        // print_r($product);
        return view('admin.view_product')->with(compact('product'));
      
    }

    public function store(Request $req)
    {
        // dd($req->all());
        $req->validate([
            'title' => 'required',
            'schedule' => 'required',
        ]);
        // $sku_find = Product::where('SKU', $req['sku'])->first();
        // if ($sku_find == null) {// we have to work here

               if( $req['brand_id'] == null){
                $brand_name=$req['brand'];
                $existing_brand = Brand::where('Name', $brand_name)->first();
                if ($existing_brand) {
                    $brand_id = $existing_brand->id;
                } else {
                    $brand = new Brand();
                    $brand->Name = $brand_name;
                    $brand->save();
                    $brand_id = intval($brand->id);
                }
               }else{
               $brand_id=intval($req['brand_id']);
               }
                if( $req['function_id'] == null){
                    $function_name=$req['function'];
                    $existing_function = Med_Function::where('Name', $function_name)->first();

                    if ($existing_function) {
                        $function_id = $existing_function->id;
                    } else {
                        $function = new Med_Function();
                        $function->Name = $function_name;
                        $function->save();
                        $function_id = intval($function->id);
                    }

                   
                
                   }else{
                   $function_id=intval($req['function_id']);
                   }

            $product = new Product; 

            $product->Title = $req['title'];
            // $product->MRP = $req['mrp'];
            $product->Categories_id = $req['category'];
            $product->Brand = $brand_id;
            $product->Box_No = $req['box_no'];
            $product->Function = $function_id;
            $product->Generic_name = $req['generic_name'];
            $product->Ingredients = $req['infredients'];
            $product->Schedule = $req['schedule'];
            // $product->SKU = $req['sku'];
            // $product->Stock = $req['stock'];
            // $product->Exp_date = $req['exp_date'];
             //$product->TripSize = $req['packsize'];
            // if ($product->TripSize == null) {
            //     $product->Price_unit = 0;
            // } else {
            //     $product->Price_unit = $product->MRP / $product->TripSize;
            // }
            $product->Description = $req['description'];
            $product->save();

            $newProductId = $product->id; 

            foreach($req['batch'] as $i=>$pv ) {
                if(isset($req['vid'][$i])){
                    $productvariant = ProductVeriant::find($req['vid'][$i]);
                    if($req['batch'][$i]){
    
                        $productvariant->batch = $req['batch'][$i];
                        $productvariant->stock	 = $req['stock'][$i];
                        $productvariant->expdate = $req['expdate'][$i];
                        $productvariant->mrp_per_unit = $req['mrp'][$i];
                        $productvariant->strip = $req['strip'][$i];
                        $product->TripSize= $req['strip'][$i];
                        $productvariant->rate = $req['rate'][$i];
                        $productvariant->remarks = $req['remarks'][$i];
                        $productvariant->save();
                    }else{
                        $productvariant->delete();
                    }
     
                }else{
                    if(isset($req['batch'][$i]) && $req['batch'][$i]!=''){
    
                        $productvariant = new ProductVeriant;
                        $productvariant->batch = $req['batch'][$i];
                        $productvariant->stock	 = $req['stock'][$i];
                        $productvariant->expdate = $req['expdate'][$i];
                        $productvariant->mrp_per_unit = $req['mrp'][$i];
                        $productvariant->strip = $req['strip'][$i];
                        $product->TripSize= $req['strip'][$i];
                        $productvariant->rate = $req['rate'][$i];
                        $productvariant->remarks = $req['remarks'][$i];
                        $productvariant->pid = $newProductId;
                        $productvariant->save();
                    }
                }

        
        }
        $product->save();




        return redirect()->route('admin.view_product')->with('msg', 'Product Added!');
       
    }

    public function delete($id, Request $request)
    {   $productVerients = ProductVeriant::where('pid', $id)->get();
        foreach ($productVerients as $productVerient) {
            if($productVerient->count() > 0)
            $productVerient->delete();
        }
        
        // Step 2: Delete the Product model with the given $id
        $product = Product::find($id);
        if ($product != null) {
            $product->delete();
        }
        // return redirect()->route('admin.view_product', ['page' => $request->get('page')])->with('msg-deleted', $product->Title.' Deleted!');
        return redirect()->back(); 
    }

    function importData(Request $request)
    {

        $the_file = $request->file('uploaded_file');
        try {
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet        = $spreadsheet->getActiveSheet();
            $row_limit    = $sheet->getHighestDataRow();
            $column_limit = $sheet->getHighestDataColumn();
            $row_range    = range(1, $row_limit);
            $column_range = range('F', $column_limit);
            $x = 1;

            foreach ($row_range as $row) {
                if ($x++ >= 2) {
                    $stock = $sheet->getCell('E' . $row)->getValue();
                    $sku = $sheet->getCell('B' . $row)->getValue();
                    $sku_find = Product::where('SKU', $sku)->first();
                    if ($sku_find == null) {
                        $Product = new Product;
                        $Product->Title = $sheet->getCell('A' . $row)->getValue();
                        $Product->SKU = $sheet->getCell('B' . $row)->getValue();
                        $Product->MRP = $sheet->getCell('C' . $row)->getValue();
                        $Product->Stock = $sheet->getCell('E' . $row)->getValue();
                        // $exp_date =  \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($sheet->getCell( 'F' . $row )->getValue());
                        $exp_date = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($sheet->getCell('F' . $row)->getValue()));

                        $Product->Exp_date = $exp_date;
                        $category_find = Category::where('Name', $sheet->getCell('G' . $row)->getValue())->first();
                        if ($category_find != null) {
                            $category_id = $category_find->Categories_id;
                        } else {
                            $Category = new Category;

                            $Category->Name = $sheet->getCell('G' . $row)->getValue();
                            $Category->save();
                            $category_id = $Category->Categories_id;
                        }
                        $Product->Categories_id = $category_id;
                        $brand_find = Brand::where('Name', $sheet->getCell('H' . $row)->getValue())->first();
                        if ($brand_find != null) {
                            $brand_id = $brand_find->id;
                        } else {
                            $brand = new Brand;
                            $brand->Name = $sheet->getCell('H' . $row)->getValue();
                            $brand->save();
                            $brand_id = $brand->id;
                        }

                        $Product->Brand = $brand_id;
                        $Product->Box_No = $sheet->getCell('I' . $row)->getValue();

                        $function_find = Med_Function::where('Name', $sheet->getCell('J' . $row)->getValue())->first();
                        if ($function_find != null) {
                            $function_id = $function_find->id;
                        } else {
                            $function = new Med_Function;
                            $function->Name = $sheet->getCell('J' . $row)->getValue();
                            $function->save();
                            $function_id = $function->id;
                        }
//   dev

//                         $Product->Function = $function_id;
//                         $Product->Generic_name = $sheet->getCell('K' . $row)->getValue();
//                         $Product->Ingredients = $sheet->getCell('L' . $row)->getValue();

//                         $schedule_find = Schedule::where('Name', $sheet->getCell('M' . $row)->getValue())->first();
//                         if ($schedule_find != null) {
//                             $schedule_id = $schedule_find->id;
//                         } else {
//                             $schedule = new Schedule;
//                             $schedule->Name = $sheet->getCell('M' . $row)->getValue();
//                             $schedule->save();
//                             $schedule_id = $schedule->id;
//                         }

//                         $Product->Schedule =  $schedule_id;
//                         $Product->TripSize = $sheet->getCell('N' . $row)->getValue();
//                         $Product->Price_unit = $Product->MRP / $Product->TripSize;
//                         $Product->Description = $sheet->getCell('O' . $row)->getValue();
//                         $Product->save();
//                     } else {
//                         $product = Product::find($sku_find->id);


//   production

                        $Product->Function = $function_id;
                        $Product->Generic_name = $sheet->getCell('K' . $row)->getValue();
                        $Product->Ingredients = $sheet->getCell('L' . $row)->getValue();

                        $schedule_find = Schedule::where('Name', $sheet->getCell('M' . $row)->getValue())->first();
                        if ($schedule_find != null) {
                            $schedule_id = $schedule_find->id;
                        } else {
                            $schedule = new Schedule;
                            $schedule->Name = $sheet->getCell('M' . $row)->getValue();
                            $schedule->save();
                            $schedule_id = $schedule->id;
                        }

                        $Product->Schedule =  $schedule_id;
                        $Product->TripSize = $sheet->getCell('N' . $row)->getValue();
                        $Product->Price_unit = $Product->MRP / $Product->TripSize;
                        $Product->Description = $sheet->getCell('O' . $row)->getValue();
                        $Product->save();
                    } else {
                        $product = Product::find($sku_find->id);

                        $product->Stock = $sku_find->Stock + $stock;
                        $product->save();
                    }
                }
            }
        } catch (Exception $e) {
            $error_code = $e;
            return back()->with('error', 'There was a problem uploading the data!');
        }
        return back()->with('import_success', 'Great! Data has been successfully uploaded.');
    }

    public function edit($id) 
    {
        // $category = Category::all();
        // $brand = brand::all();
        // $product = Product::find($id);
        // $function = Med_Function::all();
        // $schedule = Schedule::all();
        // Assuming $id is the product_id you want to find related records for
            $product = Product::find($id);

           $category = Category::all();

            // Fetching related records from Brand
            $brand = Brand::where('id',$product->Brand)->get();

            // Fetching related records from Med_Function
            $function = Med_Function::where('id',$product->Function)->get();

            // Fetching related records from Schedule
            // $schedule = Schedule::where('id',$product->Schedule)->get();
            $schedule = Schedule::all();
        if ($product != null) {
            return view('admin.update_product')->with(compact('product', 'category', 'brand', 'function', 'schedule'));
        }else{
            echo"product not found";
        }

        // echo $schedule;
        
      
    }

    public function update($id, Request $req)
    {
    
        $page = $req['page'];
        if( $req['brand_id'] == null){
            $brand_name=$req['brand'];
            $existing_brand = Brand::where('Name', $brand_name)->first();
            if ($existing_brand) {
                $brand_id = $existing_brand->id;
            } else {
                $brand = new Brand();
                $brand->Name = $brand_name;
                $brand->save();
                $brand_id = intval($brand->id);
            }
           }else{
           $brand_id=intval($req['brand_id']);
           }
            if( $req['function_id'] == null){
                $function_name=$req['function'];
                $existing_function = Med_Function::where('Name', $function_name)->first();

                if ($existing_function) {
                    $function_id = $existing_function->id;
                } else {
                    $function = new Med_Function();
                    $function->Name = $function_name;
                    $function->save();
                    $function_id = intval($function->id);
                }

               
            
               }else{
               $function_id=intval($req['function_id']);
               }
        $product = Product::find($id);
        $product->Title = $req['title'];
        $product->Categories_id = $req['category'];
        $product->Brand = $brand_id;
        $product->Box_No = $req['box_no'];
        $product->Function = $function_id;
        $product->Generic_name = $req['generic_name'];
        $product->Ingredients = $req['ingredients'];
        $product->Schedule = $req['schedule'];
        $product->Description = $req['description'];
        // $product->SKU = $req['bath_no'];
        // $product->MRP = $req['mrp'];
        // $product->Price_unit = $req['mrp'] / $req['packsize'];
        // $product->Stock = $req['stock']; 
        // $product->Exp_date = $req['exp_date'];
         $product->TripSize = $req['packsize'];
        //$product->Price_unit = $product->MRP/$product->TripSize;
        $product->save();
        // //return redirect()->back('admin.view_product', ['page' => $page])->with('msg', 'Product updated!');
        // //return redirect()->route('admin.view_product')->with('msg', 'Product updated!');

        //  //return redirect()->back('admin.view_product', ['page' => $page])->with('msg', 'Product updated!');

        foreach($req['batch'] as $i=>$pv ) {
            if(isset($req['vid'][$i])){
                $productvariant = ProductVeriant::find($req['vid'][$i]);
                if($req['batch'][$i]){

                    $productvariant->batch = $req['batch'][$i];
                    $productvariant->stock	 = $req['stock'][$i];
                    $productvariant->expdate = $req['expdate'][$i];
                    $productvariant->mrp_per_unit = $req['mrp'][$i];
                    $productvariant->strip = $req['strip'][$i];
                    $product->TripSize = $req['strip'][$i];
                    $productvariant->rate = $req['rate'][$i];
                    $productvariant->remarks = $req['remarks'][$i];
                    $productvariant->save();
                }else{
                    $productvariant->delete();
                }
 
            }else{
                if(isset($req['batch'][$i]) && $req['batch'][$i]!=''){

                    $productvariant = new ProductVeriant;
                    $productvariant->batch = $req['batch'][$i];
                    $productvariant->stock	 = $req['stock'][$i];
                    $productvariant->expdate = $req['expdate'][$i];
                    $productvariant->mrp_per_unit = $req['mrp'][$i];
                    $productvariant->strip = $req['strip'][$i];
                    $product->TripSize = $req['strip'][$i];
                    $productvariant->rate = $req['rate'][$i];
                    $productvariant->remarks = $req['remarks'][$i];
                    $productvariant->pid = $req['pid'];
                    $productvariant->save();
                }
            }
    }
    $product->save();
    return redirect()->route('admin.view_product', ['page' => $page])->with('msg', 'Product updated!');
}
    
    public function search(Request $request)
    {
        $query = $request->get('query');

        if (strlen($query) >= 3) {
            $results = Product::select('products.*')
    ->with('category', 'brand', 'function', 'schedule', 'ProductVeriant')
    ->join('product_veriant', 'products.id', '=', 'product_veriant.pid')
    ->where('products.Title', 'like', "{$query}%")
    ->get();

        
            
        } else {
            $results = [];
        }

        return response()->json($results);
    }

    public function incoming_invoice(){
        return view('admin.incoming_invoice');
    }

    public function incoming_invoice_list(){
        $data = IncomingInvoice::get();

        return response()->json($data);
    }

    public function incoming_invoice_store(Request $req){

        $invoice_no = $req->invoice_id;
        $order_date = $req->order_date;
        $total_amount = $req->total_amount;
        $total_gst = $req->total_gst;
        
        $inv = new IncomingInvoice;
        $inv->invoice_no = $invoice_no;
        $inv->order_date = date("Y-m-d", strtotime($order_date));
        $inv->total_gst = $total_gst;
        $inv->total_amount = $total_amount;
        $inv->save();

        return response()->json($req);


    }
}
