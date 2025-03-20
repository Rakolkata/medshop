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

    public function edit($id){
    $function = Med_Function::find($id);
    if ($function != null) {
    return view('admin.update_function')->with(compact('function'));
    }
    }

    public function update($id,Request $req){
    $req->validate([
    'name' => 'required',
    ]);
    $function = Med_Function::find($id);
    $function->Name = $req['name'];
    $function->save();
    return redirect()->route('admin.view_function')->with('function_updated','Function Updated!');
    }
    public function function_data(Request $request)
    {
        if ($request->name) {
            $search = $request->name;
        } else {
            $search = $request->term;
        } 
        $data = Med_Function::where('Name', 'LIKE', $search . '%')

        ->orderBy('name', 'asc')
                ->take(10)
            ->get();

            $output = [];
            if (count($data) > 0) {
                //dump($data);
                foreach ($data as $d) {
                    $output[] = ['label' => $d->Name, 'id' => $d->id,'value'=>$d->Name, 'values' => $d];
                }

        }

        return response()->json($output);
    }
}
