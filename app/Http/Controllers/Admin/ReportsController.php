<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Schedule;
use  App\Models\Product;
use App\Models\ProductVeriant;
use  App\Models\Order;

class ReportsController extends Controller
{
    public function index()
    {
        $Schedule = Schedule::all();
        return view('admin.reports')->with(compact('Schedule'));
        
    }

    public function export(Request $request)
    {
    $Schedules = Schedule::all();  
    $requestData = $request->all();
    $token = $requestData['_token'];
    $Schedule = $requestData['schedule'];
    $exp_date = $requestData['exp_date'];
    $dm = $requestData['day_month'];

    //check

    if($Schedule != 'null' && $exp_date == null && $dm == 'null'){
    $sdata = Product::join('product_veriant', 'products.id', '=', 'product_veriant.pid')
    ->where('products.Schedule', '=', $Schedule)
    ->select('products.*', 'product_veriant.stock', 'product_veriant.batch')
    ->get();
        return view('admin.reports_exports')->withschedule($sdata)->withexp('false')->withdm('false')->withSched($Schedules);
    }
    elseif ($Schedule != 'null' && $exp_date != null && $dm == 'null') {
        $sdata = Product::join('product_veriant', 'products.id', '=', 'product_veriant.pid')
    ->where('products.Schedule', '=', $Schedule)
    ->select('products.*', 'product_veriant.stock', 'product_veriant.batch')
    ->get();
        $edata = Product::join('product_veriant', 'products.id', '=', 'product_veriant.pid')
      ->where('Exp_date','=',$exp_date)
      ->select('products.*', 'product_veriant.stock', 'product_veriant.batch')
      ->get();
        return view('admin.reports_exports')->withschedule($sdata)->withexp($edata)->withdm('false')->withSched($Schedules);
    }elseif ($Schedule != 'null' && $exp_date != null && $dm != 'null') {
        $sdata = Product::join('product_veriant', 'products.id', '=', 'product_veriant.pid')
    ->where('products.Schedule', '=', $Schedule)
    ->select('products.*', 'product_veriant.stock', 'product_veriant.batch')
    ->get();
        $edata = Product::join('product_veriant', 'products.id', '=', 'product_veriant.pid')
      ->where('Exp_date','=',$exp_date)
      ->select('products.*', 'product_veriant.stock', 'product_veriant.batch')
      ->get();
        if($dm == '1'){
            $date = date('Y-m-d');
            $orders = Order::where('orders.created_at',$date)->join('order__user__profiles', 'orders.Profile_id', '=', 'order__user__profiles.id')
            ->join('users', 'order__user__profiles.User_id', '=', 'users.id')
            ->select('orders.*', 'users.name as cname')->get();
            return view('admin.reports_exports')->withschedule($sdata)->withexp($edata)->withdm($orders)->withSched($Schedules);
        }else{
            $date = date('Y-m-d');
            $beforeOneMonth = \Carbon\Carbon::parse($date)->subMonth()->toDateString();
            $orders = Order::whereBetween('orders.created_at', [$beforeOneMonth, $date])->join('order__user__profiles', 'orders.Profile_id', '=', 'order__user__profiles.id')
    ->join('users', 'order__user__profiles.User_id', '=', 'users.id')
    ->select('orders.*', 'users.name as cname')->get();
            return view('admin.reports_exports')->withschedule($sdata)->withexp($edata)->withdm($orders)->withSched($Schedules);
        }
    }elseif ($Schedule == 'null' && $exp_date != null && $dm == 'null') {
      
        $edata = Product::join('product_veriant', 'products.id', '=', 'product_veriant.pid')
      ->where('Exp_date','=',$exp_date)
      ->select('products.*', 'product_veriant.stock', 'product_veriant.batch')
      ->get();
        return view('admin.reports_exports')->withschedule('false')->withexp($edata)->withdm('false')->withSched($Schedules);
       
    }elseif ($Schedule == 'null' && $exp_date != null && $dm != 'null') {
        $edata = Product::join('product_veriant', 'products.id', '=', 'product_veriant.pid')
      ->where('Exp_date','=',$exp_date)
      ->select('products.*', 'product_veriant.stock', 'product_veriant.batch')
      ->get();
        if($dm == '1'){
            $date = date('Y-m-d');
            $orders = Order::where('orders.created_at',$date)->join('order__user__profiles', 'orders.Profile_id', '=', 'order__user__profiles.id')
            ->join('users', 'order__user__profiles.User_id', '=', 'users.id')
            ->select('orders.*', 'users.name as cname')->get();
            return view('admin.reports_exports')->withschedule('false')->withexp($edata)->withdm($orders)->withSched($Schedules);
        }else{
            $date = date('Y-m-d');
            $beforeOneMonth = \Carbon\Carbon::parse($date)->subMonth()->toDateString();
            $orders = Order::whereBetween('orders.created_at', [$beforeOneMonth, $date])->join('order__user__profiles', 'orders.Profile_id', '=', 'order__user__profiles.id')
            ->join('users', 'order__user__profiles.User_id', '=', 'users.id')
            ->select('orders.*', 'users.name as cname')->get();
            return view('admin.reports_exports')->withschedule('false')->withexp($edata)->withdm($orders)->withSched($Schedules);
        }
    }elseif ($Schedule == 'null' && $exp_date == null && $dm != 'null') {
        if($dm == '1'){
            $date = date('Y-m-d');
            $orders = Order::where('orders.created_at',$date)->join('order__user__profiles', 'orders.Profile_id', '=', 'order__user__profiles.id')
            ->join('users', 'order__user__profiles.User_id', '=', 'users.id')
            ->select('orders.*', 'users.name as cname')->get();
            return view('admin.reports_exports')->withschedule('false')->withexp('false')->withdm($orders)->withSched($Schedules);
        }else{
            $date = date('Y-m-d');
            $beforeOneMonth = \Carbon\Carbon::parse($date)->subMonth()->toDateString();
            $orders = Order::whereBetween('orders.created_at', [$beforeOneMonth, $date])->join('order__user__profiles', 'orders.Profile_id', '=', 'order__user__profiles.id')
            ->join('users', 'order__user__profiles.User_id', '=', 'users.id')
            ->select('orders.*', 'users.name as cname')->get();
            return view('admin.reports_exports')->withschedule('false')->withexp('false')->withdm($orders)->withSched($Schedules);
        }
    }elseif ($Schedule != 'null' && $exp_date == null && $dm != 'null') {
        $sdata = Product::join('product_veriant', 'products.id', '=', 'product_veriant.pid')
    ->where('products.Schedule', '=', $Schedule)
    ->select('products.*', 'product_veriant.stock', 'product_veriant.batch')
    ->get();
        if($dm == '1'){
            $date = date('Y-m-d');
            $orders = Order::where('orders.created_at',$date)->join('order__user__profiles', 'orders.Profile_id', '=', 'order__user__profiles.id')
            ->join('users', 'order__user__profiles.User_id', '=', 'users.id')
            ->select('orders.*', 'users.name as cname')->get();
            return view('admin.reports_exports')->withschedule($sdata)->withexp('false')->withdm($orders)->withSched($Schedules);
        }else{
            $date = date('Y-m-d');
            $beforeOneMonth = \Carbon\Carbon::parse($date)->subMonth()->toDateString();
            $orders = Order::whereBetween('orders.created_at', [$beforeOneMonth, $date])
    ->join('order__user__profiles', 'orders.Profile_id', '=', 'order__user__profiles.id')
    ->join('users', 'order__user__profiles.User_id', '=', 'users.id')
    ->select('orders.*', 'users.name as cname')
    ->get();
            return view('admin.reports_exports')->withschedule($sdata)->withexp('false')->withdm($orders)->withSched($Schedules);
           
        }
    }else{
        return view('admin.reports_exports')->withschedule('false')->withexp('false')->withdm('false')->withSched($Schedules);
    }
    

    }
}
