<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use  App\Models\ProductVeriant;
use App\Models\Schedule;
use  App\Models\Brand;
use  App\Models\Category;
use  App\Models\Med_Function;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


use PhpOffice\PhpSpreadsheet\Reader\Exception;

use PhpOffice\PhpSpreadsheet\Writer\Xls;

use PhpOffice\PhpSpreadsheet\IOFactory;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void 
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('shopkeepar.dashboard');
    }

    public function adminHome()
    {
        $m = date('m');
        $date = date('Y-m-d');
        $beforeday = Carbon::parse($date)->addDays(10)->toDateString();
        $result = DB::table('orders')
            ->select(DB::raw('YEAR(created_at) AS year, MONTH(created_at) AS month, SUM(Total_Order) AS monthly_sale'))
            ->groupBy(DB::raw('YEAR(created_at), MONTH(created_at)'))
            ->orderBy(DB::raw('YEAR(created_at), MONTH(created_at)'))
            ->where('status' , '=' , 'dispatched')->where(DB::raw('MONTH(created_at)'),'=',$m)
            ->get(); 

            $result2 = DB::table(DB::raw('(SELECT 1 AS month UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9 UNION SELECT 10 UNION SELECT 11 UNION SELECT 12) AS months'))
    ->leftJoin('orders', function ($join) {
        $join->on(DB::raw('MONTH(orders.created_at)'), '=', 'months.month')
            ->where('orders.status', '=', 'dispatched')
            ->whereRaw('YEAR(orders.created_at) = ?', [date('Y')]);
    })
    ->select(DB::raw('COALESCE(SUM(orders.Total_Order), 0) AS monthly_sale'))
    ->groupBy('months.month')
    ->orderBy('months.month')
    ->pluck('monthly_sale');






    //   echo $result2;
        

// Iterate over the result and add the previous month sales to each row

//last 5 days 

$exp = ProductVeriant::join('products', 'products.id', '=', 'product_veriant.pid')
    ->whereBetween('product_veriant.expdate', [$date, $beforeday])
    ->get(['product_veriant.*', 'products.Title as product_name']);



$qty = ProductVeriant::join('products', 'products.id', '=', 'product_veriant.pid')
->whereBetween('product_veriant.stock', [0, 5])
->get(['product_veriant.*', 'products.Title as product_name']);

 // $data = DB::table('orders_detail')->select('title','phone','food')->
 return view('admin.dashboard', compact('result'))->withmtm($result2)->withexp($exp)->withqty($qty);
        
}

    public function shopownerHome()
    {
        return view('shopowner.dashboard');
    }

    public function registration_success()
    {

        return view('registration_completed');
    }


  /* old one
    public function upexp(Request $request){
        $Schedule = Schedule::all();
        $brand = Brand::all();
        $m = date('m');
        $date = date('Y-m-d');
        $beforeday = Carbon::parse($date)->addDays(10)->toDateString();
        $requestData = $request->all();
        $schedule = isset($requestData['schedule']) ? $requestData['schedule'] : 'null';
        $exp_date = isset($requestData['exp_date']) ? $requestData['exp_date'] : null;

        if($schedule == 'null' && $exp_date == null){
            $exp = ProductVeriant::join('products', 'products.id', '=', 'product_veriant.pid')
            ->whereBetween('product_veriant.expdate', [$date, $beforeday])
            ->get(['product_veriant.*', 'products.Title as product_name']);
            return view('admin.reports_recentexpairy')->withexp($exp)->withSched($Schedule);
        }elseif($schedule != 'null' && $exp_date == null){
            $exp = ProductVeriant::join('products', 'products.id', '=', 'product_veriant.pid')
            ->whereBetween('product_veriant.expdate', [$date, $beforeday])
            ->where('products.Schedule', '=', $schedule)
            ->get(['product_veriant.*', 'products.Title as product_name']);
            return view('admin.reports_recentexpairy')->withexp($exp)->withSched($Schedule);
        }elseif ($schedule == 'null' && $exp_date != null) {
            $exp = ProductVeriant::join('products', 'products.id', '=', 'product_veriant.pid')
            ->whereBetween('product_veriant.expdate', [$date, $beforeday])
            ->where('product_veriant.expdate', '=', $exp_date)
            ->get(['product_veriant.*', 'products.Title as product_name']);
            return view('admin.reports_recentexpairy')->withexp($exp)->withSched($Schedule);
        }else{
            $exp = ProductVeriant::join('products', 'products.id', '=', 'product_veriant.pid')
            ->whereBetween('product_veriant.expdate', [$date, $beforeday])
            ->where('product_veriant.expdate', '=', $exp_date)
            ->where('products.Schedule', '=', $schedule)
            ->get(['product_veriant.*', 'products.Title as product_name']);
            return view('admin.reports_recentexpairy')->withexp($exp)->withSched($Schedule);
        }
    }

    */


