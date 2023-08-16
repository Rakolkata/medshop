<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\Product;
use  App\Models\Med_Function;
use  App\Models\User;
use  App\Models\Order;
use PDF;
use  App\Http\Controllers\Auth\RegisterController;
use  App\Models\Order_User_Profile;
use  App\Models\Order_details;
use App\Models\ProductVeriant;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request)
    {

        return view('admin.create_order');
    }

    public function prod_name(Request $request)
    {
        if ($request->ajax()) {
            if ($request->name) {
                $search = $request->name;
            } else {
                $search = $request->term;
            }
            $data = Product::with(['category', 'ProductVeriant' => function ($q) {
                $q->where('stock', '>', 0)->orderBy('expdate', 'asc');
            }])
                ->where('Title', 'LIKE', '%' . $search . '%')
                ->orWhere('Generic_name', 'LIKE', '%' . $search . '%')
                ->orderBy('title', 'asc')
                ->take(10)
                ->get();
            // $data = Product::with('category', 'ProductVeriant')
            //     ->where('Title', 'LIKE', '%' . $search . '%')->where('Stock', '>=', 1)->orWhere('Generic_name', 'LIKE', '%' . $search . '%')->orderBy('title', 'asc')->orderBy('Exp_date', 'asc')->take(10)->get();


            $output = [];
            if (count($data) > 0) {
                //dump($data);
                foreach ($data as $d) {
                    // $hasProductVariant = $d->relationLoaded('ProductVariant') && $d->ProductVariant->count() > 0;
                    $totalStock = 0;
                    if (count($d->ProductVeriant) > 0) {
                        foreach ($d->ProductVeriant as $variant) {
                              $output[] = ['label' => $d->Title ."             stock:".$variant->stock, 'id' => $d->id,'value'=>$d->Title, 'values' => $d];
                        }
                        // $output[] = ['label' => $d->Title ."   ".$totalStock, 'id' => $d->id,'value'=>$d->Title, 'values' => $d];
                    }
                }
                //$output =  $data;

            } else {

                $output = [];
            }

            // $output = [];
            // if (count($data) > 0) {
            //     foreach ($data as $d) {
            //         $productVariant = $d->ProductVeriant->toArray(); // Get the product variant data as an array
            //         $category = $d->category->toArray(); // Get the category data as an array

            //         $output[] = [
            //             'label' => $d->Title,
            //             'id' => $d->id,
            //             'values' => [
            //                 'product_veriant' => $productVariant,
            //                 'category' => $category
            //             ]
            //         ];
            //     }
            // } else {
            //     $output[] = [
            //         'label' => 'No Data Found',
            //         'id' => '',
            //         'values' => []
            //     ];
            // }

            return response()->json($output);
        }
    }




    public function store(Request $req)
    {
        $prod_qty = $req['qty'];
        //
       
          if (!is_array($prod_qty)) {
             return redirect()->back()->with('error', 'Invalid order data.');
           }

          if (array_sum($prod_qty) === 0) {
             return redirect()->back()->with('error', 'Order quantity cannot be zero.');
           }
    
        $user_find = User::where('email', $req['coustomer_email'])->first();
        $user_id = '';
    
        if ($user_find == null) {
            $register = new RegisterController;
            $register->create(array('name' => $req['coustomer_name'], 'email' => $req['coustomer_email'], 'type' => null, 'password' => '12345678'));
    
            $reg_id =  User::where('email', $req['coustomer_email'])->first();
            $user_id = $reg_id->id;
        } else {
            $user_id = $user_find->id;
        }
    
        $Order_User_Profile = new Order_User_Profile;
        $customer_phone = $req['coustomer_phone'];
        $Order_User_Profile->phone = $customer_phone;
        $Order_User_Profile->Address = $req['customer_address'];
        $Order_User_Profile->Doc_Name_RegdNo = $req['doc_name_regdno'];
        $Order_User_Profile->User_id =  $user_id;
        $Order_User_Profile->save();
        $last_id = $Order_User_Profile->id;
    
        $order = new Order;
        $order->Profile_id = $last_id;
        $order->Total_Order = $req['grand_total'];
        $order->Total_Gst = $req['total_gst'];
        $order->Discount = $req['total_discount'];
        $order->Adjustment = $req['round_off'];
        $order->orderID = "";
        $order->status = 'draft';
        $order->save();
        $order_last_id = $order->id;
        $dt = substr(env('APP_NAME'), 0, 1) . date("dmY") . $order_last_id;
        $order->orderID = $dt;
        $order->save();
    

        $prod_name =  $req['title'];
        $prod_id =  $req['id'];
        $prod_rate = $req['rate'];
        $prod_qty = $req['qty'];
        $prod_gst = $req['gst'];
        $prod_price = $req['total'];
        $prod_batch = $req['batch_no'];

        

    
        $insert_data2 = [];
        for ($k = 0; $k < count($prod_id); $k++) {
            $data1 = array(
                'Order_id' => $order_last_id,
                'batch_no' => $prod_batch[$k],
                'Product_id' => $prod_id[$k],
                'rate' => $prod_rate[$k],
                'qty' => $prod_qty[$k],
                'gst' => $prod_gst[$k],
                'Product_price' => $prod_price[$k],
            );
            $insert_data2[] = $data1;
        }
        /*
        $order_deatil = Order_details::where('Product_id', '=', $prod_id)->first();
        $product = ProductVeriant::where('pid', '=', $order_deatil->Product_id)->where('batch', '=', $order_deatil->batch_no)->first();
        if($product)
        {
            $stock = $product->stock;
            $product->stock = $stock - array_sum($prod_qty);
            $product->save();
        }

        */

        Order_details::insert($insert_data2);
    
        $pdf = PDF::loadView('admin.order_invoice', $req->all());
        $pdf->setPaper('A4');
        $pdfContents = $pdf->output();
    
        echo '<script>
            var newTab = window.open("", "_blank");
            newTab.document.write(\'<iframe width="100%" height="100%" src="data:application/pdf;base64,' . base64_encode($pdfContents) . '"></iframe>\');
            setTimeout(function(){ window.location.href = "/admin/order-list"; }, 100);
        </script>';

    }
    


    public function view()
    {
        $order = Order::join('order__user__profiles', 'order__user__profiles.id', '=', 'orders.Profile_id')
            ->join('users', 'users.id', '=', 'order__user__profiles.User_id')
            ->join('order_details', 'order_details.Order_id', '=', 'orders.id')
            ->select(['orders.Total_Order', 'users.name', 'orders.id', 'orders.status', 'orders.orderID', 'order__user__profiles.Doc_Name_RegdNo', 'order__user__profiles.Address', 'order__user__profiles.Phone'])
            ->where('orders.status', '!=', 'cancled')
            // ->whereIn('order_details.status', ['draft', 'dispatched'])
            // ->groupBy('orders.id')
            // ->havingRaw('COUNT(order_details.id) > 1')
            ->paginate(15);
        $order_id = [];
        foreach ($order as $value) {
            $order_id[] = $value->id;
        }

        $Order_Details = [];
        foreach ($order_id as $item) {
            $Order_Details[] = Order_details::where('Order_id', $item)
                ->join('products', 'products.id', '=', 'order_details.Product_id')
                ->leftJoin('orders', 'orders.id', '=', 'order_details.Order_id')
                ->select('products.Title as Title', 'products.MRP as mrp', 'products.SKU as Sku', 'products.Exp_date as Exp', 'order_details.qty as Qty', 'order_details.rate as Rate', 'order_details.gst as Gst', 'order_details.Product_price as Total', 'orders.Total_Order as total_order', 'orders.Discount as discount')->get();
        }


        return view('admin.view_order')->with(compact('order', 'Order_Details'));
    }

    public function order_details($Order_id)
    {
        $order_details = Order_details::where('Order_id', $Order_id)
            ->where('status', '!=', 'cancled')
            ->with('products')
            ->get();
        return View('admin.order_details')->with(compact('order_details'));
    }

    public function delete($id)
    {
        echo $id;
        $order = Order::find($id);

        $order_deatil = Order_details::where('Order_id', '=', $id)->first();
        $product = ProductVeriant::where('pid', '=', $order_deatil->Product_id)->where('batch', '=', $order_deatil->batch_no)->first();
        if($product && $order_deatil->status == 'dispatched' )
        {
            $stock = $product->stock;
            $product->stock = $stock + $order_deatil->qty ;
            $product->save();
        }
        else if($product && $order_deatil->status == 'draft'){
            $stock = $product->stock;
            $product->stock = $stock;
            $product->save();
        }

        if ($order != null) {  

            $order->delete();
        }
        
        
        return redirect()->route('admin.order_view')->with('order_deleetd', 'Order Deleted!');
    }
    public function serch_order(Request $req)
    {
        $search = $req->search;

        $order = Order::join('order__user__profiles', 'order__user__profiles.id', '=', 'orders.Profile_id')
            ->leftJoin('users', 'users.id', '=', 'order__user__profiles.User_id')
            ->join('order_details', 'orders.id', '=', 'order_details.Order_id')
            ->join('products', 'products.id', '=', 'order_details.Product_id')
            ->select(
                'orders.Total_Order',
                'users.name',
                'orders.id',
                'orders.orderID',
                'order__user__profiles.Doc_Name_RegdNo',
                'order__user__profiles.Address',
                'order__user__profiles.Phone',
                'products.Title as Title',
                'products.MRP as mrp',
                'products.SKU as Sku',
                'products.Exp_date as Exp',
                'order_details.qty as Qty',
                'order_details.rate as Rate',
                'order_details.gst as Gst',
                'order_details.Product_price as Total',
                'orders.Total_Order as total_order',
                'orders.Discount as discount'
            )
            ->where('orders.status', '<>', 'cancled')
            ->where('orders.orderID', 'Like', $search. '%')
            ->orWhere('order__user__profiles.phone', 'Like', $search . '%')
            ->orWhere('users.name', 'like', $search . '%')
            ->paginate(15);
        
            return $order;
            // return response()->json($order);
        //we have to return data of the
    }





public function status_update(Request $request, $id)
{
    $orderDetails = Order_details::where('Product_id', '=', $id)->first();
    $productVariant = ProductVeriant::where('pid', '=', $orderDetails->Product_id)
        ->where('batch', '=', $orderDetails->batch_no)
        ->first();
      
    if ($orderDetails->status === 'draft') {
        $orderDetails->status = 'dispatched';
        $productVariant->stock  = $productVariant->stock - $orderDetails->qty; 
        $productVariant->save();
    } else {
        $orderDetails->status = 'draft';
        $productVariant->stock = $productVariant->stock + $orderDetails->qty; 
        $productVariant->save();
    }
    
    $orderDetails->save();
    
 
    return redirect()->back();
}



    public function cancle_order(Request $request, $id)
    {
        // dd($id);
        $order_details = Order_details::where('Order_id', '=', $id)->first();

        $order_details->status = 'cancled';
        $order_details->save();

        $stock = ProductVeriant::where('pid', '=', $id)->where('batch', '=', $order_details->batch_no)->first();
        $stock->stock = $stock->stock + $order_details->qty;
        $stock->save();

        return redirect()->back();
        // return redirect()->route('admin.order_view');
    }

    public function cancle_complete_order(Request $request, $id)
    {
        // dd($id);
        $order = Order::where('id', '=', $id)->first();
        // dd($order->toArray());
        $order->status = 'cancled';
        $order->save();

        Order_details::where('Order_id', '=', $id)->update(['status' => 'cancled']);
        $products = Order_details::where('Order_id', '=', $id)->where('status', '=', 'dispatched')->get();

        $pro_id = $products->pluck('Product_id')->toArray();
        $pro_btach = $products->pluck('batch_no')->toArray();
        // dd(gettype($pro_btach));/
        // dd($pro_id);
        $pro_variants = ProductVeriant::whereIn('pid', $pro_id)->whereIn('batch', $pro_btach)->get();
        // dd($pro_ver);
        foreach ($pro_variants as $variant) {
            $product = $products->firstWhere('Product_id', $variant->pid)->qty;
            $variant->stock += $product;
            $variant->save();
        }

        return redirect()->back(); 
    }

    
    public function genpdf(Request $req){
        $result = Order::join('order__user__profiles', 'order__user__profiles.id', '=', 'orders.Profile_id')
    ->leftJoin('users', 'users.id', '=', 'order__user__profiles.User_id')
    ->join('order_details', 'orders.id', '=', 'order_details.Order_id')
    ->join('products', 'products.id', '=', 'order_details.Product_id')
    ->join('product_veriant','product_veriant.pid','=','products.id')
    ->select(
        'orders.Total_Order',
        'users.name',
        'users.email',
        'orders.id',
        'orders.orderID',
        'order__user__profiles.Doc_Name_RegdNo',
        'order__user__profiles.Address',
        'order__user__profiles.Phone',
        'products.Title as Title',
        'products.MRP as mrp',
        'products.SKU as Sku',
        'products.Exp_date as Exp',
        'order_details.qty as Qty',
        'order_details.rate as Rate',
        'order_details.gst as Gst',
        'order_details.Product_price as Total',
        'orders.Total_Order as total_order',
        'orders.Discount as discount',
        'orders.Total_Gst',
        'orders.Adjustment as roundoff',
        'product_veriant.batch'


    )
    ->where('orders.id', '=', $req->data)
    ->get();
        

        $selectedData = [
            '_token' => $req->_token,
            'coustomer_name' => $result[0]['name'],
            'coustomer_phone' => $result[0]['Phone'],
            'coustomer_email' => $result[0]['email'],
            'customer_address' => $result[0]['Address'],
            'doc_name_regdno' => $result[0]['Doc_Name_RegdNo'],
            'total_discount' => $result[0]['discount'],
            'total_taxable_amount' => $result[0]['total_order'],
            'total_gst' => $result[0]['Total_Gst'],
            'round_off' => $result[0]['roundoff'],
            'grand_total' => $result[0]['total_order'],
            'order_id' => $result[0]['orderID'],
            "id" => [],
            "title" =>  [],
            "batch_no" => [],
            "qty" =>  [],
            "rate" => [],
            "discount" => [],
            "gst" => [],
            "total" => [],
            "exp"=>[]
        ];

        
        
            for ($i = 0; $i <= count($result)-1; $i++) {
                $selectedData['id'][] = $i;
                $selectedData['title'][] = $result[$i]['Title'];
                $selectedData['batch_no'][] = $result[$i]['batch'];
                $selectedData['qty'][] = $result[$i]['Qty'];
                $selectedData['rate'][] = $result[$i]['Rate'];
                $selectedData['discount'][] = 'Null'; // Modify this line if you want to store individual discounts
                $selectedData['gst'][] = $result[$i]['Gst'];
                $selectedData['total'][] = $result[$i]['Total'];
                $selectedData['exp'][] = $result[$i]['Exp'];
                }


    
                $pdf = PDF::loadView('admin.order_invoice', $selectedData);
            $pdf->setPaper('A4');
            $pdfContents = $pdf->output();
    
             return response($pdfContents, 200)
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'attachment; filename="receipt.pdf"');
    }
}
