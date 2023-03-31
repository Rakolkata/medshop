<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use  App\Models\Product;
use  App\Models\ProductVeriant;

class ProductVeriantController extends Controller
{
    public function update($pid) {
        $product = Product::with('ProductVeriant')->find($pid);

        return view('admin.view_product_variant')->with(compact('product'));

    }

    public function save($pid,request $request) {
        $pvs =[];
        $pvs = $request->all();

        foreach($pvs['batch'] as $i=>$pv ) {
            if(isset($pvs['vid'][$i])){
                $productvariant = ProductVeriant::find($pvs['vid'][$i]);
                if($pvs['batch'][$i]){

                    $productvariant->batch = $pvs['batch'][$i];
                    $productvariant->stock	 = $pvs['stock'][$i];
                    $productvariant->expdate = $pvs['expdate'][$i];
                    $productvariant->mrp_per_unit = $pvs['mrp'][$i];
                    $productvariant->strip = $pvs['strip'][$i];
                    $productvariant->save();
                }else{
                    $productvariant->delete();
                }

            }else{
                if(isset($pvs['batch'][$i]) && $pvs['batch'][$i]!=''){

                    $productvariant = new ProductVeriant;
                    $productvariant->batch = $pvs['batch'][$i];
                    $productvariant->stock	 = $pvs['stock'][$i];
                    $productvariant->expdate = $pvs['expdate'][$i];
                    $productvariant->mrp_per_unit = $pvs['mrp'][$i];
                    $productvariant->strip = $pvs['strip'][$i];
                    $productvariant->pid = $pvs['pid'];
                    $productvariant->save();
                }



            }
        }
         return redirect()->route('admin.view_product')->with('msg','Stock Updated!');
    }
}
