<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Med_Function;

class FunctionController extends Controller
{
    public function index(){
    return view('admin.add_function');
    }

    public function view(){
    $function = Med_Function::paginate(25);
    return view('admin.view_function')->with(compact('function'));
    }

    public function store(Request $req){
    $req->validate([
        'name'=>'required|unique:med__functions'
    ]);
    $function = new Med_Function;
    $function->Name = $req['name'];
    $function->save();

    return redirect()->route('admin.view_function')->with('msg','Function Added!');
    }

    public function delete($id){
    $function = Med_Function::find($id);
    if ($function != null) {
        $function->delete();
    }
    return redirect()->route('admin.view_function')->with('msg-deleted','Function Deleted!');   
    }
}
