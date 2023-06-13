<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Schedule;
use  App\Models\Product;
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
    $requestData = $request->all();
    $token = $requestData['_token'];
    $Schedule = $requestData['schedule'];
    $exp_date = $requestData['exp_date'];
    $dm = $requestData['day_month'];

    //check

    if($Schedule != 'null' && $exp_date == null && $dm == 'null'){
        $sdata = Product::where('Schedule','=',$Schedule)->get();
        return view('admin.reports_exports')->withschedule($sdata)->withexp('false')->withdm('false');
    
    }elseif ($Schedule != 'null' && $exp_date != null && $dm == 'null') {
        $sdata = Product::where('Schedule','=',$Schedule)->get();
        $edata = Product::where('Exp_date','=',$exp_date)->get();
        return view('admin.reports_exports')->withschedule($sdata)->withexp($edata)->withdm('false');
    }elseif ($Schedule != 'null' && $exp_date != null && $dm != 'null') {
        $sdata = Product::where('Schedule','=',$Schedule)->get();
        $edata = Product::where('Exp_date','=',$exp_date)->get();
        if($dm == '1'){
            $date = date('Y-m-d');
            $orders = Order::where('orders.created_at',$date)->join('order__user__profiles', 'orders.Profile_id', '=', 'order__user__profiles.id')
            ->join('users', 'order__user__profiles.User_id', '=', 'users.id')
            ->select('orders.*', 'users.name as cname')->get();
            return view('admin.reports_exports')->withschedule($sdata)->withexp($edata)->withdm($orders);
        }else{
            $date = date('Y-m-d');
            $beforeOneMonth = \Carbon\Carbon::parse($date)->subMonth()->toDateString();
            $orders = Order::whereBetween('orders.created_at', [$beforeOneMonth, $date])->join('order__user__profiles', 'orders.Profile_id', '=', 'order__user__profiles.id')
    ->join('users', 'order__user__profiles.User_id', '=', 'users.id')
    ->select('orders.*', 'users.name as cname')->get();
            return view('admin.reports_exports')->withschedule($sdata)->withexp($edata)->withdm($orders);
        }
    }elseif ($Schedule == 'null' && $exp_date != null && $dm == 'null') {
        $edata = Product::where('Exp_date','=',$exp_date)->get();
        return view('admin.reports_exports')->withschedule('false')->withexp($edata)->withdm('false');
    }elseif ($Schedule == 'null' && $exp_date != null && $dm != 'null') {
        $edata = Product::where('Exp_date','=',$exp_date)->get();
        if($dm == '1'){
            $date = date('Y-m-d');
            $orders = Order::where('orders.created_at',$date)->join('order__user__profiles', 'orders.Profile_id', '=', 'order__user__profiles.id')
            ->join('users', 'order__user__profiles.User_id', '=', 'users.id')
            ->select('orders.*', 'users.name as cname')->get();
            return view('admin.reports_exports')->withschedule('false')->withexp($edata)->withdm($orders);
        }else{
            $date = date('Y-m-d');
            $beforeOneMonth = \Carbon\Carbon::parse($date)->subMonth()->toDateString();
            $orders = Order::whereBetween('orders.created_at', [$beforeOneMonth, $date])->join('order__user__profiles', 'orders.Profile_id', '=', 'order__user__profiles.id')
            ->join('users', 'order__user__profiles.User_id', '=', 'users.id')
            ->select('orders.*', 'users.name as cname')->get();
            return view('admin.reports_exports')->withschedule('false')->withexp($edata)->withdm($orders);
        }
    }elseif ($Schedule == 'null' && $exp_date == null && $dm != 'null') {
        if($dm == '1'){
            $date = date('Y-m-d');
            $orders = Order::where('orders.created_at',$date)->join('order__user__profiles', 'orders.Profile_id', '=', 'order__user__profiles.id')
            ->join('users', 'order__user__profiles.User_id', '=', 'users.id')
            ->select('orders.*', 'users.name as cname')->get();
            return view('admin.reports_exports')->withschedule('false')->withexp('false')->withdm($orders);
        }else{
            $date = date('Y-m-d');
            $beforeOneMonth = \Carbon\Carbon::parse($date)->subMonth()->toDateString();
            $orders = Order::whereBetween('orders.created_at', [$beforeOneMonth, $date])->join('order__user__profiles', 'orders.Profile_id', '=', 'order__user__profiles.id')
            ->join('users', 'order__user__profiles.User_id', '=', 'users.id')
            ->select('orders.*', 'users.name as cname')->get();
            return view('admin.reports_exports')->withschedule('false')->withexp('false')->withdm($orders);
        }
    }elseif ($Schedule != 'null' && $exp_date == null && $dm != 'null') {
        $sdata = Product::where('Schedule','=',$Schedule)->get();
        if($dm == '1'){
            $date = date('Y-m-d');
            $orders = Order::where('orders.created_at',$date)->join('order__user__profiles', 'orders.Profile_id', '=', 'order__user__profiles.id')
            ->join('users', 'order__user__profiles.User_id', '=', 'users.id')
            ->select('orders.*', 'users.name as cname')->get();
            return view('admin.reports_exports')->withschedule($sdata)->withexp('false')->withdm($orders);
        }else{
            $date = date('Y-m-d');
            $beforeOneMonth = \Carbon\Carbon::parse($date)->subMonth()->toDateString();
            $orders = Order::whereBetween('orders.created_at', [$beforeOneMonth, $date])
    ->join('order__user__profiles', 'orders.Profile_id', '=', 'order__user__profiles.id')
    ->join('users', 'order__user__profiles.User_id', '=', 'users.id')
    ->select('orders.*', 'users.name as cname')
    ->get();
            return view('admin.reports_exports')->withschedule($sdata)->withexp('false')->withdm($orders);
           
        }
    }

    }
}
