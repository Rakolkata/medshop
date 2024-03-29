<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\Product;
use  App\Models\Med_Function;
use  App\Models\User;
use  App\Models\Order;
use  App\Http\Controllers\Auth\RegisterController;
use  App\Models\Order_User_Profile;
use  App\Models\Order_details;



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
            $data = Product::with('category', 'ProductVeriant')
                ->where('Title', 'LIKE', '%' . $search . '%')->where('Stock', '>=', 1)->orWhere('Generic_name', 'LIKE', '%' . $search . '%')->orderBy('title', 'asc')->orderBy('Exp_date','asc')->take(10)->get();


            $output =[];
            if (count($data)>0) {
                //dump($data);
                foreach($data as $d) {
                    $output[]= ['label'=>$d->Title,'id' =>$d->id,'values'=>$d];

                }
               //$output =  $data;

            }else {

                $output = "<li class='list-group-item'>No Data Found</li>";

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
        $user_find = User::where('email', $req['coustomer_email'])->first();
        $user_id = '';
        if ($user_find == null) {
            $register = new RegisterController;
            // Access method in TasksController
            $register->create(array('name' => $req['coustomer_name'], 'email' => $req['coustomer_email'], 'type' => Null, 'password' => '12345678'));
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

        foreach ($prod_name as $index => $value) {
            $order_details = new Order_details;
            //   $dt=$order_last_id.date("dmY");
            //   $order_details->Order_id = $dt;
            $order_details->Order_id = $order_last_id;
            $order_details->Product_id = $prod_id[$index];
            $order_details->rate = $prod_rate[$index];
            $order_details->qty = $prod_qty[$index];
            $order_details->gst = $prod_gst[$index];
            $order_details->Product_price     = $prod_price[$index];
            $order_details->save();
            $product = Product::find($order_details->Product_id);
            $stock = $product->Stock;
            $product->Stock = $stock - $order_details->qty;
            $product->save();
        }

        return redirect()->route('admin.order_view');

        // return $prod_price;

    }

    public function view()
    {
        $order = Order::join('order__user__profiles', 'order__user__profiles.id', '=', 'orders.Profile_id')
            ->join('users', 'users.id', '=', 'order__user__profiles.User_id')
            ->select(['orders.Total_Order', 'users.name', 'orders.id', 'orders.orderID', 'order__user__profiles.Doc_Name_RegdNo', 'order__user__profiles.Address', 'order__user__profiles.Phone'])->paginate(15);
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
            ->with('products')
            ->get();
        return View('admin.order_details')->with(compact('order_details'));
    }

    public function delete($id)
    {
        echo $id;
        $order = Order::find($id);
        if ($order != null) {
            $order->delete();
        }
        return redirect()->route('admin.order_view')->with('order_deleetd', 'Order Deleted!');
    }
}