/*


    public function upexp(Request $request){
        $Schedule = Schedule::all();
        $brand = Brand::all();
        $m = date('m');
        $date = date('Y-m-d');
        $beforeday = Carbon::parse($date)->addDays(10)->toDateString();
        $requestData = $request->all();
        $schedule = isset($requestData['schedule']) ? $requestData['schedule'] : 'null';
        $exp_date = isset($requestData['exp_date']) ? $requestData['exp_date'] : null;
        $selectedBrand = isset($requestData['brand']) ? $requestData['brand'] : 'null';

        if($schedule == 'null' && $exp_date == null && $selectedBrand == 'null'){
            $exp = ProductVeriant::join('products', 'products.id', '=', 'product_veriant.pid')
            ->whereBetween('product_veriant.expdate', [$date, $beforeday])
            ->get(['product_veriant.*', 'products.Title as product_name']);
            return view('admin.reports_recentexpairy')->withexp($exp)->withSched($Schedule)->withbrand($selectedBrand);
        }elseif($schedule != 'null' && $exp_date == null && $selectedBrand == 'null'){
            $exp = ProductVeriant::join('products', 'products.id', '=', 'product_veriant.pid')
            ->whereBetween('product_veriant.expdate', [$date, $beforeday])
            ->where('products.Schedule', '=', $schedule)
            ->get(['product_veriant.*', 'products.Title as product_name']);
            return view('admin.reports_recentexpairy')->withexp($exp)->withSched($Schedule)->withbrand($selectedBrand);
        }elseif ($schedule == 'null' && $exp_date != null && $selectedBrand == 'null') {
            $exp = ProductVeriant::join('products', 'products.id', '=', 'product_veriant.pid')
            ->whereBetween('product_veriant.expdate', [$date, $beforeday])
            ->where('product_veriant.expdate', '=', $exp_date)
            ->get(['product_veriant.*', 'products.Title as product_name']);
            return view('admin.reports_recentexpairy')->withexp($exp)->withSched($Schedule)->withbrand($selectedBrand);
        }elseif ($schedule == 'null' && $exp_date == null && $selectedBrand != 'null') {
            $exp = ProductVeriant::join('products', 'products.id', '=', 'product_veriant.pid')
            ->whereBetween('product_veriant.expdate', [$date, $beforeday])
            ->where('products.Brand', '=', $selectedBrand)
            ->get(['product_veriant.*', 'products.Title as product_name']);
            return view('admin.reports_recentexpairy')->withexp($exp)->withSched($Schedule)->withbrand($selectedBrand);
        }elseif ($schedule != 'null' && $exp_date != null && $selectedBrand == 'null') {
            $exp = ProductVeriant::join('products', 'products.id', '=', 'product_veriant.pid')
            ->whereBetween('product_veriant.expdate', [$date, $beforeday])
            ->where('product_veriant.expdate', '=', $exp_date)
            ->where('products.Schedule', '=', $schedule)
            ->get(['product_veriant.*', 'products.Title as product_name']);
            return view('admin.reports_recentexpairy')->withexp($exp)->withSched($Schedule)->withbrand($selectedBrand);
        }elseif ($schedule != 'null' && $exp_date == null && $selectedBrand != 'null') {
            $exp = ProductVeriant::join('products', 'products.id', '=', 'product_veriant.pid')
            ->whereBetween('product_veriant.expdate', [$date, $beforeday])
            ->where('products.Schedule', '=', $schedule)
            ->where('products.Brand', '=', $selectedBrand)
            ->get(['product_veriant.*', 'products.Title as product_name']);
            return view('admin.reports_recentexpairy')->withexp($exp)->withSched($Schedule)->withbrand($selectedBrand);
        }elseif ($schedule == 'null' && $exp_date != null && $selectedBrand != 'null') {
            $exp = ProductVeriant::join('products', 'products.id', '=', 'product_veriant.pid')
            ->whereBetween('product_veriant.expdate', [$date, $beforeday])
            ->where('product_veriant.expdate', '=', $exp_date)
            ->where('products.Brand', '=', $selectedBrand)
            ->get(['product_veriant.*', 'products.Title as product_name']);
            return view('admin.reports_recentexpairy')->withexp($exp)->withSched($Schedule)->withbrand($selectedBrand);
        }else{
            $exp = ProductVeriant::join('products', 'products.id', '=', 'product_veriant.pid')
            ->whereBetween('product_veriant.expdate', [$date, $beforeday])
            ->where('product_veriant.expdate', '=', $exp_date)
            ->where('products.Schedule', '=', $schedule)
            ->where('products.Brand', '=', $selectedBrand)
            ->get(['product_veriant.*', 'products.Title as product_name']);
            return view('admin.reports_recentexpairy')->withexp($exp)->withSched($Schedule)->withbrand($selectedBrand);
        }
    }


*/



    
    public function upexp(Request $request)
    {
        $schedules = Schedule::all();
        $brands = Brand::all();
        $m = date('m');
        $date = date('Y-m-d');
        $beforeday = Carbon::parse($date)->addDays(10)->toDateString();
        $requestData = $request->all();
        $schedule = isset($requestData['schedule']) ? $requestData['schedule'] : 'null';
        $exp_date = isset($requestData['exp_date']) ? $requestData['exp_date'] : null;
        $selectedBrand = isset($requestData['brand']) ? $requestData['brand'] : 'null';
    
        $query = ProductVeriant::join('products', 'products.id', '=', 'product_veriant.pid')
            ->whereBetween('product_veriant.expdate', [$date, $beforeday]);
    
        if ($schedule != 'null') {
            $query->where('products.Schedule', '=', $schedule);
        }
    
        if ($exp_date != null) {
            $query->where('product_veriant.expdate', '=', $exp_date);
        }
    
        if ($selectedBrand != 'null') {
            // Assuming Brand is the correct column name for brand information
            $query->where('products.Brand', '=', $selectedBrand);
        }
    
        $exp = $query->select('products.Title as product_name', 'product_veriant.expdate', 'product_veriant.stock', 'product_veriant.batch')
            ->get();
    
        return view('admin.reports_recentexpairy')
            ->with('exp', $exp)
            ->with('schedules', $schedules)
            ->with('brands', $brands);
    }




