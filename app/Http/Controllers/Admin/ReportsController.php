<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;

class ReportsController extends Controller
{
    public function index(){
        $Schedule = Schedule::all();
    return view('admin.reports')->with(compact('Schedule'));
    }

    public function export(){
        
    }
}
