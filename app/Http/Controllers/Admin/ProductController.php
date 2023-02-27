<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        $product=Product::where('Title','LIKE','%'.$search.'%')->orWhere('Function', '=', $search)->paginate(25);
    }else {
        $product = Product::with('category','brand','function','schedule')->orderBy('Title', 'ASC')->paginate(25);
    }
    return view('admin.view_product')->with(compact('product'));
    }

    public function store(Request $req){
    $req->validate([
    'title'=>'required',
    'schedule'=>'required',
    ]);
    $sku_find = Product::where('SKU',$req['sku'])->first();
    if ($sku_find == null) {
        $product = new Product;

        $product->Title = $req['title'];
        $product->SKU = $req['sku'];
        $product->MRP = $req['mrp'];
        $product->Stock = $req['stock'];
        $product->Exp_date = $req['exp_date'];
        $product->Categories_id = $req['category'];
        $product->Brand = $req['brand'];
        $product->Box_No = $req['box_no'];
        $product->Function = $req['function'];
        $product->Generic_name = $req['generic_name'];
        $product->Ingredients = $req['infredients'];
        $product->Schedule = $req['schedule'];
        $product->TripSize = $req['tripsize'];
        $product->Price_unit = $product->MRP/$product->TripSize;
        $product->Description = $req['description'];
        $product->save();
        return redirect()->route('admin.view_product')->with('msg','Product Added!');
    } else {
      
       $product = Product::find($sku_find->id);
       $product->Stock = $sku_find->Stock +  $req['stock'];
       $product->save();
       return redirect()->route('admin.view_product')->with('msg','Stock Updated!');
    }
    
    
    }

    public function delete($id){
    $product = Product::find($id);
    if ($product != null) {
        $product->delete();
    }
    return redirect()->route('admin.view_product')->with('msg-deleted','Product Deleted!');
    }

    function importData(Request $request){

        $the_file = $request->file('uploaded_file');
        try{
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet        = $spreadsheet->getActiveSheet();
            $row_limit    = $sheet->getHighestDataRow();
            $column_limit = $sheet->getHighestDataColumn();
            $row_range    = range( 1, $row_limit );
            $column_range = range( 'F', $column_limit );
            $x=1;
           
            foreach ( $row_range as $row ) {
                if ($x++ >= 2) {
                    $stock= $sheet->getCell( 'E' . $row )->getValue();
                    $sku= $sheet->getCell( 'B' . $row )->getValue();
                    $sku_find = Product::where('SKU', $sku)->first();
                   if ($sku_find==null) {
                    $Product = new Product;
                        $Product->Title = $sheet->getCell( 'A' . $row )->getValue();
                        $Product->SKU = $sheet->getCell( 'B' . $row )->getValue();
                        $Product->MRP = $sheet->getCell( 'C' . $row )->getValue(); 
                        $Product->Stock = $sheet->getCell( 'E' . $row )->getValue();
                        $exp_date =  \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($sheet->getCell( 'F' . $row )->getValue());
                        $Product->Exp_date = $exp_date;
                        $category_find= Category::where('Name',$sheet->getCell( 'G' . $row )->getValue())->first();
                        if ($category_find != null) {
                            $category_id=$category_find->Categories_id;
                        } else {
                            $Category = new Category;
                           
                            $Category->Name = $sheet->getCell( 'G' . $row )->getValue();
                            $Category->save();
                            $category_id = $Category->Categories_id;
                        }
                            $Product->Categories_id = $category_id;
                            $brand_find = Brand::where('Name',$sheet->getCell( 'H' . $row )->getValue())->first();
                            if ($brand_find != null) {
                                $brand_id=$brand_find->id;
                            } else {
                                $brand = new Brand;
                                $brand->Name = $sheet->getCell( 'H' . $row )->getValue();
                                $brand->save();
                                $brand_id = $brand->id;
                            }
        
                            $Product->Brand = $brand_id;
                            $Product->Box_No = $sheet->getCell( 'I' . $row )->getValue();
        
                            $function_find = Med_Function::where('Name',$sheet->getCell( 'J' . $row )->getValue())->first();
                            if ($function_find != null) {
                                $function_id=$function_find->id;
                            } else {
                                $function = new Med_Function;
                                $function->Name = $sheet->getCell( 'J' . $row )->getValue();
                                $function->save();
                                $function_id = $function->id;
                            }
        
                            $Product->Function = $function_id;
                            $Product->Generic_name = $sheet->getCell( 'K' . $row )->getValue();
                            $Product->Ingredients = $sheet->getCell( 'L' . $row )->getValue(); 
        
                            $schedule_find = Schedule::where('Name',$sheet->getCell( 'M' . $row )->getValue())->first();
                            if ($schedule_find != null) {
                                $schedule_id=$schedule_find->id;
                            } else {
                                $schedule = new Schedule;
                                $schedule->Name = $sheet->getCell( 'M' . $row )->getValue();
                                $schedule->save();
                                $schedule_id = $schedule->id;
                            }
                            
                            $Product->Schedule =  $schedule_id ;
                            $Product->TripSize = $sheet->getCell( 'N' . $row )->getValue();
                            $Product->Price_unit = $Product->MRP/$Product->TripSize;
                            $Product->Description = $sheet->getCell( 'O' . $row )->getValue();
                           $Product->save();
                   }else {
                    $product = Product::find($sku_find->id);
                    
                    $product->Stock = $sku_find->Stock + $stock;
                    $product->save();
                }
                    
   
 
                }

            }
           
        } catch (Exception $e) {
            $error_code = $e;
            return back()->with('error','There was a problem uploading the data!');
        }
        return back()->with('import_success','Great! Data has been successfully uploaded.');
    }

    public function edit($id){
    $category = Category::all();
    $brand = brand::all();
    $product = Product::find($id);
    $function = Med_Function::all();
    $schedule = Schedule::all();
    if ($product != null) {  
    return view('admin.update_product')->with(compact('product','category','brand','function','schedule'));
    }
    }

    public function update($id,Request $req){
    $product = Product::find($id);
    $product->Title = $req['title'];
    $product->SKU = $req['bath_no'];
    $product->MRP = $req['mrp'];
    $product->Price_unit = $req['price'];
    $product->Stock = $req['stock'];
    $product->Exp_date = $req['exp_date'];
    $product->Categories_id = $req['category'];
    $product->Brand = $req['brand'];
    $product->Box_No = $req['box_no'];
    $product->Function = $req['function'];
    $product->Generic_name = $req['generic_name'];
    $product->Ingredients = $req['ingredients'];
    $product->Schedule = $req['schedule'];
    $product->TripSize = $req['tripsize'];
    $product->Description = $req['description'];
    $product->save();
    return redirect()->route('admin.view_product');
    }
}
