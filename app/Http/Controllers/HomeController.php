<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use  App\Models\ProductVeriant;
use App\Models\Schedule;

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

    public function upexp(Request $request){
        $Schedule = Schedule::all();
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
    public function lessstock(Request $request){
        $Schedule = Schedule::all();
        $requestData = $request->all();
        $schedule = isset($requestData['schedule']) ? $requestData['schedule'] : 'null';
        $exp_date = isset($requestData['exp_date']) ? $requestData['exp_date'] : null;
        
        if($schedule == 'null' && $exp_date == null){
            $qty = ProductVeriant::join('products', 'products.id', '=', 'product_veriant.pid')
            // ->whereBetween('product_veriant.stock', [0, 5])
            ->get(['product_veriant.*', 'products.Title as product_name']);

            return view('admin.reports_lessstock')->withqty($qty)->withSched($Schedule);
        }elseif($schedule != 'null' && $exp_date == null){
            $qty = ProductVeriant::join('products', 'products.id', '=', 'product_veriant.pid')
            ->whereBetween('product_veriant.stock', [0, 5])
            ->where('products.Schedule', '=', $schedule)
            ->get(['product_veriant.*', 'products.Title as product_name']);

            return view('admin.reports_lessstock')->withqty($qty)->withSched($Schedule);
        }elseif($schedule == 'null' && $exp_date != null){
            $qty = ProductVeriant::join('products', 'products.id', '=', 'product_veriant.pid')
            ->whereBetween('product_veriant.stock', [0, 5])
            ->where('product_veriant.expdate', '=', $exp_date)
            ->get(['product_veriant.*', 'products.Title as product_name']);

            return view('admin.reports_lessstock')->withqty($qty)->withSched($Schedule);
        }else{
            $qty = ProductVeriant::join('products', 'products.id', '=', 'product_veriant.pid')
            ->whereBetween('product_veriant.stock', [0, 5])
            ->where('product_veriant.expdate', '=', $exp_date)
            ->where('products.Schedule', '=', $schedule)
            ->get(['product_veriant.*', 'products.Title as product_name']);

            return view('admin.reports_lessstock')->withqty($qty)->withSched($Schedule);
        }
    }
}