/* old one

    public function lessstock(Request $request){
        $Schedule = Schedule::all();
        $brands = Brand::all();
        $requestData = $request->all();
        $schedule = isset($requestData['schedule']) ? $requestData['schedule'] : 'null';
        $exp_date = isset($requestData['exp_date']) ? $requestData['exp_date'] : null;
      
        if($schedule == 'null' && $exp_date == null){
            $qty = ProductVeriant::join('products', 'products.id', '=', 'product_veriant.pid')
            // ->whereBetween('product_veriant.stock', [0, 5])
            ->paginate(10,['product_veriant.*', 'products.Title as product_name']);

            return view('admin.reports_lessstock')->withqty($qty)->withSched($Schedule);
        }elseif($schedule != 'null' && $exp_date == null){
            $qty = ProductVeriant::join('products', 'products.id', '=', 'product_veriant.pid')
            ->whereBetween('product_veriant.stock', [0, 5])
            ->where('products.Schedule', '=', $schedule)
            ->paginate(10,['product_veriant.*', 'products.Title as product_name']);

            return view('admin.reports_lessstock')->withqty($qty)->withSched($Schedule);
        }elseif($schedule == 'null' && $exp_date != null){
            $qty = ProductVeriant::join('products', 'products.id', '=', 'product_veriant.pid')
            ->whereBetween('product_veriant.stock', [0, 5])
            ->where('product_veriant.expdate', '=', $exp_date)
            ->paginate(10,['product_veriant.*', 'products.Title as product_name']);

            return view('admin.reports_lessstock')->withqty($qty)->withSched($Schedule);
        }else{
            $qty = ProductVeriant::join('products', 'products.id', '=', 'product_veriant.pid')
            ->whereBetween('product_veriant.stock', [0, 5])
            ->where('product_veriant.expdate', '=', $exp_date)
            ->where('products.Schedule', '=', $schedule)
            ->paginate(10,['product_veriant.*', 'products.Title as product_name']);

            return view('admin.reports_lessstock')->withqty($qty)->withSched($Schedule);
        }
    }

*/


