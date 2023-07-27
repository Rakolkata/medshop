<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Session;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {

        return view('admin.add_category');
    }

    public function view()
    {
        $category = Category::paginate(25);
        return view('admin.view_category')->with(compact('category'));
    }

    public function store(Request $req)
    {
        $req->validate(
            [
                'name' => 'required|unique:categories',
            ]
        );
        $category = new Category;
        $category->Name = $req['name'];
        $category->HSN = $req['HSN'];
        $category->Gstrate = $req['gst_rate'];
        $category->description = $req['description'];
        $category->save();
        return redirect(route('admin.view_category'))->with(Session::flash('message', "Category Added!"));
    }

    public function delete($id)
    {
        $category = Category::find($id);
        if ($category != null) {
            $category->delete();
        }
        return redirect()->back()->with('msg-delete', 'Category Deleted!');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        if ($category != null) {
            return view('admin.update_category')->with(compact('category'));
        }
    }

    public function update(Request $req, $id)
    {
        $category = Category::find($id);
        $category->Name = $req['name'];
        $category->HSN = $req['HSN'];
        $category->Gstrate = $req['gstrate'];
        $category->description = $req['description'];
        $category->save();
        return redirect(route('admin.view_category'))->with(Session::flash('message-updated', "Category updated!"));
    }
    
}
