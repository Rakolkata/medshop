<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;

class ScheduleController extends Controller
{
    public function index(){
    return view('admin.add_schedule');
    }

    public function view(){
    $schedule = Schedule::paginate(25);
    return view('admin.view_schedule')->with(compact('schedule'));
    }

    public function store(Request $req){
    $schedule = new Schedule; 
    $schedule->Name = $req['name'];
    $schedule->save();
    return redirect()->route('admin.view_schedule')->with('msg','Schedule Added!');
    }

    public function delete($id){
    $schedule = Schedule::find($id); 
    if ($schedule != null) {
        $schedule->delete();
    }
    return redirect()->route('admin.view_schedule')->with('msg-deleted','Schedule Deleted!');
    }
}