/*
public function lessstock(Request $request){
    $Schedule = Schedule::all();
    $brands = Brand::all();
    $requestData = $request->all();
    $schedule = isset($requestData['schedule']) ? $requestData['schedule'] : 'null';
    $exp_date = isset($requestData['exp_date']) ? $requestData['exp_date'] : null;
    $selectedBrand = isset($requestData['brand']) ? [$requestData['brand']] : [];

    if($schedule == 'null' && $exp_date == null && $selectedBrand != []){
        $qty = ProductVeriant::join('products', 'products.id', '=', 'product_veriant.pid')
        ->Join('brands', 'brands.id', '=', 'products.Brand')
        ->where('brands.name', '=', $selectedBrand)
        ->whereBetween('product_veriant.stock', [0, 5])
        ->paginate(10,['product_veriant.*', 'products.Title as product_name']);

        return view('admin.reports_lessstock')->withqty($qty)->withSched($Schedule)->withbrands($selectedBrand);
    }elseif($schedule != 'null' && $exp_date == null && $selectedBrand == []){
        $qty = ProductVeriant::join('products', 'products.id', '=', 'product_veriant.pid')
        ->Join('brands', 'brands.id', '=', 'products.Brand')
        ->whereBetween('product_veriant.stock', [0, 5])
        ->where('products.Schedule', '=', $schedule)
        ->paginate(10,['product_veriant.*', 'products.Title as product_name']);

        return view('admin.reports_lessstock')->withqty($qty)->withSched($Schedule)->withbrands($selectedBrand);
    }elseif($schedule == 'null' && $exp_date != null && $selectedBrand == []){
        $qty = ProductVeriant::join('products', 'products.id', '=', 'product_veriant.pid')
        ->Join('brands', 'brands.id', '=', 'products.Brand')
        ->whereBetween('product_veriant.stock', [0, 5])
        ->where('product_veriant.expdate', '=', $exp_date)
        ->paginate(10,['product_veriant.*', 'products.Title as product_name']);

        return view('admin.reports_lessstock')->withqty($qty)->withSched($Schedule)->withbrands($selectedBrand);
    }else{
        $qty = ProductVeriant::join('products', 'products.id', '=', 'product_veriant.pid')
        ->Join('brands', 'brands.id', '=', 'products.Brand')
        ->whereBetween('product_veriant.stock', [0, 5])
        ->where('product_veriant.expdate', '=', $exp_date)
        ->where('products.Schedule', '=', $schedule)
        ->paginate(10,['product_veriant.*', 'products.Title as product_name']);

        return view('admin.reports_lessstock')->withqty($qty)->withSched($Schedule)->withbrands($selectedBrand);
    }
}


*/






public function lessstock(Request $request)
{
    $brands = Brand::all();
    $Schedule = Schedule::all();
    $Category = Category::all();
    $Function = Med_Function::all(); 
    $requestData = $request->all();
    $schedule = isset($requestData['schedule']) ? $requestData['schedule'] : 'null';
    $exp_date = isset($requestData['exp_date']) ? $requestData['exp_date'] : null;
    $selectedBrand = isset($requestData['brand']) ? $requestData['brand'] : 'null';
    $selectedCategory = isset($requestData['category']) ? $requestData['category'] : 'null';
    $selectedFunction = isset($requestData['function']) ? $requestData['function'] : 'null'; 
    $query = ProductVeriant::join('products', 'products.id', '=', 'product_veriant.pid')
        ->join('brands', 'brands.id', '=', 'products.Brand')
        ->join('categories', 'categories.Categories_id', '=', 'products.Categories_id')
        ->join('Med__functions', 'Med__functions.id', '=', 'products.Function')
        ->whereBetween('product_veriant.stock', [0, 30]);
    
    if ($selectedBrand != 'null') {
        $query->where('brands.Name', '=', $selectedBrand);
    }

    if ($selectedCategory != 'null') {
        $query->where('categories.name', '=', $selectedCategory);
    }

    if ($selectedFunction != 'null') {
        $query->where('functions.name', '=', $selectedFunction);
    }

    if ($schedule != 'null') {
        $query->where('products.Schedule', '=', $schedule);
    }

    if ($exp_date != null) {
        $query->where('product_veriant.expdate', '=', $exp_date);
    }

    $qty = $query->select('product_veriant.*', 'products.Title as product_name')
        ->paginate(10);

    return view('admin.reports_lessstock')
        ->with('qty', $qty)
        ->with('Sched', $Schedule)
        ->with('brands', $brands)
        ->with('categories', $Category)
        ->with('functions', $Function);
}


}


