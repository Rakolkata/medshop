<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    public function index()
    {
        return view('admin.add_brand');
    }

    public function view()
    {
        $brand = Brand::paginate(25);
        return view('admin.view_brand')->with(compact('brand'));
    }
    public function store(Request $req)
    {
        $req->validate([
            'name' => 'required|unique:brands'
        ]);
        echo $req['name'];
        $brand = new Brand;
        $brand->Name = $req['name'];
        $brand->save();
        return redirect()->route('admin.view_brand')->with('msg', 'Brand Added!');
    }

    public function delete($id)
    {
        $brand = Brand::find($id);
        if ($brand != null) {
            $brand->delete();
        }
        return redirect()->back()->with('msg-dleted', 'Brand Deleted!');
    }

    public function edit($id)
    {
        $brand =  Brand::find($id);
        if ($brand != null) {
            return view('admin.update_brand')->with(compact('brand'));
        }
    }

    public function update($id, Request $req)
    {
        $brand = Brand::find($id);
        $brand->Name = $req['name'];
        $brand->save();
        return redirect()->route('admin.view_brand')->with('brand_updated', 'Brand Updated!');
    }
    public function brand_data(Request $request)
    {
        if ($request->name) {
            $search = $request->name;
        } else {
            $search = $request->term;
        } 
        $data = Brand::where('Name', 'LIKE', $search . '%')

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
