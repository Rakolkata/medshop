<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $result = DB::table('orders')
            ->select(DB::raw('YEAR(created_at) AS year, MONTH(created_at) AS month, SUM(Total_Order) AS monthly_sale'))
            ->groupBy(DB::raw('YEAR(created_at), MONTH(created_at)'))
            ->orderBy(DB::raw('YEAR(created_at), MONTH(created_at)'))
            ->where('status' , '=' , 'dispatched')
            ->get();

        // $data = DB::table('orders_detail')->select('title','phone','food')->
        return view('admin.dashboard', compact('result'));
    }

    public function shopownerHome()
    {
        return view('shopowner.dashboard');
    }

    public function registration_success()
    {

        return view('registration_completed');
    }
}
